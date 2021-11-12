<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item {{ $url ?? "" }}">
            <a class="nav-link " href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @role('superadmin')
        <li class="nav-heading">Permissions</li>

        <li class="nav-item {{ $url2 ?? "" }} {{ $url3 ?? "" }}">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Roles & Permissions</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('superadmin.permissions.index') }}" class="{{ $url2 ?? "" }}">
                        <i class="bi bi-circle"></i><span>Permissions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.roles.index') }}" class="{{ $url3 ?? "" }}">
                        <i class="bi bi-circle"></i><span>Roles</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item {{ $url4 ?? "" }}">
            <a class="nav-link collapsed" href="{{ route('superadmin.users.index') }}">
                <i class="bi bi-person"></i>
                <span>Users</span>
            </a>
        </li><!-- End Profile Page Nav -->
        @endrole

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-card-list"></i>
                <span>Other</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-heading">Other</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-envelope"></i>
                <span>Contact</span>
            </a>
        </li><!-- End Contact Page Nav -->

    </ul>

</aside>
