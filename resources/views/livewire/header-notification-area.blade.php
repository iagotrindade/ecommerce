<div>
    <div class="notification-area">
        <i class='bx bx-bell' id="toggle-notification-bar" modal-status="{{$modalStatus}}" wire:click="openNotifications($event.target.attributes['modal-status'].value)"></i>

        <div class="notification-list-area default-flex-end" style="display: {{$modalStatus}}">
            <div class="notification-list">
                @foreach ($notifications as $notification)
                    <div class="notification-item default-flex-around">
                        <i class='bx bx-info-circle'></i>

                        <div class="notification-texts default-flex-column">
                            <h4 class="notification-tittle">
                                {{$notification->title}}
                            </h4>

                            <p class="notification-body">
                                {{$notification->body}}
                            </p>

                            <p class="notification-date">09/07/23 ás 19:07</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
