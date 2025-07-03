<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard') - E-Inspection</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #059669;
            --warning-color: #d97706;
            --danger-color: #dc2626;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
        }
        
        body {
            background-color: var(--light-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%) !important;
        }
        
        .navbar .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .navbar .nav-link:hover {
            color: white !important;
            background-color: rgba(255,255,255,0.1);
            border-radius: 6px;
        }
        
        .navbar .dropdown-menu {
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            border-radius: 8px;
        }
        
        .main-content {
            min-height: calc(100vh - 76px);
            padding: 2rem 0;
        }
        
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, var(--primary-color) 100%);
            transform: translateY(-1px);
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            color: var(--secondary-color);
        }
        
        .page-header {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
        }
        
        .stats-card.success {
            background: linear-gradient(135deg, var(--success-color) 0%, #10b981 100%);
        }
        
        .stats-card.warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #f59e0b 100%);
        }
        
        .stats-card.danger {
            background: linear-gradient(135deg, var(--danger-color) 0%, #ef4444 100%);
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem 0;
            }
            
            .page-header {
                margin-bottom: 1rem;
                padding: 1rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') ?? '#' }}">
                <i class="bi bi-shield-check me-2"></i>
                E-Inspection Admin
            </a>
            
            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') ?? '#' }}">
                            <i class="bi bi-speedometer2 me-1"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-people me-1"></i>
                            Pengguna
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href=""><i class="bi bi-person-lines-fill me-2"></i>Daftar Pengguna</a></li>
                            <li><a class="dropdown-item" href=""><i class="bi bi-person-plus me-2"></i>Tambah Pengguna</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('admin.jabatan.index') ?? '#' }}"><i class="bi bi-briefcase me-2"></i>Kelola Jabatan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-clipboard-check me-1"></i>
                            Inspeksi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href=""><i class="bi bi-list-check me-2"></i>Daftar Inspeksi</a></li>
                            <li><a class="dropdown-item" href=""><i class="bi bi-plus-circle me-2"></i>Buat Inspeksi</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href=""><i class="bi bi-file-earmark-text me-2"></i>Laporan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="bi bi-gear me-1"></i>
                            Pengaturan
                        </a>
                    </li>
                </ul>
                
                <!-- Right Side Navigation -->
                <ul class="navbar-nav">
                    <!-- Notifications -->
                    <li class="nav-item dropdown">
                        <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="notification-badge">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="width: 300px;">
                            <li><h6 class="dropdown-header">Notifikasi Terbaru</h6></li>
                            <li><a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-info-circle text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-1">Inspeksi Baru</h6>
                                        <p class="mb-1 small text-muted">Ada inspeksi baru yang perlu ditinjau</p>
                                        <small class="text-muted">2 menit yang lalu</small>
                                    </div>
                                </div>
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center" href="#">Lihat Semua Notifikasi</a></li>
                        </ul>
                    </li>
                    
                    <!-- User Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="user-avatar me-2">
                                
                            </div>
                            <span class="d-none d-md-inline"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header"></h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href=""><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                            <li><a class="dropdown-item" href=""><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            <!-- Page Header -->
            @if(!empty(trim($__env->yieldContent('page-header'))))
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-2">
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                        <h1 class="h3 mb-0 text-gray-800">@yield('page-title')</h1>
                        @if(!empty(trim($__env->yieldContent('page-description'))))
                        <p class="text-muted mb-0">@yield('page-description')</p>
                        @endif
                    </div>
                    <div class="col-auto">
                        @yield('page-actions')
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Alert Messages -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle me-2"></i>
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            <!-- Page Content -->
            @yield('content')
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="bg-white border-top mt-auto py-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <small class="text-muted">
                        © {{ date('Y') }} E-Inspection System. All rights reserved.
                    </small>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-muted">
                        Version 1.0.0 | Powered by Laravel
                    </small>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
        
        // Add active class to current nav item
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            
            navLinks.forEach(function(link) {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>