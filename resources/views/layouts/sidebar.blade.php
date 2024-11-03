<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Add Bootstrap CSS and FontAwesome icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        #sidebar {
            min-width: 200px;
            max-width: 200px;
            transition: all 0.3s;
        }
        #sidebar.collapsed {
            max-width: 60px;
            min-width: 60px;
        }
        #sidebar .nav-link {
            white-space: nowrap;
        }
        #sidebar.collapsed .nav-link-text {
            display: none;
        }
        #sidebar .submenu {
            padding-left: 20px;
        }
        #toggle-btn {
            position: absolute;
            top: 10px;
            right: -25px;
            font-size: 1.2em;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <!-- Toggle button for sidebar -->
                    <i id="toggle-btn" class="fas fa-bars" onclick="toggleSidebar()"></i>
                    <ul class="nav flex-column">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span class="nav-link-text">Dashboard</span>
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
    
    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
    </script>
</body>
</html>
