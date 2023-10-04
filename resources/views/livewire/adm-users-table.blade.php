<div class="users-table-area default-flex">
    <table class="users-table">
        <thead class="users-table-head">
            <tr>
                <th scope="col"></th>
                <th scope="col">Nome</th>
                <th scope="col">Usuário</th>
                <th scope="col">Perfil</th>
                <th scope="col">Acesso</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody class = "users-table-body">
            @foreach ($users as $user)
                <tr id = "user-item">
                    <th class="users-table-body-info" id="users-image-th" scope="row">
                        <a href="" class="user-image">
                            <img src="{{url("storage/{$user['image']}")}}" alt="Avatar">
                        </a>
                    </th>

                    <td class="table-body-info" id="user-name">{{$user['name']}}</td>

                    <td class="table-body-info">{{$user['username']}}</td>

                    <td class="table-body-info" id="user-permission">{{$user['permissionName']}}</td>

                    <td class="table-body-info">
                        <p class="@if (($user['status'] === "Ativado"))green-user-status @else red-user-status @endif default-flex" id="user-status">{{$user['status']}}</p>
                    </td>


                    @if($permissionsController::hasPermission('edit_user', $authUser['permissionSlugs']))
                        <td class="table-body-info" id="edit-user-button" wire:click="openEditModal({{$user['id']}})" data-user="{{$userEdited}}">
                            <p>
                                <img src="assets/images/panel-icons/edit_user.png" alt="Editar Usuário">
                            </p>
                        </td>
                    @elseif ($permissionsController::hasPermission('edit_my_user', $authUser['permissionSlugs']))
                        @if ($user['id'] == $authUser['id'])
                            <td class="table-body-info" id="edit-user-button" wire:click="openEditModal({{$user['id']}})" data-user="{{$userEdited}}">
                                <p>
                                    <img src="assets/images/panel-icons/edit_user.png" alt="Editar Usuário">
                                </p>
                            </td>
                        @endif
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    @if(!empty($userEdited))
        <div class="edit-user-livewire">
            <div class="edit-user-modal-area" style="display: {{$modalSatus}}">
                <form method="POST" action="{{route('users.edit')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" id="edit-user-id-input" value="{{$userEditedTemp['id']}}" >
                    <input type="file" id="edit-user-image-input" name="image" wire:model="userEditedImageTemp">
                    <input type="hidden" name="permission_id" id="edit-user-permission-input" value="{{$userEditedTemp['permission']}}">
                    <input type="hidden" name="status" id="edit-user-status-input" value="{{$userEditedTemp['status']}}">


                    <div class="modal-top-area default-flex-between">
                        <div class="top-left-area default-flex-column">
                            <h2>Editar Usuário</h2>

                            <div class="users-permissions-access-area default-flex">
                                <div class="user-permission-area default-flex-column">
                                    <p class="profile-text">Perfil</p>

                                    <div class="user-permission-button-area default-flex-start">
                                        @foreach ($permissionGroups as $permission)
                                            @if($userEditedTemp['permissionName'] === $permission['name'])
                                                <p class="permission-item-edit  default-flex @if($userEditedTemp['permission'] == $permission['id'])
                                                    permission-active-edit
                                                @endif" data-id="{{$permission['id']}}" wire:click="changePermission($event.target.attributes['data-id'].value)">{{$permission['name']}}</p>
                                            @else
                                                <p class="permission-item-edit default-flex @if($userEditedTemp['permission'] == $permission['id'])
                                                    permission-active-edit
                                                @endif" data-id="{{$permission['id']}}" wire:click="changePermission($event.target.attributes['data-id'].value)">{{$permission['name']}}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <div class="user-access-area default-flex-column">
                                    <p class="profile-text">Acesso</p>

                                    <div class="user-access-area default-flex">
                                        <p class="access-item default-flex @if($userEditedTemp['status'] === "Ativado")
                                            access-permission-active
                                        @endif" data-status="Ativado" wire:click="changeAccess($event.target.innerText)">Ativado</p>
                                        <p class="access-item default-flex @if($userEditedTemp['status'] === "Desativado")
                                            access-permission-active
                                        @endif" data-status="Desativado" wire:click="changeAccess($event.target.innerText)">Desativado</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="top-area-right">
                            <div class="edit-user-image-input-area default-flex-column">
                                @if ($userEditedImageTemp)
                                    <img src="{{$userEditedImageTemp->temporaryUrl()}}" alt="Enviar Imagem do Usuário" id="edit-image" onclick="editUserImage()">
                                @else
                                    <img src="{{url("storage/{$userEditedTemp['imageName']}")}}" alt="Enviar Imagem do Usuário" id="edit-image" onclick="editUserImage()">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="inputs-area default-flex-between">
                        <div class="input-left-area default-flex-column">
                            <input type="text" name="name" id="edit-name-input" placeholder="Nome" wire:model="userEditedTemp.name">


                            <input type="text" name="username" id="edit-username-input" placeholder="Nome de Usuário" wire:model="userEditedTemp.username">
                            <input type="password" name="password" placeholder="Senha">
                        </div>

                        <div class="input-right-area default-flex-column">
                            <input type="email" name="email" id="edit-email-input" placeholder="E-mail" wire:model="userEditedTemp.email">
                            <input type="phone" name="phone" id="edit-phone-input" placeholder="Telefone" wire:model="userEditedTemp.phone">
                            <input type="password" name="new_password" placeholder="Nova senha">
                        </div>
                    </div>

                    <div class="default-flex-between">

                        @if($permissionsController::hasPermission('delete_user', $authUser['permissionSlugs']))
                            <a href="{{route("user.delete", ["id" => $userEdited->id])}}" class="delete-user-button">Excluir Usuário</a>
                        @endif

                        <div class="default-flex-between">
                            <x-default_secondary_button id="close-edit-user-modal-button" text="Cancelar" onclick="closeModal()"></x-default_secondary_button>
                            <x-default_primary_button tag="button" type="submit" text="Salvar Alterações" wire:click="sendForm"></x-default_primary_button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-filter" style="display: {{$modalSatus}}"></div>
        </div>
    @endif
</div>


