<div class="default-flex">
    <div class="notification-wrapper">
        <div class="notification-icon default-flex" wire:click='readNotifications'>
            @if ($newNotificationCount !== 0)
                <i class='bx bxs-bell-ring'></i>
                <style>
                    .notification-icon i::after {content: '{{$newNotificationCount}}';}
                </style>
            @else
                <i class='bx bxs-bell' ></i>
            @endif
        </div>

        <div class="notification-container" id="notificationContainer" style="display: {{$notificationAreaDisplay}}">
            <div class="notification-list">
                @if (count($user->notifications) <= 0)
                    <p class="empty-notification-warning">Nenhuma nova notificação</p>
                @endif

                @foreach ($user->notifications as $notification)
                    <div class="notification-item" @if($notification->read_at !== null) style="opacity: 0.5;" @endif>
                        <a href="" wire:click='readNotifications'>
                            <h3>{{$notification->data['title']}}</h3>
                            <p>{{Str::limit($notification->data['body'], 70, '...')}}</p>
                            <p class="notification-date">{{date('d/m/Y - h:m', strtotime($notification->created_at))}}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
