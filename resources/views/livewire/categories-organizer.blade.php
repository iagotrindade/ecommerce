<div>
    <div class="category-modal-filter" id="modalFilter" style="display: {{$display}}"></div>

    <div class="organizer-category-modal-area default-flex">
        <div class="organizer-category-modal default-flex-column" style="display: {{$display}}">
            <h3>Organizar Categorias</h3>

            <div class="all-categories" id="sortableCategories">
                @foreach ($categories as $index => $category)
                    <div class="category-item default-flex-between" data-index="{{$index}}" data-id="{{$category->id}}" draggable="true">
                        <h4>{{$category->name}}</h4>
                        <i class='bx bx-menu'></i>
                    </div>
                @endforeach
            </div>

            <div class="end-organizer-button-area default-flex-end">
                <p class="end-organizer-button default-flex" wire:click="closeOrganizerModal">Finalizar</p>
            </div>
        </div>
    </div>
</div>

<script>
    const sortableCategories = document.getElementById('sortableCategories');
    let draggingElement = null;

    sortableCategories.addEventListener('dragstart', (event) => {
        draggingElement = event.target;
        event.dataTransfer.setData('text/plain', event.target.dataset.index);
        event.target.style.opacity = '0.5';

    });

    sortableCategories.addEventListener('dragover', (event) => {
        event.preventDefault();
    });


    sortableCategories.addEventListener('drop', async (event) => {
        event.preventDefault();
        const droppedIndex = event.dataTransfer.getData('text/plain');
        const targetIndex = event.target.dataset.index;

        if (draggingElement !== event.target && droppedIndex && targetIndex) {
            const children = Array.from(sortableCategories.children);
            const droppedElement = children.find(child => child.dataset.index === droppedIndex);
            const targetElement = children.find(child => child.dataset.index === targetIndex);

            if (droppedElement && targetElement) {
                const droppedRect = droppedElement.getBoundingClientRect();
                const targetRect = targetElement.getBoundingClientRect();

                if (event.clientY > (targetRect.top + targetRect.height / 2)) {
                    sortableCategories.insertBefore(draggingElement, targetElement.nextSibling);
                } else if (event.clientY < (droppedRect.top + droppedRect.height / 2)) {
                    sortableCategories.insertBefore(draggingElement, targetElement);
                }

                const reorderedIndexes = Array.from(sortableCategories.children).map(child => child.dataset.id);

                const organizeCategoriesUrl = '{{ route("category.organize") }}';
                const token = '{{ csrf_token() }}';

                try {
                    const response = await fetch(organizeCategoriesUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({ reorderedIndexes }), // Certifique-se de que reorderedIndexes está definido corretamente
                    });

                    if (response.ok) {
                        console.log('Ordem atualizada enviada para o backend com sucesso!');
                        // Lógica adicional após o envio bem-sucedido, se necessário
                    } else {
                        console.error('Falha ao enviar a ordem atualizada para o backend.');
                        // Lógica para lidar com falha no envio
                    }
                } catch (error) {
                    console.error('Erro ao enviar a ordem atualizada para o backend:', error);
                    // Lógica para lidar com erros de solicitação
                }
            }
        }

        draggingElement.style.opacity = '1';
        draggingElement = null;
    });
</script>
