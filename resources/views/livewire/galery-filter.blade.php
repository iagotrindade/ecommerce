<div>
    <div class="filter-images-area">
        <select id="date-filter" wire:model="filter" wire:change="filterImagesByDate($event.target.innerText)">
            <option selected>Mais Atual</option>
            <option>Mais Antigo</option>
        </select>
    </div>
</div>
