<div class={{$modalType}}>
    <form action="{{route('users.new')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="image" id="user-image-input" accept=".jpg, .jpeg, .png">
        <input type="hidden" name="permission_id" id="user-permission-input" value=2>
        <div class="modal-top-area default-flex-between">
            <div class="top-left-area">
                <h2>{{$usersModalTitle}}</h2>

                <p class="profile-text">Perfil</p>

                <div class="user-permission-button-area default-flex-start">
                    <p class="permission-item adm-permission default-flex">Administrador</p>
                    <p class="permission-item register-permission permission-active default-flex">Cadastro</p>
                </div>

                {{$accessItems}}
            </div>

            <div class="top-right-area">
                <div class="user-image-input-area default-flex-column">
                    {{$imageArea}}
                </div>
            </div>
        </div>


        <div class="inputs-area default-flex-between">
            <div class="input-left-area default-flex-column">
                {{$leftInputs}}
            </div>

            <div class="input-right-area default-flex-column">
                <input type="password" name="password" placeholder="Senha" required>
                <input type="password" name="password_confirmation" placeholder="Repetir Senha" required>
            </div>
        </div>

        {{$deleteUserButton}}

        <div class="buttons-area default-flex-end">
            <x-secondary_order_button href="" text="Cancelar" id="{{$closeModalButtonType}}"></x-secondary_order_button>
            <x-primary_order_button tag="button" text="Criar Usuário" type="submit"></x-primary_order_button>
        </div>
    </form>
</div>

<div class="user-modal-filter"></div>
