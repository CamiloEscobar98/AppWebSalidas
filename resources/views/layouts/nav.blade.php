<nav class="navbar navbar-expand-md navbar-dark bg-appsalidas shadow">
    <div class="container-fluid">
        <a class="navbar-brand py-1" href="{{ url('/') }}">
            <h3> {{ config('app.name', 'Laravel') }}</h3>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('user.home') }}" class="nav-link">Perfil</a>
                    </li>
                    @switch(session('role'))
                        @case('estudiante')

                        @break
                        @case('docente')
                        <li class="nav-item">
                            <a href="{{ route('my-activities') }}" class="nav-link">Mis Actividades</a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ route('allactivities') }}" class="nav-link">Todas las Actividades</a>
                        </li>
                        @break
                        @case('director')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                Listas de Usuarios
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('students') }}">Estudiantes</a>
                                <a class="dropdown-item" href="{{ route('teachers') }}">Docentes</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('activities') }}" class="nav-link">Actividades</a>
                        </li>
                        @break
                        @case('administrador')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                Listas de Usuarios
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('students') }}">Estudiantes</a>
                                <a class="dropdown-item" href="{{ route('teachers') }}">Docentes</a>
                                <a class="dropdown-item" href="{{ route('directors') }}">Directores</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('faculties') }}" class="nav-link">Facultades</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('programs') }}" class="nav-link">Programas</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('activities') }}" class="nav-link">Actividades</a>
                        </li>
                        @break
                        @default
                    @endswitch
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-capitalize" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} {{ Auth::user()->lastname }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-capitalize bg-appsalidas">{{ session('role') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
