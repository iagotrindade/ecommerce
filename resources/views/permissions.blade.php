<x-adm_layout :user="$authUser" title="Permissões" activeMenu="permissions">

    <div class="permissions-area">
        <div class="permissions-area-top default-flex-between">
            <h1 class="users-title">Gerenciar Grupos de Permissões</h1>

            @if($permissionsController::hasPermission('register_new_permission', $authUser['permissionSlugs']))
                <p class="add-permission-button default-flex">+ Novo Grupo</p>
            @endif
        </div>

        <p class="slugs-warnings">*Aviso: As permissões são pré-definidas pelo Desenvolvedor, não é possível altera-las através do Painel Administrativo</p>

        <div class="permissions-warning-area">
            @if ($errors->any())

                @foreach ($errors->all() as $error)
                    <p class="warning-item">{{$error}}</p>
                @endforeach
            @endif
        </div>

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
