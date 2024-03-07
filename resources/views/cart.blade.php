<x-site.site_layout title="Carrinho" activeMenu="cart" :user="$user">
    <livewire:cart-area/>
    <script>
        function formatCEP(input) {
            input.value = input.value.replace(/\D/g, '').slice(0, 8).replace(/(\d{5})(\d{0,3})/, '$1-$2');
        }
    </script>
</x-site.site_layout>
