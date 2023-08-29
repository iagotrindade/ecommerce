<x-adm_layout title="Usuários" userName="{{$authUser->name}}" userImage="{{$authUser->image}}" activeMenu="users">

    <div class="users-area">
        <div class="users-area-top default-flex-between">
            <h1 class="users-title">Gerenciar Usuários</h1>

            @if($permissionsController::hasPermission('register_new_user', $authUser['permissionSlugs']))
                <p class="add-user-button default-flex">+ Novo Usuário</p>
            @endif

        </div>

        <div class="users-filter-area default-flex-start">
            <p class="users-filter-button users-filter-active default-flex" id="All">Todos</p>
            <p class="users-filter-button default-flex" id="adm">Administrador</p>
            <p class="users-filter-button default-flex" id="register">Cadastro</p>
            <p class="users-filter-button default-flex" id="active">Ativados</p>
        </div>

        <div class="users-table-area">
            <x-users_table>
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
                            <td class="table-body-info" id="edit-user-button" data-user="{{$user}}">
                                <p>
                                    <img src="assets/images/panel-icons/edit_user.png" alt="Editar Usuário">
                                </p>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </x-users_table>

            <x-add_users_modal userPermission="{{$authUser['permissionName']}}">
                @foreach ($permissionGroups as $permission)
                    <p class="permission-item default-flex" data-id="{{$permission['id']}}">{{$permission['name']}}</p>
                @endforeach
            </x-add_users_modal>



            <x-edit_user_modal userPermission="{{$authUser['permissionName']}}">
                @foreach ($permissionGroups as $permission)
                    <p class="permission-item-edit default-flex" data-id="{{$permission['id']}}">{{$permission['name']}}</p>
                @endforeach
            </x-edit_user-modal>
        </div>
    </div>
</x-adm_layout>
