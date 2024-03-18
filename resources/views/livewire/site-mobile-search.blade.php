<div>
    <section class="mobile-search-area default-flex" style="display: {{$mobileDisplay}}">
        <input type="text" name="search" id="search" placeholder="Pesquisar" wire:model="searchTerm" wire:keyup="mobileSearchSiteProduct">
        <div class="mobile-search-icon  default-flex">
            <i class='bx bx-search-alt-2'></i>
        </div>
    </section>
</div>
