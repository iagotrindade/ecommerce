<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;
use App\Models\Adresses;

class MobileProfileArea extends Component
{   
    public $user;
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

    public $addAddressWarning = '';

    public function render()
    {
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

            $this->addAddressWarning = 'Endereço adicionado com Sucesso!';
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
}
