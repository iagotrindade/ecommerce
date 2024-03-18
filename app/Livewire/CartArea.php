<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Http\Livewire\SiteProductsArea;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Geocoder\Laravel\Facades\Geocoder;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use App\Http\Handlers\UserHandler;
use App\Models\User;
use App\Models\Order;
use App\Models\PurchasedProducts;
use App\Models\PurchasedProductAddons;
use App\Models\Adresses;
use Illuminate\Support\Facades\Config;

class CartArea extends Component
{
    //Cart & Visual Properties
    public $cartStage = 1;
    public $stageOneDisplay = 'flex';
    public $stageTwoDisplay = 'none';
    public $stageThreeDisplay = 'none';
    public $stageFourDisplay = 'none';
    public $stageFiveDisplay = 'none';
    public $chosenProductQuantity = 1;
    public $chosenAddons = [];
    public $addonQuantities = [];
    public $cart = [];
    public $mobilePaymentSiteTab = 'block';
    public $mobilePaymentHomeTab = 'none';

    //Shipping Properties
    public $userAssas;

    public $deliveryOrder = true;
    public $tableOrder = false;
    public $compiledAddress = '';
    public $zipcode = '';
    public $clientCpf = '';
    public $name = '';
    public $clientName = '';
    public $email = '';
    public $street = '';
    public $number = '';
    public $city = '';
    public $complement = '';
    public $district = '';
    public $reference = '';
    public $whatsapp = '';
    public $cepError = '';
    public $inputsError = '';
    public $orderType = '';

    //Payment Properties

    public $paymentAssas;
    public $pixQrcode;
    public $paymentType = 'money';
    public $valueBack = '';

    public function render()
    {
        if(Cache::has('payment_received')) {
            $this->changeCartStage(5);
            Cache::forget('payment_received');
        }

        return view('livewire.cart-area');
    }


    #[On('alterProductQuantity')]
    public function alterProductQuantity($action, $productSku)
    {
        $cart = session('cart');
        foreach ($cart as &$product) {
            if ($product['product_sku'] == $productSku) {

                if ($action === '-') {

                    $productId = $product['id'];
                    if($product['quantity'] <= 1) {
                        $cart = array_filter($cart, function ($cartItem) use ($productId) {
                            return $cartItem['id'] !== $productId;
                        });

                        // Salve o carrinho atualizado na sessão.
                        session(['cart' => $cart]);
                    }
                    else{
                        $product['quantity'] = max(0, $product['quantity'] - 1);
                    }

                } elseif ($action === '+') {
                    $product['quantity']++;
                }
                break;
            }
        }

        session(['cart' => $cart]);

        $this->dispatch('updateCart', count(session('cart')));
    }

    public function alterAddonQuantity($productSku, $addonId, $action)
    {
        $cart = session('cart');

        foreach ($cart as &$product) {
            if ($product['product_sku'] === $productSku) {
                foreach ($product['addons'] as &$addon) {
                    if ($addon['id'] === $addonId) {
                        if ($action === '-') {
                            $addon['quantity'] = max(0, $addon['quantity'] - 1);
                         } elseif ($action === '+') {
                            $addon['quantity']++;
                        }
                        break;
                    }
                }
                break;
            }
        }
        session(['cart' => $cart]);

        $this->dispatch('updateCart', count(session('cart')));
    }

    public function calculateSubtotal()
    {
        $subtotal = 0;

        if(session('cart')) {
            foreach (session('cart') as $product) {
                $subtotal += $product['product']['price'] * $product['quantity'];

                foreach ($product['addons'] as $addon) {
                    $subtotal += $addon['price'] * $addon['quantity'];
                }
            }
        }

        return $subtotal;
    }

    public function calculateTotal()
    {
        $subtotal = $this->calculateSubtotal();
        $discount = 0;
        $deliveryCost = 0; // Substitua pelo cálculo real do custo de entrega.

        if(session('shipping')) {
            $deliveryCost = session('shipping')['shipping_value'];
        }
        $total = $subtotal - $discount + $deliveryCost;

        return max($total, 0); // Garante que o total não seja negativo.
    }

