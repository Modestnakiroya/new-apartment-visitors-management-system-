<div class="sidebar" data-color="azure">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">
                <img src="image/love.jpeg" alt="Logo" class="logo-img">
            </a>
            <a href="#" class="simple-text logo-normal">
                {{ __("SECURITY") }}
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item @if($activePage == 'dashboard') active @endif">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fa fa-tachometer-alt"></i>
                    <p>{{ __("Dashboard") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'visitor-management') active @endif">
                <a class="nav-link" href="{{route('page.index','visitorManagement')}}">
                    <i class="fa fa-clipboard-list"></i>
                    <p>{{ __("Visitor Mg't") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'resident-directory') active @endif">
                <a class="nav-link" href="{{route('page.index','residentDirectory')}}">
                    <i class="fa fa-address-book"></i>
                    <p>{{ __("Resident Dir") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'analytics') active @endif">
                <a class="nav-link" href="{{route('page.index', 'analytics')}}">
                    <i class="fa fa-chart-line"></i>
                    <p>{{ __("Analytics") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'security-alerts') active @endif">
                <a class="nav-link" href="{{route('page.index','securityAlerts')}}">
                    <i class="fa fa-bell"></i>
                    <p>{{ __("Security Alerts") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'user') active @endif">
                <a class="nav-link" href="{{route('profile.edit')}}">
                    <i class="fa fa-user-circle"></i>
                    <p>{{ __("User Profile") }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');

.sidebar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0 rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
    font-family: 'Poppins', sans-serif;
    position: fixed;
    top: 0;
    height: 100vh;
    width: 260px;
    z-index: 1030;
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
}

.sidebar-wrapper {
    padding: 20px 15px;
    height: calc(100vh - 40px);
    overflow: auto;
}

.logo {
    padding: 15px 0;
    margin: 0 20px 30px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-img {
    width: 40px;
    height: auto;
    margin-right: 10px;
    transition: transform 0.3s ease;
}

.logo:hover .logo-img {
    transform: rotate(360deg);
}

.simple-text {
    text-transform: uppercase;
    font-size: 18px;
    font-weight: 600;
    color: #ffffff;
    white-space: nowrap;
    transition: all 0.3s ease;
    text-decoration: none;
}

.nav-item {
    margin: 15px 0;
    transition: all 0.3s ease;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    border-radius: 10px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.nav-link:before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: all 0.5s ease;
}

.nav-link:hover:before {
    left: 100%;
}

.nav-link:hover, .nav-item.active .nav-link {
    background: rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(60, 72, 88, 0.4);
    transform: translateY(-2px);
}

.nav-link i {
    font-size: 22px;
    margin-right: 15px;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(60, 72, 88, 0.4);
    transition: all 0.3s ease;
}

.nav-link:hover i, .nav-item.active .nav-link i {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}

.nav-link p {
    margin: 0;
    font-size: 14px;
    font-weight: 500;
    color: #ffffff;
    opacity: 0.8;
    transition: all 0.3s ease;
}

.nav-link:hover p, .nav-item.active .nav-link p {
    opacity: 1;
    transform: translateX(5px);
}

@media (max-width: 991.98px) {
    .sidebar {
        transform: translateX(-260px);
    }

    .sidebar.is-open {
        transform: translateX(0);
    }
}

/* Custom Scrollbar */
.sidebar-wrapper::-webkit-scrollbar {
    width: 6px;
}

.sidebar-wrapper::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

.sidebar-wrapper::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 3px;
}

.sidebar-wrapper::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}
</style>