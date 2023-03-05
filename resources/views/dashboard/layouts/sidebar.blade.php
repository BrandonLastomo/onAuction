    
    
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">
          
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link {{ Request::is('/') ? 'active' : ''}}" aria-current="page" href="/">
                <i class="bi bi-house"></i>
                Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('dashboard') ? 'active' : ''}}" aria-current="page" href="/dashboard">
                <i class="bi bi-tv"></i>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('dashboard/items') ? 'active' : ''}}" aria-current="page" href="/dashboard/items">
                <i class="bi bi-box-seam"></i>
                Item List
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('dashboard/categories') ? 'active' : ''}}" aria-current="page" href="/dashboard/categories">
                <i class="bi bi-grid"></i>
                Category List
              </a>
            </li>
            {{-- @can('admin') --}}
            <li class="nav-item">
              <a class="nav-link {{ Request::is('add-petugas') ? 'active' : ''}}" aria-current="page" href="/dashboard/staff">
                <i class="bi bi-person"></i>
                Staff List
              </a>
            </li>
            {{-- @endcan --}}

          </ul>

          
        </div>
      </nav>