    public function changeCartStage($stageInfo) {
        $this->inputsError = "";

        switch ($stageInfo) {
            case 1:
                $this->stageOneDisplay = 'flex';
                $this->stageTwoDisplay = 'none';
                $this->stageThreeDisplay = 'none';
                $this->stageFourDisplay = 'none';
                $this->stageFiveDisplay = 'none';
                break;

            case 2:
                //Verificar se quem está comprando existe no ASSAS e no BD

                if(session('shipping')) {
                    $shippingInfo = session('shipping');
                    $this->compiledAddress = $shippingInfo['compiled_address'];
                    $this->zipcode = $shippingInfo['zipcode'];
                    $this->name = $shippingInfo['name'];
                    $this->email = $shippingInfo['email'];
                    $this->clientName = $shippingInfo['clientName'];
                    $this->clientCpf = $shippingInfo['clientCpf'];
                    $this->street = $shippingInfo['street'];
                    $this->number = $shippingInfo['number'];
                    $this->complement = $shippingInfo['complement'];
                    $this->district = $shippingInfo['district'];
                    $this->reference = $shippingInfo['reference'];
                    $this->whatsapp = $shippingInfo['whatsapp'];
                }

                $this->stageOneDisplay = 'none';
                $this->stageTwoDisplay = 'block';
                $this->stageThreeDisplay = 'none';
                $this->stageFourDisplay = 'none';
                $this->stageFiveDisplay = 'none';

                break;

            case 3:
                if($this->zipcode != "" && $this->name != "" && $this->clientName != "" && $this->email != "" && $this->clientCpf != "" && $this->street != "" && $this->number != "" && $this->district != "" && $this->whatsapp != "") {
                    $this->stageOneDisplay = 'none';
                    $this->stageTwoDisplay = 'none';
                    $this->stageThreeDisplay = 'flex';
                    $this->stageFourDisplay = 'none';
                    $this->stageFiveDisplay = 'none';

                    //Adicionar os dados de frete na sessão
                    Session::forget('shipping');

                    $shippingInfo = [
                        'zipcode' => $this->zipcode,
                        'name' => $this->name,
                        'clientName' => $this->clientName,
                        'email' => $this->email,
                        'clientCpf' => $this->clientCpf,
                        'street' => $this->street,
                        'number' => $this->number,
                        'complement' => $this->complement,
                        'district' => $this->district,
                        'reference' => $this->reference,
                        'whatsapp' => $this->whatsapp,
                        'shipping_value' => $this->calcDistance(),
                        'compiled_address' => $this->compiledAddress
                    ];

                    // Salve o carrinho na sessão.
                    session(['shipping' => $shippingInfo]);
                    break;
                }

                else {
                    $this->inputsError = "Preencha os Campos Cep, Identificação, Nome, CPF, Número, E-mail, e Whatsapp!";

                    break;
                }

            case 4:
                $guzzle = new \GuzzleHttp\Client();

                $response = $guzzle->request('GET', 'https://sandbox.asaas.com/api/v3/payments/'.$this->paymentAssas->id.'/pixQrCode', [
                    'headers' => [
                      'accept' => 'application/json',
                      'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzM4NzE6OiRhYWNoX2YyOTFlZWQ1LTVmNDMtNDM4My04ODAwLWNhYzJkMDI0YWE3Yg==',
                    ],
                ]);

                $this->pixQrcode = json_decode($response->getBody()->getContents());

                $this->stageOneDisplay = 'none';
                $this->stageTwoDisplay = 'none';
                $this->stageThreeDisplay = 'none';
                $this->stageFourDisplay = 'flex';
                $this->stageFiveDisplay = 'none';

                break;

            case 5:
                $this->stageOneDisplay = 'none';
                $this->stageTwoDisplay = 'none';
                $this->stageThreeDisplay = 'none';
                $this->stageFourDisplay = 'none';
                $this->stageFiveDisplay = 'flex';

                Session::forget('shipping');
                Session::forget('cart');

                break;
        }
    }

    //Shipping Functions
    public function findAdress() {
        if(strlen($this->zipcode) === 9) {
            $this->zipcode = preg_replace(pattern: '/[^0-9]/im', replacement: '', subject: $this->zipcode);

            $url = "https://viacep.com.br/ws/{$this->zipcode}/json/";

            $address = Http::get($url)->object();

            if(!$address || isset($address->erro) && $address->erro) {
                $this->cepError = "Cep inválido";

                $this->street = "";
                $this->district = "";

                return;
            }

            else {
                $this->cepError = "";

                $this->street = $address->logradouro;
                $this->district = $address->bairro;
                $this->city = $address->localidade;
            }
        }
    }

