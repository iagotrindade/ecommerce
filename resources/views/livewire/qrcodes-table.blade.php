<div>
    <div class="qrcodes-area">
        <div class="qrcodes-area-top default-flex-end">
            @if($permissionsController::hasPermission('register_new_qrcode', $user['permissionSlugs']))
                <p class="add-user-button default-flex" wire:click="openAddModal">+ Criar QRCode</p>
            @endif
        </div>

        <div class="users-warning-area">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="warning-item">{{$error}}</p>
                @endforeach
            @endif
        </div>

        <div class="users-table-area">
            <table class="users-table">
                <thead class="users-table-head">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Nome</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody class = "users-table-body">
                    @foreach ($qrcodes as $qrCode)
                        <tr id = "user-item">
                            <th class="users-table-body-info" id="users-image-th" scope="row">
                                <a href="{{route('qrcode.download', $qrCode->id)}}" target="_blank" class="qrcode-image">
                                    {{Str::of($qrCode->qrcode)->toHtmlString()}}
                                </a>
                            </th>

                            <td class="table-body-info" id="user-name">{{$qrCode->name}}</td>

                            <td class="table-body-info">
                                <p class="@if (($qrCode->status === "Ativado"))green-user-status @else red-user-status @endif default-flex">{{$qrCode->status}}</p>
                            </td>



                            <td class="table-body-info" id="edit-user-button">
                                <div class="default-flex">
                                    @if($permissionsController::hasPermission('edit_qrcode', $user['permissionSlugs']))
                                        <img src="assets/images/panel-icons/edit_user.png" alt="Editar QRCode" wire:click="openEditModal({{$qrCode->id}})">
                                    @endif

                                    <a class="download-qrcode-icon default-flex" href="{{route('qrcode.download', $qrCode->id)}}" target="_blank">
                                        <img src="{{url("assets/images/panel-icons/download_icon.png")}}" alt="Baixar QRCode">
                                    </a>

                                    <a class="delete-qrcode-icon default-flex" href="{{route('qrcode.delete', $qrCode->id)}}" onclick="return confirmDel('Deseja realmente excluir o QRCode {{$qrCode->name}}')">
                                        <i class='bx bxs-trash'></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-add_qrcode_modal :display="$display"></x-add_qrcode_modal>

    <x-edit_qrcode_modal :display="$editDisplay" :qrcode="$qrcode"></x-edit_qrcode_modal>
</div>


