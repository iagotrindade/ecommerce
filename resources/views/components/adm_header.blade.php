                    <header class="dashboard-header-area">
                        <div class="default-flex-around">
                            <div class="page-tittle default-flex">
                                <h1>{{$title}}</h1>
                            </div>

                            <form method="POST" action="" class="adm-search-form">
                                <input type="text" name="search" id="search" placeholder="Pesquisar">
                                <img src="assets/images/panel-icons/search-icon.png" alt="">
                            </form>

                            <div class="notification-area">
                                <i class='bx bx-bell' id="toggle-notification-bar"></i>

                                <div class="notification-list-area default-flex-end" style="display: none">
                                    <div class="notification-list">
                                        <div class="notification-item default-flex-around">
                                            <i class='bx bx-info-circle'></i>

                                            <div class="notification-texts default-flex-column">
                                                <h4 class="notification-tittle">
                                                    Título da Notificação.
                                                </h4>

                                                <p class="notification-body">
                                                    Corpo da Notificação bem grande para ver.
                                                </p>

                                                <p class="notification-date">09/07/23 ás 19:07</p>
                                            </div>
                                        </div>


                                        <div class="notification-item default-flex-around">
                                            <i class='bx bx-info-circle'></i>

                                            <div class="notification-texts default-flex-column">
                                                <h4 class="notification-tittle">
                                                    Título da Notificação.
                                                </h4>

                                                <p class="notification-body">
                                                    Corpo da Notificação bem grande para ver.
                                                </p>

                                                <p class="notification-date">09/07/23 ás 19:07</p>
                                            </div>
                                        </div>

                                        <div class="notification-item default-flex-around">
                                            <i class='bx bx-info-circle'></i>

                                            <div class="notification-texts default-flex-column">
                                                <h4 class="notification-tittle">
                                                    Título da Notificação.
                                                </h4>

                                                <p class="notification-body">
                                                    Corpo da Notificação bem grande para ver.
                                                </p>

                                                <p class="notification-date">09/07/23 ás 19:07</p>
                                            </div>
                                        </div>

                                        <div class="notification-item default-flex-around">
                                            <i class='bx bx-info-circle'></i>

                                            <div class="notification-texts default-flex-column">
                                                <h4 class="notification-tittle">
                                                    Título da Notificação.
                                                </h4>

                                                <p class="notification-body">
                                                    Corpo da Notificação bem grande para ver.
                                                </p>

                                                <p class="notification-date">09/07/23 ás 19:07</p>
                                            </div>
                                        </div>

                                        <div class="notification-item default-flex-around">
                                            <i class='bx bx-info-circle'></i>

                                            <div class="notification-texts default-flex-column">
                                                <h4 class="notification-tittle">
                                                    Título da Notificação.
                                                </h4>

                                                <p class="notification-body">
                                                    Corpo da Notificação bem grande para ver.
                                                </p>

                                                <p class="notification-date">09/07/23 ás 19:07</p>
                                            </div>
                                        </div>

                                        <div class="notification-item default-flex-around">
                                            <i class='bx bx-info-circle'></i>

                                            <div class="notification-texts default-flex-column">
                                                <h4 class="notification-tittle">
                                                    Título da Notificação.
                                                </h4>

                                                <p class="notification-body">
                                                    Corpo da Notificação bem grande para ver.
                                                </p>

                                                <p class="notification-date">09/07/23 ás 19:07</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="adm-profile-area default-flex">
                                <a href="{{route('profile')}}" class="default-flex">
                                    <img src="{{{url("storage/$userImage")}}}" alt="Avatar">
                                </a>

                                <h3>{{$userName}}</h3>
                            </div>
                        </div>
                    </header>
