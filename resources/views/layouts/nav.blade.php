<nav class="navbar navbar-expand navbar-theme"  style="background:#3b3b3b !important">
    <a class="sidebar-toggle d-flex mr-2">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            
            <li class="nav-item dropdown ml-lg-2">
                <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-toggle="dropdown">
                        <i class="align-middle fas fa-cog"></i>
                    </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <form method="POST" action="{{route('logout')}}">
                        {{csrf_field()}}
                        <button class="dropdown-item" type="submit"><i class="align-middle mr-1 fas fa-sign-out-alt"></i> Cerrar Sesión</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>

</nav>