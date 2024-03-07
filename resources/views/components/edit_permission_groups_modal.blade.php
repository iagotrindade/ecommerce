<div class="edit-permission-groups-modal">
    <form action="{{route('permissions.edit')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-top-area default-flex-between">
            <div class="top-left-area">
                <h2>Editar Grupo de Permissão</h2>
            </div>
        </div>


        <div class="permissions-inputs-area default-flex--column">
            <input id="group-id" type="hidden" name="groupId">
            <input id="edit-name" type="text" name="name" placeholder="Nome do Grupo" required>
            <input id="edit-permissions-list" type="hidden" name="permissions_list">

            <div class="permissions-items-area default-flex-start">
                {{$slot}}
            </div>
        </div>

        <div class="buttons-area default-flex-between">
                <a class="delete-permission-group-button" href="#" onclick="confirmDel('Tem certeza que deseja excluir este grupo de permissão?')">Excluir Grupo de Permissão</a>

            <div class="default-flex">
                <x-buttons.default_secondary_button href="" text="Cancelar" id="close-edit-permissions-user-modal-button"></x-buttons.default_secondary_button>
                <x-buttons.default_primary_button tag="button" text="Salvar Alterações" type="submit"></x-buttons.default_primary_button>
            </div>
        </div>
    </form>

    <form action="{{route('permissions.delete')}}" method="POST" id="delete-form">
        @csrf
        <input type="hidden" name="id" id="delete-group">
    </form>
</div>

<div class="modal-filter"></div>
