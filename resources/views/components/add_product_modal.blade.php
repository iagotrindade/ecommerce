<div class="modal-filter" id="modalFilter"></div>

<div class="add-product-modal-area default-flex">
    <form method="POST" action="{{route('product.new')}}" id="product-form" enctype="multipart/form-data">
        @csrf
        <div class="add-product-modal default-flex-column">
            <div class="new-product-top-area default-flex-between">
                <h2>Novo produto</h2>

                <div class="switch-container" style="margin: 0">
                    <input id="switch-shadow" class="switch switch--shadow" type="checkbox" name="status">
                    <label for="switch-shadow"></label>
                </div>
            </div>

            <div>
                <input class="category-id-input" type="hidden" name="categories_id">

                <div class="select-tab-area default-flex-start">
                    <h3 class="active-tab">Detalhes</h3>
                    <h3>Complementos</h3>
                </div>

                <div class="product-info-input-area default-flex-between">
                    <div class="product-inputs-left default-flex-column">
                        <input type="text" name="name" id="" placeholder="Nome">

                        <div class="description-area default-flex-column">
                            <label for="description">Descrição</label>
                            <textarea name="description" id="description" cols="30" rows="10"></textarea>
                        </div>

                        <div class="pricing-area default-flex-start">
                            <div class="pricing-input-area default-flex-column">
                                <label for="price">Preço (obrigatório)</label>
                                <input type="text" name="price" id="price" placeholder="R$ 0.00">
                            </div>

                            <div class="discount-input-area default-flex-column">
                                <label class="default-flex" for="discount">
                                    Desconto
                                    <div class="switch-container" style="margin: 0; margin-left: 10px;">
                                        <input id="switch-shadow-discount" class="switch switch--shadow" type="checkbox" name="discount_status">
                                        <label for="switch-shadow-discount"></label>
                                    </div>
                                </label>
                                <input type="text" name="discount" id="discount" placeholder="R$ 0.00" class="discount-field">
                            </div>
                        </div>
                    </div>

                    <div class="product-inputs-right">
                        <h4>Imagem do Produto</h4>

                        <div class="upload-product-area default-flex-column" id="uploadArea">
                            <input type="file" style="display: none" id="imageInput" name="image">
                            <label class="default-flex-column" for="imageInput" id="uploadLabel">
                                <img src="{{url('assets/images/panel-icons/upload_product_image_icon.png')}}" alt="Enviar Imagem">
                                <p>
                                    Clique aqui para fazer o Upload
                                </p>
                            </label>
                        </div>

                        <ul class="image-warnings">
                            <li>Tamanho Máximo - 20MB</li>
                            <li>Formatos - JPEG, JPG, PNG</li>
                            <li>Resolução Mínima - 300x275 </li>
                        </ul>
                    </div>
                </div>

                <div class="complements-info-area">
                    <div class="complements-inputs-area">
                        <input type="hidden" name="complementData" id="complementDataInput">
                        <div class="complement-item default-flex-between">
                            <input type="text" name="complementName[]" id="complementNames" placeholder="Nome do complemento">

                            <div class="complement-price-input-area default-flex-column">
                                <label for="complementPrice">Preço*</label>
                                <input type="text" name="complementPrice[]" id="complementPrice" placeholder="R$ 0,00">
                            </div>
                        </div>
                    </div>

                    <div class="add-new-complement default-flex-start">
                        <p class="plus-icon default-flex">+</p>
                        <p class="plus-text">Adicionar complemento</p>
                    </div>
                </div>

                <div class="product-buttons-area default-flex-start">
                    <x-buttons.default_primary_button tag="button" type="submit" text="Finalizar"></x-buttons.default_primary_button>
                    <a class="discart-product-button default-flex" href="{{route('carte')}}">Descartar</a>
                </div>
            </div>
        </div>
    </form>
</div>