    public function calcDistance () {
        $geoInfo = Http::get("https://maps.googleapis.com/maps/api/geocode/json?address={$this->zipcode}&key=".env('MAPS_API_KEY')."")->object();

        $this->compiledAddress = $geoInfo->results[0]->formatted_address;

        $businessLat = -30.025698405150074;
        $businessLng = -51.057515308012555;

        $latTo = $geoInfo->results[0]->geometry->location->lat;
        $lngTo  = $geoInfo->results[0]->geometry->location->lng;

        $client = new Client();

        // Definindo o carimbo de data/hora para uma hora à frente do momento atual
        $departureTime = Carbon::now()->addHour()->toIso8601String();

        $response = $client->post('https://routes.googleapis.com/directions/v2:computeRoutes', [
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Goog-Api-Key' => env('MAPS_API_KEY'),
                'X-Goog-FieldMask' => 'routes.duration,routes.distanceMeters,routes.polyline.encodedPolyline'
            ],
            'json' => [
                'origin' => [
                    'location' => [
                        'latLng' => [
                            'latitude' => $businessLat,
                            'longitude' => $businessLng
                        ]
                    ]
                ],
                'destination' => [
                    'location' => [
                        'latLng' => [
                            'latitude' => $latTo,
                            'longitude' => $lngTo
                        ]
                    ]
                ],
                'travelMode' => 'TWO_WHEELER',
                'routingPreference' => 'TRAFFIC_AWARE',
                'departureTime' => '2023-10-15T15:01:23.045123456Z',
                'computeAlternativeRoutes' => false,
                'routeModifiers' => [
                    'avoidTolls' => false,
                    'avoidHighways' => false,
                    'avoidFerries' => false
                ],
                'languageCode' => 'pt-BR',
                'units' => 'IMPERIAL',
                'departureTime' => $departureTime,
            ]
        ]);

        $body = $response->getBody();
        $result = json_decode($body);

        //Dividindo o valor trazido em metros pela API para ficar em KM
        //Dividindo por 25 por que é a quilometragem que uma moto faz com 1L
        //Multiplicando por 6 por que é preço da gasolina
        //Adicionando 5 reais de comissão

        $shippingPrice = ($result->routes[0]->distanceMeters / 1000) / 25 * 6 + 5;

