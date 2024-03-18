<div class="site-main-area">
    <section class="site-categories-area">
        <ul class="site-categories-list default-flex">

            @foreach ($categories as $category)
                <li class="site-category-item @if($filterCategory->id === $category->id) site-category-item-active @endif"  wire:click="filterProducts({{$category->id}})">
                    {{$category->name}}
                </li>
            @endforeach
        </ul>
    </section>

    <livewire:site-mobile-search/>

    <main class="site-products-area">
        <div class="desktop-carte-area">
            @if (!empty($products))
                @foreach ($products as $product)
                    <div class="site-product-item default-flex-start">
                        <div class="site-product-image-area default-flex" wire:click="openAddonsModal({{$product->id}})">
                            <img src="{{url("storage/{$product->image->name}")}}" alt="Imagem do Produto">
                        </div>

                        <div class="site-products-texts default-flex-column-start" wire:click="openAddonsModal({{$product->id}})">
                            <h3>{{$product->name}}</h3>

                            <p class="default-flex-column-end">{{$product->description}}</p>
                        </div>

                        <div class="site-products-actions default-flex-column-between">
                            @if(Auth::check() && in_array($product->id, $favorites))
                                <i class='bx bxs-star' wire:click="favoriteProduct({{$product->id}})"></i>
                            @else
                                <i class='bx bx-star' wire:click="favoriteProduct({{$product->id}})"></i>
                            @endif

                            <div class="site-product-price default-flex-end" wire:click="openAddonsModal({{$product->id}})">
                                R$ {{$product->price}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>


        <div class="mobile-carte-area">
            @if ($mobileSearchProducts != "")
                @foreach ($categories as $category)
                    <h3 class="mobile-category-name">{{$category->name}}</h3>

                    @foreach ($mobileSearchProducts as $product)
                        @if ($product->categories_id == $category->id)
                            <div class="site-product-item default-flex-start">
                                <div class="site-product-image-area default-flex" wire:click="openAddonsModal({{$product->id}})">
                                    <img src="{{url("storage/{$product->image->name}")}}" alt="Imagem do Produto">
                                </div>

                                <div class="site-products-texts default-flex-column-start" wire:click="openAddonsModal({{$product->id}})">
                                    <h3>{{$product->name}}</h3>

                                    <p class="default-flex-column-end">{{$product->description}}</p>
                                </div>

                                <div class="site-products-actions default-flex-column-between">
                                    @if(Auth::check() && in_array($product->id, $favorites))
                                        <i class='bx bxs-star' wire:click="favoriteProduct({{$product->id}})"></i>
                                    @else
                                        <i class='bx bx-star' wire:click="favoriteProduct({{$product->id}})"></i>
                                    @endif

                                    <div class="site-product-price default-flex-end" wire:click="openAddonsModal({{$product->id}})">
                                        R$ {{$product->price}}
                                    </div>
                                </div>
                            </div>
                        @endif

                    @endforeach
                @endforeach
            @else
                @foreach ($categories as $category)
                    <h3 class="mobile-category-name">{{$category->name}}</h3>
                    @foreach ($category->products as $product)
                        <div class="site-product-item default-flex-start">
                            <div class="site-product-image-area default-flex" wire:click="openAddonsModal({{$product->id}})">
                                <img src="{{url("storage/{$product->image->name}")}}" alt="Imagem do Produto">
                            </div>

                            <div class="site-products-texts default-flex-column-start" wire:click="openAddonsModal({{$product->id}})">
                                <h3>{{$product->name}}</h3>

                                <p class="default-flex-column-end">{{$product->description}}</p>
                            </div>

                            <div class="site-products-actions default-flex-column-between">
                                @if(Auth::check() && in_array($product->id, $favorites))
                                    <i class='bx bxs-star' wire:click="favoriteProduct({{$product->id}})"></i>
                                @else
                                    <i class='bx bx-star' wire:click="favoriteProduct({{$product->id}})"></i>
                                @endif

                                <div class="site-product-price default-flex-end" wire:click="openAddonsModal({{$product->id}})">
                                    R$ {{$product->price}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            @endif
        </div>

        @if(!empty($chosenProduct))
            <div class="addons-modal-filter" id="modalFilter" style="display: {{$addonsModalDisplay}}" wire:click="closeAddonsModal"></div>

            <section class="edit-addons-modal" style="display: {{$addonsModalDisplay}}">
                <div class="edit-addons-modal-image">
                    <div class="mobile-back-button default-flex" wire:click="closeAddonsModal">
                        <i class='bx bx-chevron-left'></i>
                    </div>
                    <img src="{{url("storage/{$chosenProduct->image->name}")}}" alt="Imagem do Produto">
                </div>

                <div class="edit-addons-modal-top">
                    <h3>{{$chosenProduct->name}}</h3>

                    <p>{{$chosenProduct->description}}</p>

                    <div class="default-flex-between">
                        <p>{{$chosenProduct->price}}</p>

                        <div class="chosen-product-item-quantity default-flex-between">
                            <p class="chosen-product-action-button" wire:click="alterProductQuantity('-')">-</p>
                            <p class="chosen-product-item-number" id="product-number{{$chosenProduct->id}}">{{$chosenProductQuantity}}</p>
                            <p class="chosen-product-action-button" wire:click="alterProductQuantity('+')">+</p>
                        </div>
                    </div>
                </div>

                <div class="edit-addons-modal-bottom">
                    <h3>Acréscimos</h3>

                    @foreach ($chosenProduct->addons as $addon)
                        <div class="chosen-product-addon default-flex-between">
                            <div class="chosen-product-addon-name-price default-flex-column">
                                <p class="chosen-product-addon-name">{{$addon->name}}</p>
                                <p class="chosen-product-addon-price">+ R$ {{$addon->price}}</p>
                            </div>

                            <div class="chosen-product-item-quantity default-flex-between">
                                <p class="chosen-product-action-button" wire:click="alterAddonQuantity({{$chosenProduct}}, {{$addon}},'-', {{$addon}})">-</p>
                                <p class="chosen-product-item-number" id="addonQuantity{{$chosenProduct->id}}{{$addon->id}}">{{$addonQuantities[$addon->id] ?? 0}}</p>
                                <p class="chosen-product-action-button" wire:click="alterAddonQuantity({{$chosenProduct}}, {{$addon}},'+', {{$addon}})">+</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="confirm-add-product-button default-flex-end">
                    <p class="default-flex" wire:click="updateCart()">Confirmar</p>
                </div>
            </section>
        @endif
    </main>
</div>
