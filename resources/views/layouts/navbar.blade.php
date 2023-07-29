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
                    ㅤKategori
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color:rgb(45,45,48);">
                    <a class="dropdown-item" href="#" style="color: white">Action</a>
                    <a class="dropdown-item" href="#" style="color: white">Another action</a>

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
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" aria-label="Search">

            <button class="btn my-2" type="submit"
                style="background-color: rgb(166, 2, 166);color: white;">Search</button>
            ㅤ
        </form>

    </div>

</nav>
