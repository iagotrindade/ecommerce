<x-adm_layout title="Permissões" activeMenu="permissions" userName="{{$authUser->name}}" userImage="{{$authUser->image}}">

    <div class="permissions-area">
        <div class="permissions-area-top default-flex-between">
            <h1 class="users-title">Gerenciar Permissões</h1>

            @if($permissionsController::hasPermission('register_new_permission', $authUser['permissionSlugs']))
                <p class="add-permission-button default-flex">+ Nova Permissão</p>
            @endif
        </div>

        <p class="slugs-warnings">*Aviso: Slugs são identificadores inalteraveis de cada permissão, por isso não é possível edita-los</p>

        <div class="permissions-items-table-area">
            <table class="permissions-table">
                <thead class="permissions-table-head">
                    <tr>
                        <th scope="col" id="permission-id">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Usuários</th>
                        <th scope="col">Data</th>
                        <th scope="col">Editar</th>
                    </tr>
                </thead>

                <tbody class = "permissions-table-body">
                    @foreach ($permissionGroups as $permissionGroup)
                        <tr id = "permissions-item">
                            <td class="table-body-info" id="permission-id">{{$permissionGroup->id}}</td>

                            <td class="table-body-info">{{$permissionGroup->name}}</td>

                            <td class="table-body-info">{{$permissionGroup->qtd}}</td>

                            <td class="table-body-info">
                                {{$permissionGroup->created_at}}
                            </td>

                            @if($permissionsController::hasPermission('edit_permission_group', $authUser['permissionSlugs']))
                                <td class="table-body-info" id="edit-permission-button" data-permissionsItems="{{$permissionGroup}}">
                                    <p>
                                        <img src="assets/images/panel-icons/edit_user.png" alt="Editar Permissão">
                                    </p>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <x-add_permission_groups_modal>
                <div class="permissions-group-item default-flex-column-start">
                    <p class="permission-type-name">Permissões de Usuário</p>

                    @foreach ($permissionItems as $permissionItem)
                        @if ($permissionItem->type === 'user_access')
                            <div class="permissions-permission-item-add default-flex" data-value="{{$permissionItem->id}}">
                                <p>{{$permissionItem->name}}</p>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="permissions-group-item default-flex-column-start">
                    <p class="permission-type-name">Permissões de Grupos</p>

                    @foreach ($permissionItems as $permissionItem)
                        @if ($permissionItem->type === 'permissions_access')
                            <div class="permissions-permission-item-add default-flex" data-value="{{$permissionItem->id}}">
                                <p>{{$permissionItem->name}}</p>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="permissions-group-item default-flex-column-start">
                    <p class="permission-type-name">Permissões da Galeria</p>

                    @foreach ($permissionItems as $permissionItem)
                        @if ($permissionItem->type === 'gallery_access')
                            <div class="permissions-permission-item-add default-flex" data-value="{{$permissionItem->id}}">
                                <p>{{$permissionItem->name}}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </x-add_permission_groups_modal>


            <x-edit_permission_groups_modal>
                <div class="permissions-group-item default-flex-column-start">
                    <p class="permission-type-name">Permissões de Usuário</p>

                    @foreach ($permissionItems as $permissionItem)
                        @if ($permissionItem->type === 'user_access')
                            <div class="permissions-permission-item default-flex" data-value="{{$permissionItem->id}}">
                                <p>{{$permissionItem->name}}</p>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="permissions-group-item default-flex-column-start">
                    <p class="permission-type-name">Permissões de Grupos</p>

                    @foreach ($permissionItems as $permissionItem)
                        @if ($permissionItem->type === 'permissions_access')
                            <div class="permissions-permission-item default-flex" data-value="{{$permissionItem->id}}">
                                <p>{{$permissionItem->name}}</p>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="permissions-group-item default-flex-column-start">
                    <p class="permission-type-name">Permissões da Galeria</p>

                    @foreach ($permissionItems as $permissionItem)
                        @if ($permissionItem->type === 'gallery_access')
                            <div class="permissions-permission-item default-flex" data-value="{{$permissionItem->id}}">
                                <p>{{$permissionItem->name}}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </x-edit_permission_groups_modal>
        </div>
    </div>
</x-adm_layout>
