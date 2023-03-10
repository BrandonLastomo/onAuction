    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

        <div class="container">
          <a class="navbar-brand active" href="/">onAuction</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              @auth
                  @cannot('citizen')   
                    <li class="nav-item">
                      <a class="nav-link  {{ Request::is('/dashboard') ? 'active' : ''}}" href="/dashboard">Dashboard</a>
                    </li>
                  @endcannot
                  @can('citizen')
                    <li class="nav-item">
                      <a class="nav-link {{ ($active === "mybid") ? 'active' : ''}}" href="/mybid">My Bid</a>
                    </li>
                  @endcan
              @endauth
              {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : ''}}" href="/">Home</a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link {{ ($active === "categories") ? 'active' : ''}}" href="/categories">Categories</a>
              </li>


            </ul>

            @auth
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-labeled btn-dark">
                    Logout
                    <span class="btn-label">
                      <i class="bi bi-box-arrow-right ps-1"></i>
                    </span>
                  </button>
                </form>
              </li>
            </ul>
            @else
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                  <a href="/login">
                    <button type="submit" class="btn btn-labeled btn-dark">
                      <span class="btn-label">
                        <i class="bi bi-box-arrow-in-right pe-1"></i>
                      </span>
                      Login
                    </button>
                  </a>
                </li>
              </ul>
            @endauth

          </div>
        </div>
    </nav>  
