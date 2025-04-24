<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pearl Apartment Visitor Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: #2c3e50;
            --sidebar-hover: #34495e;
            --sidebar-active: #3498db;
            --text-light: #ecf0f1;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding-top: 60px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
            letter-spacing: 0.5px;
        }

        .main-container {
            flex: 1;
            display: flex;
            flex-direction: row;
            min-height: calc(100vh - 60px);
        }

        .sidebar {
            background: var(--sidebar-bg);
            width: 280px;
            flex-shrink: 0;
            transition: all 0.3s;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            color: var(--text-light);
            padding: 16px 25px;
            border-left: 4px solid transparent;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            font-size: 1.05rem;
            margin: 4px 0;
        }

        .sidebar .nav-link:hover {
            color: white;
            background-color: var(--sidebar-hover);
            border-left: 4px solid var(--sidebar-active);
            transform: translateX(4px);
        }

        .sidebar .nav-link.active {
            color: white;
            background-color: var(--sidebar-hover);
            border-left: 4px solid var(--sidebar-active);
            font-weight: 500;
        }

        .sidebar .nav-link i {
            margin-right: 14px;
            width: 30px;
            text-align: center;
            font-size: 1.2rem;
        }

        .content-area {
            flex: 1;
            padding: 25px;
            overflow-y: auto;
            background-color: #f8f9fa;
        }

        .navbar-dark {
            background-color: #1a2a3a !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: none;
            padding: 8px 0;
        }

        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f1f5f9;
        }

        .alert {
            border-radius: 8px;
            border: none;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .alert-success {
            background-color: #d1f2eb;
            color: #16a085;
        }

        .alert-danger {
            background-color: #fadbd8;
            color: #c0392b;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }

            .sidebar .nav-link span {
                display: none;
            }

            .sidebar .nav-link i {
                margin-right: 0;
                font-size: 1.4em;
            }
            
            .sidebar .nav-link {
                justify-content: center;
                padding: 18px 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-building me-2"></i>PAVM System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user-edit me-2"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.change-password') }}">
                                        <i class="fas fa-key me-2"></i> Change Password
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-container">
        @auth
            <!-- Sidebar -->
            <nav class="sidebar">
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('residents.index') }}" class="nav-link {{ request()->routeIs('residents.*') ? 'active' : '' }}">
                        <i class="fas fa-user-friends"></i>
                        <span>Residents</span>
                    </a>
                    <a href="{{ route('apartments.index') }}" class="nav-link {{ request()->routeIs('apartments.*') ? 'active' : '' }}">
                        <i class="fas fa-building"></i>
                        <span>Apartments</span>
                    </a>
                    <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>

                @elseif(Auth::user()->isSecurity())
                    <a href="{{ route('security.dashboard') }}" class="nav-link {{ request()->routeIs('security.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('visitors.create') }}" class="nav-link {{ request()->routeIs('visitors.create') ? 'active' : '' }}">
                        <i class="fas fa-user-plus"></i>
                        <span>Check-in Visitor</span>
                    </a>
                    <a href="{{ route('visitors.index') }}" class="nav-link {{ request()->routeIs('visitors.index') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Manage Visitors</span>
                    </a>
                    
                    <a href="{{ route('residents.index') }}" class="nav-link {{ request()->routeIs('residents.*') ? 'active' : '' }}">
                        <i class="fas fa-user-friends"></i>
                        <span>Residents</span>
                    </a>
                @elseif(Auth::user()->isResident())
                    <a href="{{ route('resident.dashboard') }}" class="nav-link {{ request()->routeIs('resident.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('schedule-visit') }}" class="nav-link {{ request()->routeIs('schedule-visit') ? 'active' : '' }}">
                        <i class="fas fa-calendar-plus"></i>
                        <span>Schedule Visit</span>
                    </a>
                    <a href="{{ route('my-visitors') }}" class="nav-link {{ request()->routeIs('my-visitors') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>My Visitors</span>
                    </a>
                @endif
            </nav>
        @endif

        <!-- Main Content Area -->
        <div class="content-area">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('scripts')
</body>
</html>