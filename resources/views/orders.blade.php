<x-adm_layout title="Pedidos" activeMenu="orders" userName="{{$authUser->name}}" userImage="{{$authUser->image}}" pastSearchFunction="searchOrders">
    <livewire:orders-table lazy/>
</x-adm_layout>
