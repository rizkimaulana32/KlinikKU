<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto">KLINIKKU</h1>
        @auth
            @if (auth()->user()->role == 'pasien')
                <nav id="navbar" class="order-last navbar order-lg-0">
                    <ul>
                        <li><a class="nav-link scrollto" href="{{ url('/pasien/home') }}">Home</a></li>
                        <li><a class="nav-link scrollto" href="{{ url('/pasien/dokter') }}">Doctors</a></li>
                        <li><a class="nav-link scrollto" href="{{ url('/pasien/status') }}">Status</a></li>
                        <li><a class="nav-link scrollto" href="{{ url('/pasien/rekammedis') }}">Rekam Medis</a></li>
                        <li><a class="nav-link scrollto" href="{{ url('/pasien/profile') }}">Profile</a></li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="login-btn scrollto">Logout</button>
                </form>
            @endif
        @else
            <nav id="navbar" class="order-last navbar order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#doctors">Doctors</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <a href="{{ route('login') }}" class="login-btn scrollto"><span class="d-none d-md-inline">Login</span></a>
        @endauth
    </div>
</header>
