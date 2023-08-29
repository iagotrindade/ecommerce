<x-adm_layout title="Mídia" userName="{{$authUser->name}}" userImage="{{$authUser->image}}" activeMenu="gallery">
    <div class="gallery-area">
        <div class="gallery-header-area default-flex-between">
            <div class="filter-images-area">
                <select id="date-filter">
                    <option selected>Mais Atual</option>
                    <option>Mais Antigo</option>
                </select>
            </div>

            @if($permissions::hasPermission('upload_image_to_gallery', $authUser['permissionSlugs']))
                <p id="add-image">+ Adicionar nova Imagem</p>
            @endif

        </div>

        <main>
            <form method="POST" action="{{route('image.delete')}}" id="delete-form" class="gallery-images-area default-flex-between" enctype="multipart/form-data">
                @foreach ($images as $image)
                    <div class="image-box default-flex-column" data-value="{{$image['created_at']}}">
                        @csrf

                        <div class="actions-area default-flex-between">
                            <input id="delete-checkbox" type="checkbox" name="delete-images[]">
                            <input type="hidden" name="delete-images-id[]" value="{{$image['id']}}">

                            @if($permissions::hasPermission('upload_image_to_gallery', $authUser['permissionSlugs']))
                                <div class="delete-image-area default-flex" onclick="deleteImages()">
                                    <img src="assets/images/panel-icons/trash_icon.png" alt="Excluir" onclick="confirmDel('Tem certeza que deseja excluir esta(as) Imagem(ns)?')">

                                    <p>Remover</p>
                                </div>
                            @endif
                        </div>

                        <img class="gallery-image" src="{{url("storage/{$image['name']}")}}" alt="Imagem da Galeria">
                    </div>
                @endforeach
            </form>

            <form class="add-image-modal default-flex-column-start" method="POST" enctype="multipart/form-data" action="{{route('image.new')}}">
                @csrf

                <input id="image-input" type="file" name="image">

                <div class="close-button-area default-flex-end" >
                    <img src="assets/images/panel-icons/close_icon.png" alt="Fechar o Modal" id="close-modal">
                </div>


                <div class="upload-image-area default-flex-column">
                    <img src="assets/images/panel-icons/upload_image_icon.png" alt="Enviar Imagem">

                    <div class="default-flex">
                        <p class="upload-image-button" id="upload-image-button">Clique aqui para fazer o Upload</p>

                        <p class="upload-image-text">Ou arraste e solte uma imagem</p>
                    </div>

                    <h4 class="size-warning">Tamanho Máximo do arquivo 15MB</h4>
                </div>

                <button class="default-flex" id="send-image-button" type="submit">Confirmar</button>
            </form>
        </main>
    </div>

</x-adm_layout>