        if($shippingPrice <= 10) {
            return 10;
        }else {
            return $shippingPrice;
        }
    }

    public function changePaymentType($type) {
        $this->paymentType = $type;
    }

    public function changeMobilePaymentTab($type) {
        if($type == "site") {
            $this->mobilePaymentSiteTab = "block";
            $this->mobilePaymentHomeTab = "none";
        }

        else {
            $this->mobilePaymentSiteTab = "none";
            $this->mobilePaymentHomeTab = "block";
        }
    }

    public function formatCurrency() {
        // Remove todos os caracteres que não sejam dígitos ou pontos decimais
        $this->valueBack = preg_replace("/[^0-9,.]/", "", $this->valueBack);

        // Converte a string para um número de ponto flutuante
        $this->valueBack = (float) str_replace(',', '.', $this->valueBack);

        // Verifica se o valor é um número
        if (is_numeric($this->valueBack)) {
            // Formata o valor para Real brasileiro
            $this->valueBack = 'R$ ' . number_format($this->valueBack, 2, ',', '.');
        }
    }

    public function changeOrderType($type)
    {
        // Recupere a sessão atual de envio (shipping).
        $shippingInfo = session('shipping');

        if ($type === 'delivery' && $this->deliveryOrder) {
            $this->deliveryOrder = false;
            $this->tableOrder = true;

            // Atualize o valor de shipping_value.
            $shippingInfo['shipping_value'] = 0;
            // Salve novamente o array atualizado na sessão.
            session(['shipping' => $shippingInfo]);
        } elseif ($type === 'table' && $this->tableOrder) {
            $this->tableOrder = false;
            $this->deliveryOrder = true;

            $shippingInfo['shipping_value'] = $this->calcDistance();
            // Salve novamente o array atualizado na sessão.
            session(['shipping' => $shippingInfo]);
        } else {
            if ($type === 'delivery') {
                $this->deliveryOrder = true;
                $this->tableOrder = false;

                $shippingInfo['shipping_value'] = $this->calcDistance();
                // Salve novamente o array atualizado na sessão.
                session(['shipping' => $shippingInfo]);
            } elseif ($type === 'table') {
                $this->tableOrder = true;
                $this->deliveryOrder = false;

                // Atualize o valor de shipping_value.
                $shippingInfo['shipping_value'] = 0;
                // Salve novamente o array atualizado na sessão.
                session(['shipping' => $shippingInfo]);
            }
        }
    }

    public function finalizePurchase() {
        $this->orderType = $this->deliveryOrder ? 'Delivery' : ($this->tableOrder ? 'Mesa' : '');
        //VERIFICAR SE O CLIENTE JÁ EXISTE
        $clientData = UserHandler::clientExists($this->email);

        $guzzle = new \GuzzleHttp\Client();

        if($clientData == null) {
            //CRIAR O CLIENTE NO ASSAS
            $body = [
                'name' => $this->clientName,
                'cpfCnpj' => $this->clientCpf,
                'email' => $this->email,
                'mobilePhone' => $this->whatsapp,
                'address' => $this->street,
                'addressNumber' => $this->number,
                'complement' => $this->complement,
                'province' => $this->district,
                'postalCode' => $this->zipcode
            ];

            $response = $guzzle->request('POST', 'https://sandbox.asaas.com/api/v3/customers', [
                'body' => json_encode($body),
                'headers' => [
                    'accept' => 'application/json',
                    'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzM4NzE6OiRhYWNoX2YyOTFlZWQ1LTVmNDMtNDM4My04ODAwLWNhYzJkMDI0YWE3Yg==',
                    'content-type' => 'application/json',
                ],
            ]);

            $this->userAssas = json_decode($response->getBody()->getContents());

            //COM O RETORNO DO ASSAS CRIAR O CLIENTE NO MEU BANCO DE DADOS
            $clientData = [
                "image_id" => 1,
                "name" => $this->clientName,
                "username" => 'cliente@'.$this->userAssas->id,
                "cpf" => $this->clientCpf,
                "customer_id" => $this->userAssas->id,
                "email" => $this->email,
                "phone" => $this->whatsapp,
                "password" => "",
                "status" => "Desativado",
                "permission_id" => "3"
            ];

            $clientData = User::create($clientData);

            //APÓS CRIAR O CLIENTE, CRIAR O ENDEREÇO DELE NA TABELA ADDRESS
            Adresses::create([
                "cep" => $this->zipcode,
                "address" => $this->compiledAddress,
                'complement' => $this->complement,
                'user_id' => $clientData->id,
            ]);
        }

        //CRIAR A COBRANÇA NO ASSAS EM CASO DE PIX
        $orderNumber = '#'.rand(11111, 99999);
        $value = $this->calculateTotal();
        $dueDate = Carbon::now()->addDay();
        $orderType = $this->deliveryOrder ? 'Delivery' : 'Mesa';
        $shippingInfo = session('shipping');

        if($this->paymentType == 'pix') {
            $response = $guzzle->request('POST', 'https://sandbox.asaas.com/api/v3/payments', [
                'body' => '{"billingType":"PIX","value":'.$value.',"dueDate":"'.$dueDate.'","description":"Pedido '.$orderNumber.'","postalService":false, "customer":"'.$clientData->customer_id.'"}',
                'headers' => [
                'accept' => 'application/json',
                'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzM4NzE6OiRhYWNoX2YyOTFlZWQ1LTVmNDMtNDM4My04ODAwLWNhYzJkMDI0YWE3Yg==',
                'content-type' => 'application/json',
                ],
            ]);

            //RECUPERAR A COBRANÇA DO ASSAS E COM ISSO MOSTRAR O QRCODE DE PIX
            $this->paymentAssas = json_decode($response->getBody()->getContents());

            $this->changeCartStage(4);

            $orderData = [
                "code" => $orderNumber,
                "order_city" => $this->city,
                "payment_type" => $this->paymentAssas->billingType,
                "type" => $orderType,
                "status" => $this->paymentAssas->status,
                "total_amount" => $this->calculateTotal(),
                "shipping_amount" => $shippingInfo['shipping_value'],
                "payment_id" => $this->paymentAssas->id,
                "costumer_id" => $this->paymentAssas->customer,
                "user_id" => $clientData->id
            ];
        }

        else {
            $orderData = [
                "code" => $orderNumber,
                "order_city" => $this->city,
                "payment_type" => $this->paymentType,
                "type" => $orderType,
                "status" => 'PENDING',
                "total_amount" => $this->calculateTotal(),
                "shipping_amount" => $shippingInfo['shipping_value'],
                "costumer_id" => $clientData->customer_id,
                "user_id" => $clientData->id
            ];
        }

        //CRIAR A ORDER NO BANCO DE DADOS
        $order = Order::create($orderData);

        //CRIAR OS PRODUTOS VENDIDOS NA TABLEA PURCHASED_PRODUCTS
        foreach (session('cart') as $product) {
            $purchasedProduct = [
                "quantity" => $product['quantity'],
                "order_id" => $order->id,
                "product_id" => $product['id']
            ];

            PurchasedProducts::create($purchasedProduct);

            //CRIAR OS ADDONS VENDIDOS NA TABLEA PURCHASED_ADDONS

            if(!empty($product['addons'])) {
                foreach ($product['addons'] as $addon) {
                    $purchasedAddons = [
                        "quantity" => $addon['quantity'],
                        "addons_price" => $addon['price'] * $addon['quantity'],
                        "product_id" => $addon['id'],
                        "order_id" => $order->id,
                        "product_addons_id" => $addon['id'],
                        "product_id" => $product['id']
                    ];

                    PurchasedProductAddons::create($purchasedAddons);
                }
            }
        }

        if($this->paymentType == 'card' || $this->paymentType == 'money') {
            $this->changeCartStage(5);
        }
    }
}

