<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(30,30,30);">

    <a class="navbar-brand mx-2" href="{{ route('welcome') }}">{{ $website->nama_website }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <x-navbar-item :active="request()->routeIs('welcome')">
                <a class="nav-link mx-1" href="{{ route('welcome') }}">Home</a>
            </x-navbar-item>

            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kategori
                </a>
                <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown2" >
                    @foreach ($kategori as $item)
                        <a class="dropdown-item" href="{{ route('kategori', $item->id) }}"
                            style="color: white">{{ $item->nama }}</a>
                    @endforeach

                </div>
            </li>
            <x-navbar-item :active="request()->routeIs('about')">
                <a class="nav-link mx-1" href="{{ route('about') }}">About me</a>
            </x-navbar-item>

            @auth
                <li class="nav-item">
                    <a class="nav-link mx-1" href="{{ route('dashboard') }}">Dashboard Admin</a>
                </li>
            @endauth
            @guest
            <li class="nav-item">
                <a class="nav-link mx-1" href="{{ route('login') }}">Login</a>
            </li>
            @endguest
        </ul>
        <form class="form-inline my-2 my-lg-0" action="{{route('search')}}" method="GET">
            <input class="form-control mr-sm-2" type="search" aria-label="Search" name="cari">
            <button class="btn my-2" type="submit"
                style="background-color: rgb(166, 2, 166);color: white;">Search</button>
            ㅤ
        </form>

    </div>

</nav>
