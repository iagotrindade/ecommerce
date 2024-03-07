<div>
    <div class="carte-area">
        <div class="carte-top-area default-flex-between">
            <p class="add-category-button default-flex" onclick="openAddCategoryModal()">+ Criar Categoria</p>
            <p class="carte-config-button" wire:click="organizeCategories()">Organizar Cardápio</p>
        </div>

        @if ($errorMessages)
            @foreach ($errorMessages as $error)
                <p class="warning-item" style="padding-left: 13px">{{$error}}</p>
            @endforeach
        @endif

        <div class="carte-products-area" wire:ignore>
            <div class="category-items">
                @if (!empty($searchCategory))
                    <div class="category-top-area default-flex-between">
                        <h3>{{$searchCategory->name}}</h3>

                        <div class="action-buttons-area default-flex">
                            <p class="category-status-header">{{$searchCategory->status}}</p>

                            <p class="edit-category-button" wire:click="editCategory('{{$searchCategory->id}}')">Editar</p>

                            <i class='bx bxs-chevron-down toggle-items'></i>
                        </div>
                    </div>
                    <div class="products-area hidden">
                        <div class="product-item default-flex-between">
                            <div class="product-information default-flex-between">
                                <h4>{{$searchProduct->name}}</h4>

                                <p>
                                    {{$searchProduct->description}}
                                </p>

                                <img src="{{url('assets/images/panel-icons/upload_product_image_icon.png')}}" id="uploadImage" alt="Enviar Imagem" data-id="{{$searchProduct->id}}">
                            </div>

                            <div class="product-actions default-flex">
                                <div class="switch-container">
                                    <input id="switch-shadow-{{$searchProduct->id}}" class="switch switch--shadow" type="checkbox" wire:click="changeProductStatus({{$searchProduct->id}})" @if($searchProduct->status == 'Ativado') checked @endif>
                                    <label for="switch-shadow-{{$searchProduct->id}}"></label>
                                </div>
                                <p class="edit-product-button" wire:click='editProductModal({{$searchProduct->id}})'>Editar</p>
                            </div>
                        </div>
                    </div>


                    <div class="add-product-button-area default-flex-start">
                        <p class="default-flex" onclick="openAddProductModal({{$searchCategory->id}})">+ Adiconar Item</p>
                    </div>
                @else
                    @foreach ($categories as $category)
                        <div class="category-top-area default-flex-between">
                            <h3>{{$category->name}}</h3>

                            <div class="action-buttons-area default-flex">
                                <p class="category-status-header">{{$category->status}}</p>

                                <p class="edit-category-button" wire:click="editCategory('{{$category->id}}')">Editar</p>

                                <i class='bx bxs-chevron-down toggle-items'></i>
                            </div>
                        </div>
                        <div class="products-area hidden">
                            @foreach ($category->products as $product)
                                <div class="product-item default-flex-between">
                                    <div class="product-information default-flex-between">
                                        <h4>{{$product->name}}</h4>

                                        <p>
                                            {{$product->description}}
                                        </p>

                                        <img src="{{url('assets/images/panel-icons/upload_product_image_icon.png')}}" id="uploadImage" alt="Enviar Imagem" data-id="{{$product->id}}">
                                    </div>

                                    <div class="product-actions default-flex">
                                        <div class="switch-container">
                                            <input id="switch-shadow-{{$product->id}}" class="switch switch--shadow" type="checkbox" wire:click="changeProductStatus({{$product->id}})" @if($product->status == 'Ativado') checked @endif>
                                            <label for="switch-shadow-{{$product->id}}"></label>
                                        </div>

                                        <p class="edit-product-button" wire:click='editProductModal({{$product->id}})'>Editar</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="add-product-button-area default-flex-start">
                            <p class="default-flex" onclick="openAddProductModal({{$category->id}})">+ Adiconar Item</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <x-add_category_modal></x-add_category_modal>

        <livewire:edit-category-modal/>

        <livewire:categories-organizer/>

        <x-add_product_modal></x-add_product_modal>

        <livewire:edit-product-modal/>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const detalhesTab = document.querySelector('.select-tab-area h3:first-of-type');
                const complementosTab = document.querySelector('.select-tab-area h3:last-of-type');

                const detalhesArea = document.querySelector('.product-info-input-area');
                const complementosArea = document.querySelector('.complements-info-area');

                detalhesTab.addEventListener('click', function() {
                    detalhesArea.style.display = 'flex'; // Ou 'block' se preferir
                    detalhesTab.classList.add('active-tab');

                    complementosArea.style.display = 'none';
                    complementosTab.classList.remove('active-tab');
                });

                complementosTab.addEventListener('click', function() {
                    complementosArea.style.display = 'block'; // Ou 'block' se preferir
                    complementosTab.classList.add('active-tab');

                    detalhesArea.style.display = 'none';
                    detalhesTab.classList.remove('active-tab');
                });

                const switchDiscount = document.getElementById('switch-shadow-discount');
                const discountInput = document.getElementById('discount');

                function toggleDiscountInput() {
                    discountInput.disabled = !switchDiscount.checked;

                    if (discountInput.disabled) {
                        discountInput.classList.add('disabled'); // Adiciona a classe 'disabled' quando desabilitado
                    } else {
                        discountInput.classList.remove('disabled'); // Remove a classe 'disabled' quando habilitado
                    }
                }

                toggleDiscountInput();

                switchDiscount.addEventListener('change', toggleDiscountInput);

                document.querySelector('.add-new-complement').addEventListener('click', function() {
                    const newComplementItem = document.createElement('div');
                    newComplementItem.classList.add('complement-item', 'default-flex-between');
                    newComplementItem.innerHTML = `<input type="text" name="complementName[]" placeholder="Nome do complemento" id="complementNames"><input type="text" name="complementPrice[]" placeholder="R$ 0,00" id="complementPrice">`;

                    document.querySelector('.complements-inputs-area').appendChild(newComplementItem);

                    document.querySelectorAll('#complementPrice').forEach(element => {
                        element.addEventListener('input', function() {
                            formatCurrency(this);
                        });
                    });
                });


                //Enviar imagem ao criar um novo produto
                const imageInput = document.getElementById('imageInput');
                const uploadLabel = document.getElementById('uploadLabel');
                const uploadArea = document.getElementById('uploadArea');

                uploadLabel.addEventListener('click', function(event) {
                    if (event.target !== uploadLabel) return;
                    imageInput.click();
                });

                imageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            uploadArea.style.backgroundImage = `url('${e.target.result}')`;
                            uploadArea.style.backgroundSize = 'cover';
                            uploadLabel.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    }
                });

                uploadArea.addEventListener('click', function(event) {
                    if (event.target === uploadArea || event.target === uploadLabel) {
                        imageInput.click();
                    }
                });


                //Enviar imagem ao editar um produto
                const editImageInput = document.getElementById('editImageInput');
                const editUploadArea = document.getElementById('editUploadArea');

                editUploadArea.addEventListener('click', function(event) {
                    if (event.target !== editUploadArea) return;
                    editImageInput.click();
                });

                editImageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            editUploadArea.style.backgroundImage = `url('${e.target.result}')`;
                            editUploadArea.style.backgroundSize = 'cover';
                        }
                        reader.readAsDataURL(file);
                    }
                });


                //Criando o Array de informações de complementos ao criar um novo produto
                const form = document.getElementById('product-form');
                const sendDataBtn = document.querySelector('.product-buttons-area button');

                sendDataBtn.addEventListener('click', async function(event) {
                    event.preventDefault();

                    const complementNames = document.querySelectorAll('input[name="complementName[]"]');
                    const complementPrices = document.querySelectorAll('input[name="complementPrice[]"]');

                    const complementData = [];

                    complementNames.forEach((nameInput, index) => {
                        const name = nameInput.value;
                        const price = complementPrices[index].value;

                        if (name.trim() !== '' && price.trim() !== '') {
                            complementData.push({name, price});
                        }
                    });

                    // Atualizar o campo oculto com os dados de complemento serializados
                    document.getElementById('complementDataInput').value = JSON.stringify(complementData);

                    // Simulação de espera
                    await new Promise(resolve => setTimeout(resolve, 500));

                    // Enviar o formulário
                    form.submit();
                });

                //Criando o Array de informações de complementos ao editar um novo produto
                const editForm = document.getElementById('edit-product-form');
                const editSendDataBtn = document.querySelector('.edit-product-buttons-area button');

                editSendDataBtn.addEventListener('click', async function(event) {
                    event.preventDefault();

                    const editComplementNames = document.querySelectorAll('input[name="editComplementName[]"]');
                    const editComplementPrices = document.querySelectorAll('input[name="editComplementPrice[]"]');

                    const editComplementData = [];

                    editComplementNames.forEach((nameInput, index) => {
                        const editName = nameInput.value;
                        const editPrice = editComplementPrices[index].value;

                        if (editName.trim() !== '' && editPrice.trim() !== '') {
                            editComplementData.push({editName, editPrice});
                        }
                    });

                    // Atualizar o campo oculto com os dados de complemento serializados
                    document.getElementById('editComplementDataInput').value = JSON.stringify(editComplementData);

                    // Simulação de espera
                    await new Promise(resolve => setTimeout(resolve, 500));

                    // Enviar o formulário
                    editForm.submit();
                });


                //Formatar o input de valores ao criar um produto
                function formatCurrency(input) {
                    let value = input.value.replace(/\D/g, ''); // Remove todos os não dígitos

                    if (value.length === 0) {
                        value = '0';
                    }

                    value = (parseInt(value) / 100).toFixed(2); // Divide por 100 e mantém duas casas decimais
                    value = value.toString().replace('.', ','); // Substitui ponto por vírgula
                    value = value; // Adiciona 'R$' no início

                    input.value = value;
                }

                document.getElementById('price').addEventListener('input', function() {
                    formatCurrency(this);
                });

                document.getElementById('discount').addEventListener('input', function() {
                    formatCurrency(this);
                });

                // Adiciona o evento a um elemento pai (div com id 'container') que envolve os elementos dinâmicos
                document.querySelector('.complement-item').addEventListener('input', function(event) {
                    if (event.target.matches('#complementPrice')) {
                        formatCurrency(event.target);
                    }
                });

                document.getElementById('editPrice').addEventListener('input', function() {
                    formatCurrency(this);
                });

                document.getElementById('editDiscount').addEventListener('input', function() {
                    formatCurrency(this);
                });

                // Pegando todos os campos de preço existentes
                const existingPriceInputs = document.querySelectorAll('input[name^="editComplementPrice"]');

                // Aplicando a função formatCurrency nos campos existentes
                existingPriceInputs.forEach(function(input) {
                    formatCurrency(input);
                });

                // Adicionando o evento para futuros campos
                document.addEventListener('input', function(event) {
                    if (event.target.matches('input[name^="editComplementPrice"]')) {
                        formatCurrency(event.target);
                    }
                });
            });
        </script>

        <script>
            const uploadImageUrl = '{{ route("image.new") }}';

            // Seleciona todas as imagens com a classe 'uploadImage'
            const uploadImages = document.querySelectorAll('#uploadImage');

            uploadImages.forEach(uploadImage => {
                uploadImage.addEventListener('click', function() {
                    const productId = this.dataset.id; // Obtém o ID do produto
                    const token = '{{ csrf_token() }}';

                    const fileInput = document.createElement('input');
                    fileInput.type = 'file';
                    fileInput.style.display = 'none';

                    // Adiciona o input de arquivo dinamicamente ao documento
                    document.body.appendChild(fileInput);

                    // Simula o clique no input de arquivo
                    fileInput.click();

                    // Evento que ocorre ao selecionar um arquivo
                    fileInput.addEventListener('change', function() {
                        const file = fileInput.files[0]; // Obtém o arquivo selecionado

                        if (file) {
                            const formData = new FormData();
                            formData.append('image', file); // Adiciona o arquivo ao FormData
                            formData.append('productId', productId); // Adiciona o ID do produto

                            fetch(uploadImageUrl, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': token
                                }
                            })
                            .then(response => {
                                if (response.ok) {
                                    return response.text();
                                }
                                throw new Error('Erro no envio do arquivo.');
                            })
                            .then(data => {
                                alert('Arquivo enviado com sucesso:', data);
                            })
                            .catch(error => {
                                alert('Erro:', error.message);
                            });
                        }
                    });
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const toggleItems = document.querySelectorAll('.toggle-items');

                toggleItems.forEach(function(item) {
                    item.addEventListener('click', function() {
                        const productArea = this.closest('.category-top-area').nextElementSibling;
                        productArea.classList.toggle('hidden');

                        this.classList.toggle('bx-rotate-180');
                    });
                });
            });
        </script>
    </div>
</div>
