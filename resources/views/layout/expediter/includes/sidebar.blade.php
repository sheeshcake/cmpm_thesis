

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-hard-hat"></i>
    </div>
    <div class="sidebar-brand-text mx-3">CMPM {{ $data["role"] }}</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Tools
</div>



<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#projectcollapse"
        aria-expanded="true" aria-controls="projectcollapse">
        <i class="fas fa-fw fa-box"></i>
        <span>Projects</span>
    </a>
    <div id="projectcollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tools:</h6>
            <a class="collapse-item" href="/projects">Show All Projects</a>
        </div>
    </div>
    <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#clientcollapse"
        aria-expanded="true" aria-controls="clientcollapse">
        <i class="fas fa-fw fa-user"></i>
        <span>Clients</span>
    </a> -->
    <!-- <div id="clientcollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tools:</h6>
            <a class="collapse-item" href="{{ route('newclient') }}">Add Client</a>
            <a class="collapse-item" href="{{ route('clients') }}">Show All Clients</a>
        </div>
    </div> -->
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>