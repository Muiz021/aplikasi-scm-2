<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                @if (Auth::user()->roles == 'konsumen')
                    <img class="rounded-circle me-lg-2" src="{{ asset(Str::replace(url('/') . '/img/profile/', '', '/img/profile/' . Auth::user()->konsumen->gambar)) }}"
                        style="width: 40px; height: 40px;">
                @else
                    <img class="rounded-circle me-lg-2" src="{{ asset('img/user.jpg') }}" alt=""
                        style="width: 40px; height: 40px;">
                @endif
                @if (Auth::user()->roles === 'admin')
                    <span class="d-none d-lg-inline-flex">{{ Auth::user()->username }}</span>
                @elseif (Auth::user()->roles === 'supplier')
                    <span class="d-none d-lg-inline-flex">{{ Auth::user()->username }}</span>
                @else
                    <span class="d-none d-lg-inline-flex">{{ Auth::user()->username }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="{{ route('logout') }}" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</nav>
