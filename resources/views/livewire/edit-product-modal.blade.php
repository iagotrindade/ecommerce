<div>
    <div class="modal-filter" id="modalFilter" style="display: {{$display}}"></div>

    <div class="edit-product-modal-area default-flex" style="display: {{$display}}">
        <form method="POST" action="{{route('product.edit')}}" id="edit-product-form" enctype="multipart/form-data">
            @csrf
            <div class="edit-product-modal default-flex-column" style="display: {{$display}}">
                <div class="new-product-top-area default-flex-between">
                    <h2>Editar produto {{$product->name}}</h2>

                    <div class="switch-container" style="margin: 0">
                        <input id="status-product-switch-shadow" class="switch switch--shadow" type="checkbox" name="status" @if($product->status == 'Ativado') checked @endif>
                        <label for="status-product-switch-shadow"></label>
                    </div>
                </div>

                <div>
                    <input type="hidden" name="product_id" value="{{$product->id}}">

                    <input class="category-id-input" type="hidden" name="categories_id" value="{{$product->categories_id}}">

                    <div class="select-tab-area default-flex-start">
                        <h3 @if($detailsDisplay == "flex") class="active-tab" @endif wire:click="changeTab(event.target.innerHTML)">Detalhes</h3>
                        <h3 @if($complementsDisplay == "block") class="active-tab" @endif wire:click="changeTab(event.target.innerHTML)">Complementos</h3>
                    </div>

                    <div class="product-info-input-area default-flex-between" style="display: {{$detailsDisplay}}">
                        <div class="product-inputs-left default-flex-column">
                            <input type="text" name="name" id="" placeholder="Nome" value="{{$product->name}}">

                            <div class="description-area default-flex-column">
                                <label for="description">Descrição</label>
                                <textarea name="description" id="description" cols="30" rows="10">{{$product->description}}</textarea>
                            </div>

                            <div class="pricing-area default-flex-start">
                                <div class="pricing-input-area default-flex-column">
                                    <label for="price">Preço (obrigatório)</label>
                                    <input type="text" name="price" id="editPrice" placeholder="R$ 0.00" value="{{$product->price}}">
                                </div>

                                <div class="discount-input-area default-flex-column">
                                    <label class="default-flex" for="discount">
                                        Desconto
                                        <div class="switch-container" style="margin: 0; margin-left: 10px;">
                                            <input id="edit-switch-shadow-discount" class="switch switch--shadow" type="checkbox" name="discount_status" @if($product->discount_status == 'Ativado') checked @endif>
                                            <label for="edit-switch-shadow-discount"></label>
                                        </div>
                                    </label>
                                    <input type="text" name="discount" id="editDiscount" placeholder="R$ 0.00" class="discount-field" value="{{$product->discount}}">
                                </div>
                            </div>
                        </div>

                        <div class="product-inputs-right">
                            <h4>Imagem do Produto</h4>

                            <div class="upload-product-area default-flex-column" id="editUploadArea" style="background-image: url('{{url("storage/{$product->image->name}")}}')">
                                <input type="file" style="display: none" id="editImageInput" name="image">
                            </div>

                            <ul class="image-warnings">
                                <li>Tamanho Máximo - 20MB</li>
                                <li>Formatos - JPEG, JPG, PNG</li>
                                <li>Resolução Mínima - 300x275 </li>
                            </ul>
                        </div>
                    </div>

                    <div class="complements-info-area" style="display: {{$complementsDisplay}}">
                        <div class="complements-inputs-area">
                            <input type="hidden" name="editComplementData" id="editComplementDataInput">
                            @foreach ($product->addons as $addon)
                                <div class="complement-item default-flex-between" id="editComplementItem">
                                    <input type="text" name="editComplementName[]" id="complementNames" placeholder="Nome do complemento" value="{{$addon->name}}">

                                    <div class="complement-price-input-area default-flex-column">
                                        <label for="complementPrice">Preço*</label>
                                        <input type="text" name="editComplementPrice[]" id="complementPrice" placeholder="R$ 0,00" value="{{$addon->price}}">
                                    </div>
                                </div>
                            @endforeach

                            @foreach ($newAddons as $index => $addon)
                                <div class="complement-item default-flex-between" id="editComplementItem">
                                    <input type="text" name="editComplementName[]" id="complementNames" placeholder="Nome do complemento" value="{{$addon['name']}}">

                                    <div class="complement-price-input-area default-flex-column">
                                        <label for="complementPrice">Preço*</label>
                                        <input type="text" name="editComplementPrice[]" id="editComplementPrice" placeholder="R$ 0,00" value="{{$addon['price']}}">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="add-new-complement default-flex-start">
                            <p class="plus-icon default-flex">+</p>
                            <p class="plus-text" wire:click="addNewComplement">Adicionar complemento</p>
                        </div>
                    </div>

                    <div class="edit-product-buttons-area default-flex-start">
                        <x-buttons.default_primary_button tag="button" type="submit" text="Finalizar"></x-buttons.default_primary_button>
                        <a class="discart-product-button default-flex" href="{{route('product.delete', $product->id)}}" onclick="return confirmDel('Deseja realmente excluir o produto {{$product->name}}')">Descartar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script>

</script>
