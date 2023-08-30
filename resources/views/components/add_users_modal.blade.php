<div class="users-modal-area">
    <form method="POST" action="{{route('users.new')}}" enctype="multipart/form-data">
        @csrf
        <input type="file" id="user-image-input" name="image">
        <input type="hidden" name="permission_id" id="user-permission-input">

        <div class="modal-top-area default-flex-between">
            <div class="top-left-area default-flex-column">
                <h2>Cadastrar Usuário</h2>

                <p class="profile-text">Perfil</p>

                <div class="user-permission-area default-flex">
                    {{$slot}}
                </div>
            </div>

            <div class="top-area-right">
                <div class="user-image-input-area default-flex-column">
                    <img src="assets/images/panel-icons/upload_image_icon.png" alt="Enviar Imagem do Usuário">

                    <p class="upload-user-image-button">Clique para fazer o Upload</p>

                    <p class="user-image-size-warning">Tamanho máximo 15Mb</p>
                </div>
            </div>
        </div>

        <div class="inputs-area default-flex-between">
            <div class="input-left-area default-flex-column">
                <input type="text" name="name" placeholder="Nome">
                <input type="email" name="email" placeholder="E-mail">
            </div>

            <div class="input-right-area default-flex-column">
                <input type="text" name="username" placeholder="Nome de Usuário">
                <input type="phone" name="phone" placeholder="Telefone">
            </div>
        </div>

        <div class="default-flex-end">
            <x-default_secondary_button id="close-add-user-modal-button" text="Cancelar"></x-default_secondary_button>
            <x-default_primary_button tag="button" type="submit" text="Criar Usuário"></x-default_primary_button>
        </div>

    </form>
</div>

<div class="modal-filter"></div>
