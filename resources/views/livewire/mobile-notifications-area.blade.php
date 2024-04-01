<div>
    <div class="mobile-notifications-area" style="display: {{$mobileDisplay}};">
        <div class="mobile-cart-header default-flex-between">
            <a class="default-flex" wire:click="showMobileNotifications()">
                <i class='bx bx-chevron-left'></i>
            </a>

            <h3>Notificações</h3>
        </div>

        @if(Auth::check())
            <div class="mobile-select-notification-type default-flex-between">
                <div class="mobile-notifications" wire:click="changeNotificationsTab('notifications')">
                    <p class="@if ($mobileNotifications == 'block')
                        mobile-notifications-active
                    @endif">Minhas Atividades</p>
                </div>

                <div class="mobile-news" wire:click="changeNotificationsTab('news')">
                    <p class="@if ($mobileNews == 'block')
                        mobile-notifications-active
                    @endif">Novidades</p>
                </div>
            </div>

            <div class="my-notifications-area" style="display: {{$mobileNotifications}}">
                <h3>{{$date}}</h3>

                @foreach ($user->notifications as $notification)
                    <div class="mobile-notification-item default-flex-column" @if($notification->read_at !== null) style="opacity: 0.5;" @endif>
                        <div class="mobile-notification-content default-flex-between">
                            <h5>{{$notification->data['title']}}</h5>

                            <p class="mobile-notification-date">
                                {{date('d/m/Y - h:m', strtotime($notification->created_at))}}
                            </p>
                        </div>

                        <p>{{Str::limit($notification->data['body'], 70, '...')}}</p>
                    </div>
                @endforeach
            </div>

            <div class="news-area" style="display: {{$mobileNews}}">
                <h3>Janeiro, 2024</h3>
            </div>
        @else
            <x-login-form></x-login-form>
        @endif
    </div>
</div>
