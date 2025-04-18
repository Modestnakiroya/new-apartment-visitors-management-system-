<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">
                <img src="{{ asset('image/banner3.jpeg') }}" alt="Logo" class="logo-img">
            </a>
            <a href="#" class="simple-text logo-normal">
                {{ __("SECURITY") }}
            </a>
        </div>
        <div class="sidebar-section">
            <ul class="nav">
                <li class="nav-item @if($activePage == 'dashboard') active @endif">
                    <a class="nav-link" href="{{route('dashboard')}}">
                        <i class="project-icon fas fa-tachometer-alt"></i>
                        <p>{{ __("Dashboard") }}</p>
                        <span class="options-icon">...</span>
                    </a>
                </li>
                <li class="nav-item @if($activePage == 'visitor-management') active @endif">
                    <a class="nav-link" href="{{route('page.index','visitorManagement')}}">
                        <i class="project-icon fas fa-clipboard-list"></i>
                        <p>{{ __("Visitor Mgt") }}</p>
                        <span class="options-icon">...</span>
                    </a>
                </li>
                <li class="nav-item @if($activePage == 'resident-directory') active @endif">
                    <a class="nav-link" href="{{route('page.index','residentDirectory')}}">
                        <i class="project-icon fas fa-address-book"></i>
                        <p>{{ __("Resident Dir") }}</p>
                        <span class="options-icon">...</span>
                    </a>
                </li>
                <li class="nav-item @if($activePage == 'analytics') active @endif">
                    <a class="nav-link" href="{{route('page.index', 'analytics')}}">
                        <i class="project-icon fas fa-chart-line"></i>
                        <p>{{ __("Analytics") }}</p>
                        <span class="options-icon">...</span>
                    </a>
                </li>
                <li class="nav-item @if($activePage == 'security-alerts') active @endif">
                    <a class="nav-link" href="{{route('page.index','securityAlerts')}}">
                        <i class="project-icon fas fa-bell"></i>
                        <p>{{ __("Security Alerts") }}</p>
                        <span class="options-icon">...</span>
                    </a>
                </li>
                <li class="nav-item @if($activePage == 'user') active @endif">
                    <a class="nav-link" href="{{route('profile.edit')}}">
                        <i class="project-icon fas fa-user-circle"></i>
                        <p>{{ __("User Profile") }}</p>
                        <span class="options-icon">...</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');

.sidebar {
    background: #374151; /* Light shade of black */
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
    margin: 0 20px 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-img {
    width: 40px;
    height: auto;
    margin-right: 10px;
    border-radius: 50%;
    transition: transform 0.3s ease;
}

.logo:hover .logo-img {
    transform: rotate(360deg);
}

.simple-text {
    text-transform: uppercase;
    font-size: 16px;
    font-weight: 500;
    color: #ffffff;
    white-space: nowrap;
    text-decoration: none;
}

.sidebar-section {
    margin-bottom: 20px;
}

.nav-item {
    margin: 8px 0;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 8px 15px;
    border-radius: 6px;
    color: #ffffff;
    text-decoration: none;
    transition: all 0.3s ease;
}

.nav-link:hover, .nav-item.active .nav-link {
    background: rgba(255, 255, 255, 0.1);
    transform: translateX(3px);
}

.nav .project-icon {
    font-size: 16px;
    width: 28px;
    height: 28px;
    line-height: 28px;
    text-align: center;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    margin-right: 10px;
    transition: all 0.3s ease;
}

.nav-link:hover .project-icon, .nav-item.active .nav-link .project-icon {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

.nav-link p {
    margin: 0;
    font-size: 13px;
    font-weight: 500;
    color: #ffffff; /* Explicitly white */
    flex-grow: 1;
}

.nav-link:hover p, .nav-item.active .nav-link p {
    color: #ffffff; /* Maintain white on hover/active */
}

.nav-link .options-icon {
    font-size: 14px;
    color: #ffffff; /* White for consistency */
    opacity: 0.5;
    transition: opacity 0.3s ease;
}

.nav-link:hover .options-icon {
    opacity: 1;
}

@media (max-width: 991.98px) {
    .sidebar {
        transform: translateX(-260px);
    }

    .sidebar.is-open {
        transform: translateX(0);
    }
}

.sidebar-wrapper::-webkit-scrollbar {
    width: 5px;
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