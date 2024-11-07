<!-- Sidebar -->
<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
    <div class="position-sticky">
        <ul class="nav flex-column">
            @can('access-admin') <!-- Example permission check -->
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
            @can('access-developer')
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
            @can('access-user')
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