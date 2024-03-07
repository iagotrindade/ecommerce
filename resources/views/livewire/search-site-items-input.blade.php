<div class="default-flex">
    <div class="search-wrapper">
        <div class="site-search-input default-flex" style="width: 600px;">
            <input type="text" name="search" id="search" placeholder="Pesquisar" wire:model="searchTerm" style="border-bottom-right-radius: {{$border}}; border-bottom-left-radius: {{$border}}" wire:keyup="searchSiteProduct()">
        </div>

        <div class="site-search-container" id="notificationContainer" style="display: {{$display}}; border-top-left-radius: {{$border}}; border-bottom-right-radius: {{$border}}">
            <div class="search-list">
                <div class="search-result-item">
                    <div class="search-result-title-area default-flex-start">
                        <i class='bx bx-package'></i>
                        <p>Produtos</p>
                    </div>

                    @foreach ($products as $product)
                        <div class="search-result-item-list default-flex-column" >
                            <a wire:click="redirectToHomeSearch({{$product->id}})">{{$product->name}}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
