<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" type="text/css"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex align-items-center justify-content-start">
                <button id="toggle-btn" type="button">
                    <i class="bi bi-grid-fill"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Admin</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                {{-- <li class="sidebar-item">
                    <a href="#" style="background-color: white; margin:8px;" class='sidebar-link has-dropdown collapsed' data-bs-toggle="collapse"
                        data-bs-target="#user" aria-expanded="false" aria-controls="user">
                        <i class="bi bi-people-fill"></i>
                        <span>User Management</span>
                    </a>
                    <ul style="background-color: white; margin:8px;" id="user" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item" >
                            <a href="{{ route('admin.user_management') }}" class="sidebar-link">
                                <span>Manage User</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="sidebar-item">
                    <a id="userManagement" href="{{ route('admin.user_management') }}" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>User Management</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a id="activityManagement" href="{{ route('admin.activity_management') }}" class='sidebar-link'>
                        <i class="bi bi-stickies-fill"></i>
                        <span>My Activity</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a id="logout" href="{{ route('logout') }}" class="sidebar-link">
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main">
            <header>
                <nav style="margin-top: 10px;" class="navbar navbar-expand-lg d-flex align-items-end justify-content-end">
                    {{-- <form class="d-flex ms-4" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> --}}
                    <button data-dropdown
                        style="display: flex; align-items: center; justify-content: center; border: none; background-color: transparent; cursor: pointer;"
                        type="button" x-data="{ open: false }" @click="open = true" :class="{ 'active': open }">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=100&h=100&q=80"
                            alt="Profle" class="w-25 h-25 rounded-circle">
                        <span style="margin-left: 10px;">{{ Auth::user()->name }}</span>
                        <div data-dropdown-items 
                            class="dropdown-item-wrapper"
                            x-show="open" @click.away="open = false">
                            <div class="dropdown-item-list">
                                 <i style="color: black; text-decoration: none;" class="bi bi-door-open-fill"></i>
                                    <a style="color: black; text-decoration: none;" href="{{ route('logout') }}">Log out</a>
                            </div>
                        </div>
                    </button>
                </nav>
            </header>
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    @yield('contents')
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
</body>

</html>
