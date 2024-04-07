<div>
    @if (!empty($category))
        <div class="category-modal-filter" id="modalFilter" style="display: {{$display}}"></div>

        <div class="edit-category-modal-area default-flex">
            <div class="add-category-modal default-flex-column" style="display: {{$display}}">
                <h3>Editar Categoria {{$category->name}}</h3>

                <form method="POST" action="{{route('category.edit')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$category->id}}">
                    <input type="text" name="name" placeholder="Nome..." value="{{$category->name}}">

                    <div class="default-flex-end">
                        <x-buttons.default_secondary_button id="" text="Cancelar"></x-buttons.default_secondary_button>
                        <x-buttons.default_primary_button tag="button" type="submit" text="Atualizar"></x-buttons.default_primary_button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
