@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'Dashboard', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])

@section('content')
<style>
    .dashboard-background {
        background-color: #f0f8ff;
        background-image: 
            radial-gradient(#ffffff 15%, transparent 16%),
            radial-gradient(#ffffff 15%, transparent 16%);
        background-size: 60px 60px;
        background-position: 0 0, 30px 30px;
    }

    .dashboard-card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.3);
        background-blend-mode: overlay;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }
    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .card-text {
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    .card-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.8;
        transition: all 0.3s ease;
    }
    .dashboard-card:hover .card-icon {
        transform: scale(1.1);
        opacity: 1;
    }
    .math-symbol {
        position: absolute;
        opacity: 0.1;
        font-size: 5rem;
        font-weight: bold;
        color: #000;
        z-index: 0;
        transition: all 0.3s ease;
    }
    .dashboard-card:hover .math-symbol {
        transform: rotate(15deg);
        opacity: 0.15;
    }
    .row {
        margin-bottom: 2rem;
    }

    /* Styles for recent visitors section */
    .recent-visitors {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }
    .visitor-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .visitor-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #e9f3ff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }
    .visitor-info {
        flex-grow: 1;
    }
    .visitor-name {
        font-weight: 600;
        margin-bottom: 0;
    }
    .visitor-details {
        font-size: 0.8rem;
        color: #6c757d;
    }
    .visitor-status {
        font-size: 0.75rem;
        padding: 3px 10px;
        border-radius: 20px;
    }
    .status-checkin {
        background-color: #d1fae5;
        color: #065f46;
    }
    .status-checkout {
        background-color: #fee2e2;
        color: #991b1b;
    }
    .status-expected {
        background-color: #e0e7ff;
        color: #3730a3;
    }

    /* Styles for image carousel */
    .sliding-pictures {
        margin-top: 30px;
        margin-bottom: 30px;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .sliding-pictures-container {
        display: flex;
        overflow-x: auto;
        scroll-behavior: smooth;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }
    .sliding-pictures-container img {
        flex: 0 0 auto;
        width: 300px;
        height: 200px;
        margin-right: 15px;
        object-fit: cover;
        scroll-snap-align: start;
        border-radius: 10px;
    }
    
    /* Welcome message and stats summary */
    .welcome-section {
        background: linear-gradient(135deg, #4b6cb7, #182848);
        color: white;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    .welcome-title {
        font-size: 2rem;
        font-weight: 700;
    }
    .welcome-subtitle {
        opacity: 0.8;
        margin-bottom: 20px;
    }
    .welcome-stats {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    .stat-item {
        text-align: center;
        padding: 10px 15px;
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        backdrop-filter: blur(5px);
    }
    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
    }
    .stat-label {
        font-size: 0.8rem;
        opacity: 0.8;
    }
</style>

<div class="dashboard-background">
    <div class="container-fluid">
        <!-- Welcome Section with Date & Summary -->
        <div class="welcome-section">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="welcome-title">Welcome, Askari: {{ Auth::user()->name}}!</h1>
                    <p class="welcome-subtitle">Today is Monday, April 13, 2025</p>
                    <p>You have 5 expected visitors and 2 security alerts to review today.</p>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-end">
                    <button class="btn btn-light"><i class="fas fa-bell mr-2"></i> Notifications</button>
                </div>
            </div>
            
            <div class="welcome-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ $currentVisitors }}</div>
                    <div class="stat-label">CURRENT VISITORS</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $expectedVisitors }}</div>
                    <div class="stat-label">EXPECTED TODAY</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $pendingApprovals }}</div>
                    <div class="stat-label">PENDING APPROVALS</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $securityAlerts }}</div>
                    <div class="stat-label">SECURITY ALERTS</div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Current Visitors -->
            <div class="col-md-4 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(110,142,251,0.9), rgba(167,119,227,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="top: 10px; left: 10px;">+</span>
                        <i class="fas fa-user-friends card-icon"></i>
                        <a href="{{ route('details') }}"><h3 class="card-title">Current Visitors</h3>
                        <p class="card-text">{{ $currentVisitors }}</p></a>
                    </div>
                </div>
            </div>

            <!-- Expected Visitors -->
            <div class="col-md-4 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(17,153,142,0.9), rgba(56,239,125,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="top: 10px; right: 10px;">Σ</span>
                        <i class="fas fa-calendar-check card-icon"></i>
                        <h3 class="card-title">Expected Visitors</h3>
                        <p class="card-text">{{ $expectedVisitors }}</p>
                    </div>
                </div>
            </div>

            <!-- Today's Visitors -->
            <div class="col-md-4 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(255,154,158,0.9), rgba(250,208,196,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="bottom: 10px; left: 10px;">∞</span>
                        <i class="fas fa-clock card-icon"></i>
                        <h3 class="card-title">Today's Visitors</h3>
                        <p class="card-text">{{ $todaysVisitors }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Pending Approvals -->
            <div class="col-md-4 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(102,126,234,0.9), rgba(118,75,162,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="bottom: 10px; right: 10px;">π</span>
                        <i class="fas fa-clipboard-list card-icon"></i>
                        <h3 class="card-title">Pending Approvals</h3>
                        <p class="card-text">{{ $pendingApprovals }}</p>
                    </div>
                </div>
            </div>

            <!-- Security Alerts -->
            <div class="col-md-4 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(246,211,101,0.9), rgba(253,160,133,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="top: 50%; left: 10px; transform: translateY(-50%);">Δ</span>
                        <i class="fas fa-exclamation-triangle card-icon"></i>
                        <h3 class="card-title">Security Alerts</h3>
                        <p class="card-text">{{ $securityAlerts }}</p>
                    </div>
                </div>
            </div>

            <!-- Overstayed Visitors -->
            <div class="col-md-4 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(94,231,223,0.9), rgba(180,144,202,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="top: 50%; right: 10px; transform: translateY(-50%);">√</span>
                        <i class="fas fa-hourglass-end card-icon"></i>
                        <h3 class="card-title">Overstayed Visitors</h3>
                        <p class="card-text">{{ $overstayedVisitors }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Total Apartments -->
            <div class="col-md-6 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(64,169,255,0.9), rgba(13,71,161,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="bottom: 10px; left: 10px;">#</span>
                        <i class="fas fa-building card-icon"></i>
                        <h3 class="card-title">Total Apartments</h3>
                        <p class="card-text">120</p>
                    </div>
                </div>
            </div>

            <!-- Most Visited Unit -->
            <div class="col-md-6 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(239,108,0,0.9), rgba(251,140,0,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="bottom: 10px; right: 10px;">★</span>
                        <i class="fas fa-medal card-icon"></i>
                        <h3 class="card-title">Most Visited Unit</h3>
                        <p class="card-text">205</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Visitors -->
        <div class="row">
            <div class="col-md-8">
                <div class="recent-visitors">
                    <h3 class="mb-4"><i class="fas fa-history mr-2"></i> Recent Visitor Activity</h3>
                    
                    <div class="visitor-item">
                        <div class="visitor-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="visitor-info">
                            <h5 class="visitor-name">John Smith</h5>
                            <p class="visitor-details">Unit 301 • 30 minutes ago</p>
                        </div>
                        <div>
                            <span class="visitor-status status-checkin">Checked In</span>
                        </div>
                    </div>
                    
                    <div class="visitor-item">
                        <div class="visitor-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="visitor-info">
                            <h5 class="visitor-name">Sarah Johnson</h5>
                            <p class="visitor-details">Unit 205 • 45 minutes ago</p>
                        </div>
                        <div>
                            <span class="visitor-status status-checkout">Checked Out</span>
                        </div>
                    </div>
                    
                    <div class="visitor-item">
                        <div class="visitor-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="visitor-info">
                            <h5 class="visitor-name">Michael Brown</h5>
                            <p class="visitor-details">Unit 112 • 1 hour ago</p>
                        </div>
                        <div>
                            <span class="visitor-status status-expected">Expected</span>
                        </div>
                    </div>
                    
                    <div class="visitor-item">
                        <div class="visitor-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="visitor-info">
                            <h5 class="visitor-name">Lisa Wilson</h5>
                            <p class="visitor-details">Unit 402 • 2 hours ago</p>
                        </div>
                        <div>
                            <span class="visitor-status status-checkin">Checked In</span>
                        </div>
                    </div>
                    
                    <div class="visitor-item">
                        <div class="visitor-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="visitor-info">
                            <h5 class="visitor-name">David Taylor</h5>
                            <p class="visitor-details">Unit 205 • 3 hours ago</p>
                        </div>
                        <div>
                            <span class="visitor-status status-checkout">Checked Out</span>
                        </div>
                    </div>
                    
                 
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="dashboard-card mb-4" style="background: white; padding: 20px;">
                    <h3 class="mb-3"><i class="fas fa-bolt mr-2"></i> Quick Actions</h3>
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-primary mb-2">
                            <i class="fas fa-user-plus mr-2"></i> Register New Visitor
                        </a>
                        <a href="#" class="btn btn-success mb-2">
                            <i class="fas fa-check-circle mr-2"></i> Approve Pending Visitors
                        </a>
                        <a href="#" class="btn btn-info mb-2">
                            <i class="fas fa-file-alt mr-2"></i> Generate Reports
                        </a>
                        <a href="#" class="btn btn-warning mb-2">
                            <i class="fas fa-bell mr-2"></i> Send Notifications
                        </a>
                    </div>
                </div>
                
                <!-- Upcoming Visitors Card -->
                <div class="dashboard-card" style="background: white; padding: 20px;">
                    <h3 class="mb-3"><i class="fas fa-calendar mr-2"></i> Today's Expected</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>James Wilson</strong>
                                <div class="small text-muted">Unit 405, 2:30 PM</div>
                            </div>
                            <span class="badge bg-primary rounded-pill">
                                <i class="fas fa-clock"></i>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Emma Davis</strong>
                                <div class="small text-muted">Unit 301, 3:45 PM</div>
                            </div>
                            <span class="badge bg-primary rounded-pill">
                                <i class="fas fa-clock"></i>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Robert Miller</strong>
                                <div class="small text-muted">Unit 112, 5:00 PM</div>
                            </div>
                            <span class="badge bg-primary rounded-pill">
                                <i class="fas fa-clock"></i>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Building pictures showcase -->
        <div class="sliding-pictures">
            <h3 class="mb-3 ml-3"><i class="fas fa-images mr-2"></i> Building Facilities</h3>
            <div class="sliding-pictures-container p-3">
                <img src="{{ asset('image/apartment_lobby.jpg') }}" alt="Apartment Lobby">
                <img src="{{ asset('image/security_desk.jpg') }}" alt="Security Desk">
                <img src="{{ asset('image/visitor_lounge.jpg') }}" alt="Visitor Lounge">
                <img src="{{ asset('image/apartment_exterior.jpg') }}" alt="Apartment Exterior">
                <img src="{{ asset('image/building_entrance.jpg') }}" alt="Building Entrance">
                <img src="{{ asset('image/parking_area.jpg') }}" alt="Parking Area">
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animations for dashboard elements
        gsap.from('.dashboard-card', {
            duration: 0.8,
            y: 30,
            opacity: 0,
            stagger: 0.1,
            ease: 'power3.out'
        });
        
        gsap.from('.welcome-section', {
            duration: 1,
            y: -30,
            opacity: 0,
            ease: 'power3.out'
        });
        
        gsap.from('.recent-visitors, .sliding-pictures', {
            duration: 1,
            opacity: 0,
            delay: 0.5,
            ease: 'power3.out'
        });
        
        // Auto-scrolling for sliding pictures (simple carousel)
        const picturesContainer = document.querySelector('.sliding-pictures-container');
        if (picturesContainer) {
            let scrollAmount = 0;
            const scrollSpeed = 1;
            const scrollStep = 1;
            
            function autoScroll() {
                scrollAmount += scrollStep;
                picturesContainer.scrollLeft = scrollAmount;
                
                // Reset scroll position when reaching the end
                if (scrollAmount >= picturesContainer.scrollWidth - picturesContainer.clientWidth) {
                    scrollAmount = 0;
                    picturesContainer.scrollLeft = 0;
                }
            }
            
            // Start auto-scrolling
            setInterval(autoScroll, scrollSpeed * 30);
        }
    });
</script>
@endpush