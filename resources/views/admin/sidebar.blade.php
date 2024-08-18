<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

<div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">

            <li>
                <a href="javascript: void(0);" class="waves-effect">
                    <i class="bx bxs-dashboard"></i>
                    <span key="t-dashboards">Dashboards</span>
                </a>
            </li>

            <li>
                <a href="{{ route('vendor.listing') }}" class="waves-effect">
                    <i class="bx bx-user"></i>
                    <span key="t-users">Vendors</span>   
                </a>
            </li>

            <li>
                <a href="{{ route('service.listing') }}" class="waves-effect">
                    <i class='bx bx-user'></i>
                    <span key="t-users">Services</span>   
                </a>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>
<!-- Left Sidebar End -->