<div class="category-modal-filter" id="modalFilter"></div>

<div class="add-category-modal-area default-flex">
    <div class="add-category-modal default-flex-column">
        <h3>Categoria</h3>

        <form method="POST" action="{{route('category.new')}}">
            @csrf
            <input type="text" name="name" placeholder="Nome...">

            <div class="default-flex-end">
                <x-buttons.default_secondary_button id="" text="Cancelar"></x-buttons.default_secondary_button>
                <x-buttons.default_primary_button tag="button" type="submit" text="Criar"></x-buttons.default_primary_button>
            </div>
        </form>
    </div>
</div>
