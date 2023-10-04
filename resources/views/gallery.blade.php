<x-adm_layout title="Mídia" userName="{{$authUser->name}}" userImage="{{$authUser->image}}" activeMenu="gallery" pastSearchFunction="searchOrders">
    <div class="gallery-area">
        <div class="gallery-header-area default-flex-between">
            <livewire:galery-filter/>

            @if($permissions::hasPermission('upload_image_to_gallery', $authUser['permissionSlugs']))
                <p id="add-image">+ Adicionar nova Imagem</p>
            @endif
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="warning-item">{{$error}}</p>
            @endforeach
        @endif

        <livewire:galery-images :authUser="$authUser" :permissionsController="$permissions"/>
    </div>

</x-adm_layout>
