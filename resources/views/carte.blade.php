<x-adm_layout title="Cardápio" activeMenu="carte" :user="$user">
    @php
        $errorMessages = $errors->any() ? $errors->all() : [];
    @endphp
    <livewire:carte-configurations :categories="$categories" :errorMessages="$errorMessages" :searchid="$searchId"/>
</x-adm_layout>
