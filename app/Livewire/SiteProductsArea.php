<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Handlers\AuthHandler;
use Illuminate\Support\Arr;
use Illuminate\View\Middleware\ShareErrorsFromSession;


class SiteProductsArea extends Component
{
    public $categories;
    public $products;
    public $filterCategory;
    public $favorites;
    public $user = '';
    public $chosenProduct;
    public $chosenProductQuantity = 1;
    public $chosenAddons = [];
    public $addonQuantities = [];
    public $addonsModalDisplay = 'none';
    public $cart = [];
    public $cartIds;
    public $cartCount;
    public $searchProduct;
    public $mobileSearchProducts;

    public function render()
    {
        if(Auth::check()) {
            $this->user =  AuthHandler::getAuthUser();
            $this->favorites = $this->user->favorites->pluck('product_id')->toArray();
        }

        if(session('cart')) {
            $this->cartCount = count(session('cart'));
        }

        $this->cartIds = collect(session('cart', []))->pluck('id')->toArray();;

        $this->categories = Categories::orderBy('order_number')->get();

        if(empty($this->searchProduct)) {
            if(empty($this->filterCategory)) {
                $this->filterCategory = Categories::where('order_number', '1')->first();
            }

            if(session('searchProduct')) {
                $this->products = session('searchProduct');

                Session::forget('searchProduct');
            }

            if(empty($this->products)) {
                $this->products = Product::where('status', 'Ativado')->
                                            where('categories_id', $this->filterCategory->id)
                                        ->get();
            }
        }

        else {
            $this->filterCategory = $this->searchProduct->category;
            $this->products = $this->searchProduct;
        }


        if(session('cart') && count(session('cart')) >= 1) {
            $this->dispatch('updateCart', count(session('cart')));
        } else {
            $this->dispatch('updateCart', '');
        }

        return view('livewire.site-products-area', [
            'categories' => $this->categories,
            'favorites' => $this->favorites,
            'filterCategory' => $this->filterCategory,
            'mobileSearchProducts' => $this->mobileSearchProducts
        ]);
    }

    #[On('searchSiteProducts')]
    public function mobileSearchAction($searchTerm) {
        if($searchTerm != "") {
            $this->mobileSearchProducts = Product::where('name', 'like', ''.$searchTerm.'%')
                                        ->where('status', 'Ativado')
                                    ->get();
        }

        else {
            $this->mobileSearchProducts = "";
        }
    }

    public function filterProducts($categoryId) {
        $this->products = Product::where('categories_id', $categoryId)->
                                    where('status', 'Ativado')
                                ->get();
        $this->filterCategory = Categories::find($categoryId);
    }

    #[On('favoriteProduct')]
    public function favoriteProduct($productId) {
        if(Auth::check()) {
            
            $existingFavorite = Favorite::where('user_id', $this->user->id)
                ->where('product_id', $productId)
                ->first();
            if($existingFavorite) {
                $existingFavorite->delete();
            } else {
                Favorite::create([
                    'user_id' => $this->user->id,
                    'product_id' => $productId
                ]);
            }

            $this->favorites = $this->user->favorites;
        }
    }

    public function openAddonsModal($id) {
        if($this->chosenProduct != Product::find($id)) {
            $this->chosenProductQuantity = 1;
            $this->chosenAddonQuantities = 0;
        }
        $this->chosenProduct = Product::find($id);

        if (!$this->chosenProduct) {
            abort(404);
        }

        if($this->addonsModalDisplay == 'none') {
            $this->addonsModalDisplay = 'block';
        }

        else {
            $this->addonsModalDisplay = 'none';
        }
    }

    public function closeAddonsModal() {
        // Limpe as variáveis de controle de quantidade.
        $this->chosenProductQuantity = 1;
        $this->addonQuantities = [];

        $this->addonsModalDisplay = 'none';
    }

    public function alterProductQuantity($action)
    {
        if ($action === '-') {
            $this->chosenProductQuantity = max(1, $this->chosenProductQuantity - 1);
        } elseif ($action === '+') {
            $this->chosenProductQuantity++;
        }
    }

    public function alterAddonQuantity($chosenProduct, $addon, $action)
    {
        $addonKey = $addon['id'];

        if ($action === '-') {
            $this->addonQuantities[$addonKey] = max(0, ($this->addonQuantities[$addonKey] ?? 0) - 1);
        } elseif ($action === '+') {
            $this->addonQuantities[$addonKey] = ($this->addonQuantities[$addonKey] ?? 0) + 1;
        }
    }

    public function updateCart()
    {
        // Atualize a quantidade do produto no carrinho.
        $cartItem = [
            'id' => $this->chosenProduct->id,
            'category' => $this->chosenProduct->category->name,
            'product_sku' => rand(10000, 90000),
            'product' => $this->chosenProduct,
            'quantity' => $this->chosenProductQuantity,
            'price' => $this->chosenProduct->price, // Substitua pelo campo de preço real do modelo.
            'addons' => [],
        ];

        // Adicione os addons selecionados ao item do carrinho.
        foreach ($this->chosenProduct->addons as $addon) {
            $addonKey = $addon->id; // Substitua pelo campo chave primária real do modelo de adicional.
            $addonQuantity = $this->addonQuantities[$addonKey] ?? 0;

            if ($addonQuantity > 0) {
                $cartItem['addons'][] = [
                    'id' => $addon->id,
                    'addon_sku' => rand(10000, 90000),
                    'name' => $addon->name,
                    'quantity' => $addonQuantity,
                    'price' => $addon->price, // Substitua pelo campo de preço real do modelo de adicional.
                ];
            }
        }

        // Recupere o carrinho da sessão, ou inicialize um array vazio se não existir.
        $cart = session('cart', []);

        $cart[] = $cartItem;

        // Salve o carrinho na sessão.
        session(['cart' => $cart]);

        // Limpe as variáveis de controle de quantidade.
        $this->chosenProductQuantity = 1;
        $this->addonQuantities = [];

        // Feche o modal ou execute outras ações necessárias.
        $this->closeAddonsModal();
    }

    #[On('removeFromCart')]
    public function removeFromCart($productId)
    {
        // Recupere o carrinho da sessão, ou inicialize um array vazio se não existir.
        $cart = session('cart', []);

        // Filtrar o carrinho para remover o item com o ID do produto correspondente.
        $cart = array_filter($cart, function ($cartItem) use ($productId) {
            return $cartItem['id'] !== $productId;
        });

        // Salve o carrinho atualizado na sessão.
        session(['cart' => $cart]);
    }

    #[On('searchSiteProduct')]
    public function searchSiteProduct($searchProduct)
    {
        if (is_int($searchProduct)) {
            $this->searchProduct = Product::where('id', $searchProduct)->where('Status', 'Ativado')->get();
        } else {
            $this->products = Product::where('name', 'like', '%'.$searchProduct.'%')->where('Status', 'Ativado')->get();
        }
    }
}
