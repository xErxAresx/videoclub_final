<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{url('/catalog')}}" style="color:#777"><span style="font-size:15pt">&#9820;</span> Videoclub</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if( Auth::check() )
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('categories') && ! Request::is('categories/create')? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/categories')}}">
                            <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                            Categorías
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('catalog') && ! Request::is('catalog/create')? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/catalog')}}">
                            <span class="glyphicon glyphicon-film" aria-hidden="true"></span>
                            Catálogo
                        </a>
                    </li>
                    <li class="nav-item {{  Request::is('catalog/create') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/catalog/create')}}">
                            <span>&#10010</span> Nueva película
                        </a>
                    </li>
                    <li class="nav-item {{  Request::is('catalog/rates') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/catalog/rates')}}">
                            <span class="glyphicon glyphicon-heart-empty"> </span> Mejores peliculas
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav navbar-right" style="padding-top: 1rem;padding-right: 3rem">
                    <li class="nav-item">
                        <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-link nav-link" style="display:inline;cursor:pointer">
                                Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            <form method="GET" action="{{url('/catalog/buscar')}}" class="form-inline my-2 my-lg-0">
                <input name="nom" class="form-control mr-sm-2" type="search" placeholder="Posa el nom de la pelicula" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        @endif
    </div>
</nav>
