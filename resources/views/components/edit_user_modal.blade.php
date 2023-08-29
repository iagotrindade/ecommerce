<div class="edit-user-modal-area">
    <form method="POST" action="{{route('users.edit')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" id="edit-user-id-input">
        <input type="file" id="edit-user-image-input" name="image">
        <input type="hidden" name="permission_id" id="edit-user-permission-input">
        <input type="hidden" name="status" id="edit-user-status-input">


        <div class="modal-top-area default-flex-between">
            <div class="top-left-area default-flex-column">
                <h2>Editar Usuário</h2>

                <div class="default-flex">
                    <div class="user-permission-area default-flex-column">
                        <p class="profile-text">Perfil</p>

                        <div class="user-permission-button-area default-flex-start">
                            {{$slot}}
                        </div>
                    </div>

                    <div class="user-access-area default-flex-column">
                        <p class="profile-text">Acesso</p>

                        <div class="user-access-area default-flex">
                            <p class="access-item default-flex" data-status="Ativado">Ativado</p>
                            <p class="access-item default-flex" data-status="Desativado">Desativado</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="top-area-right">
                <div class="edit-user-image-input-area default-flex-column">
                    <img src="assets/images/panel-icons/upload_image_icon.png" alt="Enviar Imagem do Usuário" id="edit-image">
                </div>
            </div>
        </div>

        <div class="inputs-area default-flex-between">
            <div class="input-left-area default-flex-column">
                <input type="text" name="name" id="edit-name-input" placeholder="Nome">
                <input type="email" name="email" id="edit-email-input" placeholder="E-mail">
            </div>

            <div class="input-right-area default-flex-column">
                <input type="password" name="password" placeholder="Senha">
                <input type="password" name="new_password" placeholder="Confirme a senha">
            </div>
        </div>

        <div class="default-flex-between">

            <p class="delete-user-button">Excluir Usuário</p>

            <div class="default-flex-between">
                <x-default_secondary_button id="close-edit-user-modal-button" text="Cancelar"></x-default_secondary_button>
                <x-default_primary_button tag="button" type="submit" text="Salvar Alterações"></x-default_primary_button>
            </div>

        </div>

    </form>

    <form action="{{route("user.delete")}}"></form>
        <input type="hidden" name="userId" id="delete-user-input">
    </form>
</div>

<div class="modal-filter"></div>
