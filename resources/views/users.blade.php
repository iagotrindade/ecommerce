<x-adm_layout :user="$authUser" title="Usuários" activeMenu="users">
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

        <div class="users-warning-area">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="warning-item">{{$error}}</p>
                @endforeach
            @endif
        </div>

        <div class="users-table-area">
            <livewire:adm-users-table :id="$id"/>

            <x-add_users_modal userPermission="{{$authUser['permissionName']}}">
                @foreach ($permissionGroups as $permission)
                    <p class="permission-item default-flex" data-id="{{$permission['id']}}">{{$permission['name']}}</p>
                @endforeach
            </x-add_users_modal>
        </div>
    </div>
</x-adm_layout>
