  <!-- Sidebar Start -->
  <div class="sidebar pe-4 pb-3">
      <nav class="navbar bg-light navbar-light">
          <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-3">
              <h3 class="text-primary"><i class="fa fa-tree me-2"></i>Suki Cashier</h3>
          </a>
          <div class="d-flex align-items-center ms-4 mb-4">
              <div class="position-relative">
                  <img class="rounded-circle" src="{{ asset('img/user.jpg') }}" alt=""
                      style="width: 40px; height: 40px;">
                  <div class="bg-success rounded-circle border-2 border-white position-absolute end-0 bottom-0 p-1">
                  </div>
              </div>
              <div class="ms-3">
                  <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                  <span>{{ Auth::user()->role }}</span>
              </div>
          </div>
          <div class="navbar-nav w-100">
              <!-- Dashboard -->
              <a href="{{ route('dashboard') }}"
                  class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                  <i class="fa fa-tachometer-alt me-2"></i>Dashboard
              </a>
              <!-- Products -->
              <a href="{{ route('produk.index') }}"
                  class="nav-item nav-link {{ request()->is('produk*') && !request()->is('produk/logproduk*') ? 'active' : '' }}">
                  <i class="fa fa-cube me-2"></i>Produk
              </a>
              <!-- Penjualan -->
              <a href="{{ route('penjualan.index') }}"
                  class="nav-item nav-link {{ request()->routeIs('penjualan*') ? 'active' : '' }}">
                  <i class="fa fa-shopping-cart me-2"></i>Penjualan
              </a>
              <!-- Log Products -->
              <a href="{{ route('produk.logproduk') }}"
                  class="nav-item nav-link {{ request()->routeIs('produk.logproduk') ? 'active' : '' }}">
                  <i class="fa fa-history me-2"></i>Log Produk
              </a>
          </div>
      </nav>
  </div>
  <!-- Sidebar End -->


  <!-- Content Start -->
  <div class="content">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
          <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
              <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
          </a>
          <a href="#" class="sidebar-toggler flex-shrink-0">
              <i class="fa fa-bars"></i>
          </a>
          <form class="d-none d-md-flex ms-4">
              <input class="form-control border-0" type="search" placeholder="Search">
          </form>
          <div class="navbar-nav align-items-center ms-auto">
              <div class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                      <img class="rounded-circle me-lg-2" src="{{ asset('img/user.jpg') }}" alt=""
                          style="width: 40px; height: 40px;">
                      <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                      <a href="#" class="dropdown-item" id="profile">My Profile</a>
                      <a href="{{ route('logout') }}" class="dropdown-item">Log Out</a>
                  </div>
              </div>
          </div>
      </nav>
      <!-- Navbar End -->
      
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
          $(document).ready(function() {
              $('#profile').on('click', function(e) {
                  e.preventDefault();
                  Swal.fire({
                      title: 'Fitur Belum Tersedia',
                      text: 'Fitur My Profile belum tersedia saat ini. Jika Anda mendukung pengembangan fitur ini, silakan bantu dengan dukungan Anda.',
                      icon: 'info',
                      showCancelButton: true,
                      confirmButtonText: 'Support Developer',
                      cancelButtonText: 'Tutup',
                  }).then((result) => {
                      if (result.isConfirmed) {
                          window.open('https://saweria.co/basukiridho', '_blank');
                      }
                  });
              });
          });
      </script>
