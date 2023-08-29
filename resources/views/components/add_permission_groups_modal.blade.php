<div class="add-permission-groups-modal">
    <form action="{{route('permissions.new')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-top-area default-flex-between">
            <div class="top-left-area">
                <h2>Cadastrar Grupo de Permissão</h2>
            </div>
        </div>


        <div class="permissions-inputs-area default-flex--column">
            <input id="name" type="text" name="name" placeholder="Nome do Grupo" required>
            <input id="permissions-list" type="hidden" name="permissions_list">

            <div class="permissions-items-area default-flex-start">
                {{$slot}}
            </div>
        </div>

        <div class="buttons-area default-flex-end">
            <x-default_secondary_button href="" text="Cancelar" id="close-permissions-user-modal-button"></x-default_secondary_button>
            <x-default_primary_button tag="button" text="Criar Grupo" type="submit"></x-default_primary_button>
        </div>
    </form>
</div>

<div class="modal-filter"></div>
