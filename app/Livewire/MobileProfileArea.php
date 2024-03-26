<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Models\Adresses;
use App\Models\Order;
use App\Models\Favorite;
use App\Models\Product;
use App\Http\Handlers\OrderHandler;

class MobileProfileArea extends Component
{
    public $profileWarning = '';

    //User properties
    public $user;
    public $userOrders;
    public $userFavorites;
    public $favorites;

    public $userName;
    public $userUsername;
    public $userEmail;
    public $userPhone;
    public $userPassword;
    public $userNewPassword;

    //Display properties
    public $profileDisplay = "none";
    public $myDataDisplay = "none";
    public $myOrdersDisplay = "none";
    public $myFavoritesDisplay = "none";
    public $newAddressDisplay = "none";

    //Addreses properties

    public $compiledAddress = '';
    public $zipcode = '';
    public $name = '';
    public $email = '';
    public $street = '';
    public $number = '';
    public $complement = '';
    public $district = '';
    public $reference = '';
    public $cepError = '';
    public $inputsError = '';

    #[On('updateFavoritesList')]
    public function render()
    {


        if(Auth::check()) {
            $this->userName = $this->user->name;
            $this->userUsername = $this->user->username;
            $this->userEmail = $this->user->email;
            $this->userPhone = $this->user->phone;
            $this->favorites = $this->user->favorites->pluck('product_id')->toArray();

            if($this->user->orders->isNotEmpty()) {
                $this->userOrders = OrderHandler::processOrdersInfo($this->user->orders);
            }
        }



        return view('livewire.mobile-profile-area');
    }

    #[On('openProfileTab')]
    public function showProfileTab() {
        if($this->profileDisplay == "none") {
            $this->profileDisplay = "block";
        }

        else {
            $this->profileDisplay = "none";
        }
    }

    public function mount($user)
    {
        $this->user = $user;
    }

    public function showMyDataTab() {
        if($this->myDataDisplay == "block") {
            $this->myDataDisplay = "none";
        } else {
            $this->myDataDisplay = "block";
        }

        $this->myOrdersDisplay = "none";
        $this->myFavoritesDisplay = "none";
    }

    public function showMyOrdersTab() {
        if($this->myOrdersDisplay == "block") {
            $this->myOrdersDisplay = "none";
        } else {
            $this->myOrdersDisplay = "block";
        }

        $this->myDataDisplay = "none";
        $this->myFavoritesDisplay = "none";
    }

    public function showMyFavoritesTab() {
        if($this->myFavoritesDisplay == "block") {
            $this->myFavoritesDisplay = "none";
        } else {
            $this->myFavoritesDisplay = "block";
        }

        $this->myDataDisplay = "none";
        $this->myOrdersDisplay = "none";
    }

    public function showAddNewAddress() {
        if($this->newAddressDisplay == "block") {
            $this->newAddressDisplay = "none";
        } else {
            $this->newAddressDisplay = "block";
        }
    }

    public function updateUserData() {
        if(!empty($this->userName) && !empty($this->userUsername) && !empty($this->userEmail) && !empty($this->userPhone) && !empty($this->userPassword)) {
            if(Hash::check($this->userPassword, $this->user->password)) {
                $this->userNewPassword = empty($this->userNewPassword) ? $this->user->password : Hash::make($this->userNewPassword);

                $this->user->update([
                    "name" => $this->userName,
                    "username" => $this->userUsername,
                    "email" => $this->userEmail,
                    "phone" => $this->userPhone,
                    "password" => $this->userNewPassword
                ]);

                $this->user->save();

                $this->userNewPassword = "";
                $this->profileWarning = "Os seus dados foram atualizados!";
            }
        }

        else {
            $this->profileWarning = "Preencha todos os campos!";
        }
    }

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

    public function addNewAddress() {
        if($this->zipcode != "" && $this->name != "" && $this->street != "" && $this->number != "" && $this->district != "") {

            $this->compiledAddress = $this->street.', '. $this->number.' - '.$this->district.', '.$this->zipcode;

            Adresses::create([
                "cep" => $this->zipcode,
                "address" => $this->compiledAddress,
                'complement' => $this->complement,
                'user_id' => $this->user->id,
            ]);

            $this->profileWarning = 'Endereço adicionado com Sucesso!';
            $this->showAddNewAddress();
        }

        else {
            $this->inputsError = "Preencha os Campos Cep, Identificação, Número";
        }

    }

    public function deleteAddress($id) {
        if($id) {
            Adresses::where('id', $id)->delete();
        }
    }

    public function favoriteProduct($id) {
        $this->dispatch("favoriteProduct", $id);

        $this->profileWarning = "Lista de favoritos alterada com sucesso!";

        $this->dispatch("updateFavoritesList");
    }

    public function openAddonsModal($id) {
        $this->dispatch("openAddonsModal", $id);
    }
}
