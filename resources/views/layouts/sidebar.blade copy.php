<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Add Bootstrap CSS and FontAwesome icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- Show username here -->
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">                            
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <!-- Toggle button for sidebar -->
                    <i id="toggle-btn" class="fas fa-bars" onclick="toggleSidebar()"></i>
                    <ul class="nav flex-column">
                        @can('view-admin-dashboard') <!-- Example permission check -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-user-shield"></i>
                                <span class="nav-link-text">Admin Dashboard</span>
                            </a>
                        </li>
                        
                        <!-- Project Menu with Submenu -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#projectSubmenu" role="button" aria-expanded="false" aria-controls="projectSubmenu">
                                <i class="fas fa-folder"></i>
                                <span class="nav-link-text">Projects</span>
                                <i class="fas fa-chevron-down float-end"></i>
                            </a>
                            <ul class="collapse submenu" id="projectSubmenu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('projects.index') }}">
                                        <i class="fas fa-eye"></i>
                                        <span class="nav-link-text">View Projects</span>
                                    </a>
                                </li>  
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('projects.create') }}">
                                        <i class="fas fa-folder-plus"></i>
                                        <span class="nav-link-text">Create Project</span>
                                    </a>
                                </li>           
                            </ul>
                        </li>

                        <!-- Issue Menu with Submenu -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#issueSubmenu" role="button" aria-expanded="false" aria-controls="issueSubmenu">
                                <i class="fas fa-bug"></i>
                                <span class="nav-link-text">Issues</span>
                                <i class="fas fa-chevron-down float-end"></i>
                            </a>
                            <ul class="collapse submenu" id="issueSubmenu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('issues.create') }}">
                                        <i class="fas fa-plus-circle"></i>
                                        <span class="nav-link-text">Create Issue</span>
                                    </a>
                                </li>                                   
                            </ul>
                        </li>
                        @endcan
                        @can('view-developer-dashboard')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('developer.dashboard') }}">
                                <i class="fas fa-user"></i>
                                <span class="nav-link-text">Developer Dashboard</span>
                            </a>
                        </li>
                        <!-- Project Menu with Submenu -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#projectSubmenu" role="button" aria-expanded="false" aria-controls="projectSubmenu">
                                <i class="fas fa-folder"></i>
                                <span class="nav-link-text">Projects</span>
                                <i class="fas fa-chevron-down float-end"></i>
                            </a>
                            <ul class="collapse submenu" id="projectSubmenu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('projects.index') }}">
                                        <i class="fas fa-eye"></i>
                                        <span class="nav-link-text">View Projects</span>
                                    </a>
                                </li>  
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('projects.create') }}">
                                        <i class="fas fa-folder-plus"></i>
                                        <span class="nav-link-text">Create Project</span>
                                    </a>
                                </li>           
                            </ul>
                        </li>
                        @endcan
                        @can('view-user-dashboard')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.dashboard') }}">
                                <i class="fas fa-user"></i>
                                <span class="nav-link-text">User Dashboard</span>
                            </a>
                        </li>
                        <!-- Project Menu with Submenu -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#projectSubmenu" role="button" aria-expanded="false" aria-controls="projectSubmenu">
                                <i class="fas fa-folder"></i>
                                <span class="nav-link-text">Projects</span>
                                <i class="fas fa-chevron-down float-end"></i>
                            </a>
                            <ul class="collapse submenu" id="projectSubmenu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('projects.create') }}">
                                        <i class="fas fa-folder-plus"></i>
                                        <span class="nav-link-text">Create Project</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('projects.index') }}">
                                        <i class="fas fa-eye"></i>
                                        <span class="nav-link-text">View Projects</span>
                                    </a>
                                </li>             
                            </ul>
                        </li>
                        @endcan
                        @canany(['view-projects']) <!-- Use permissions or roles -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('projects.index') }}">
                                <i class="fas fa-folder"></i>
                                <span class="nav-link-text">Projects</span>
                            </a>
                        </li>
                        @endcanany
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content Area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title')</h1>
                </div>
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
