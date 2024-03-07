 @if (!empty($qrcode))
    <div class="category-modal-filter" id="modalFilter" style="display: {{$display}}"></div>

    <div class="edit-qrcode-modal-area default-flex">
        <form method="POST" action="{{route('qrcode.edit')}}">
            <div class="add-qrcode-modal default-flex-column" style="display: {{$display}}">
                <div class="add-qrcode-modal-top-area default-flex-between">
                    <h3>Editar QRCode {{$qrcode->name}}</h3>

                    <div class="switch-container default-flex-end" style="margin: 0; margin-left: 10px;">
                        <input id="edit-switch-shadow-qrcode" class="switch switch--shadow" type="checkbox" name="status" @if ($qrcode->status == 'Ativado')
                            checked
                        @endif>
                        <label for="edit-switch-shadow-qrcode"></label>
                    </div>
                </div>

                @csrf
                <input type="hidden" name="id" value="{{$qrcode->id}}">
                <input type="text" name="name" placeholder="Nome..." value="{{$qrcode->name}}">

                <div class="default-flex-end">
                    <x-buttons.default_secondary_button id="" text="Cancelar"></x-buttons.default_secondary_button>
                    <x-buttons.default_primary_button tag="button" type="submit" text="Atualizar" ></x-buttons.default_primary_button>
                </div>
            </div>
        </form>
    </div>
 @endif

