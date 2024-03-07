<div class="asside-menu-area default-flex-column-start">
    <a class="default-flex logo-image-area" href="{{route('home')}}">
        <img class="logo-image" src="{{url('assets/images/panel-images/logo.png')}}" alt="OverFood">
    </a>

    <div>
        <ul class="sidebar-menu-list">
            <li class="">
                <a href="{{route("home")}}" class="default-flex-column menu-item @if($activeMenu=='carte') menu-active @endif">
                    <i class="bx bx-food-menu @if($activeMenu=='carte') menu-active @endif"></i>
                    <p>Cardápio</p>
                </a>
            </li>


            @if (Auth::check())
                <li class="logout-icon">
                    <a href="{{route('logout', $user->id)}}" class="default-flex menu-item">
                        <i class='bx bxs-log-out '></i>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
