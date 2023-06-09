<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-nav" href="#">
      <i class="bi bi-grid"></i>
      <span>Thống kê / Tiến độ</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="dashboard-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('dashboard')}}">
          <i class="bi bi-circle"></i><span>Theo dõi tiến độ</span>
        </a>
      </li>
      <li>
        <a href="{{route('dashboard')}}">
          <i class="bi bi-circle"></i><span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="{{route('map.view')}}">
          <i class="bi bi-circle"></i><span>Performan Mapping</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Kế hoạch làm việc</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('get-list-plans-party')}}" class="active">
          <i class="bi bi-circle"></i><span>Plan List</span>
        </a>
      </li>
      <!-- <li>
        <a href="{{route('transfer.plan.party')}}" class="active">
          <i class="bi bi-circle"></i><span>Chuyển Plan</span>
        </a>
      </li> -->
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#party-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-house"></i><span>Danh sách địa điểm</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="party-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('get-party-list')}}" class="active">
          <i class="bi bi-circle"></i><span>Địa điểm tổ chức</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Chức năng import</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    <li>
      <a href="/user-import-export">
        <i class="bi bi-circle"></i><span>Bước 1: Thêm Nhân viên</span>
      </a>
    </li>
    <li>
      <a href="/party-import-export">
        <i class="bi bi-circle"></i><span>Bước 2: Thêm Địa điểm</span>
      </a>
    </li>
    <li>
      <a href="/plan-party-import-export">
        <i class="bi bi-circle"></i><span>Bước 3: Thêm kế hoạch</span>
      </a>
    </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Export Files</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    <li>
      <a href="/download-plan-party-page">
        <i class="bi bi-circle"></i><span>Tải d/s kế hoạch</span>
      </a>
    </li>
    <li>
      <a href="/download-party">
        <i class="bi bi-circle"></i><span>Tải d/s địa điểm</span>
      </a>
    </li>
    <li>
      <a href="/download-user-page">
        <i class="bi bi-circle"></i><span>Tải d/s nhân viên</span>
      </a>
    </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('profile.page') }}">
      <i class="bi bi-person"></i>
      <span>Profile</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('logout.page') }}">
      <i class="bi bi-box-arrow-in-right"></i>
      <span>Logout</span>
    </a>
  </li>

  <!-- <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="forms-elements.html">
          <i class="bi bi-circle"></i><span>Form Elements</span>
        </a>
      </li>
      <li>
        <a href="forms-layouts.html">
          <i class="bi bi-circle"></i><span>Form Layouts</span>
        </a>
      </li>
      <li>
        <a href="forms-editors.html">
          <i class="bi bi-circle"></i><span>Form Editors</span>
        </a>
      </li>
      <li>
        <a href="forms-validation.html">
          <i class="bi bi-circle"></i><span>Form Validation</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="charts-chartjs.html">
          <i class="bi bi-circle"></i><span>Chart.js</span>
        </a>
      </li>
      <li>
        <a href="charts-apexcharts.html">
          <i class="bi bi-circle"></i><span>ApexCharts</span>
        </a>
      </li>
      <li>
        <a href="charts-echarts.html">
          <i class="bi bi-circle"></i><span>ECharts</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="icons-bootstrap.html">
          <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
        </a>
      </li>
      <li>
        <a href="icons-remix.html">
          <i class="bi bi-circle"></i><span>Remix Icons</span>
        </a>
      </li>
      <li>
        <a href="icons-boxicons.html">
          <i class="bi bi-circle"></i><span>Boxicons</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-heading">Pages</li>


  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-faq.html">
      <i class="bi bi-question-circle"></i>
      <span>F.A.Q</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-contact.html">
      <i class="bi bi-envelope"></i>
      <span>Contact</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-register.html">
      <i class="bi bi-card-list"></i>
      <span>Register</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-login.html">
      <i class="bi bi-box-arrow-in-right"></i>
      <span>Login</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-error-404.html">
      <i class="bi bi-dash-circle"></i>
      <span>Error 404</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-blank.html">
      <i class="bi bi-file-earmark"></i>
      <span>Blank</span>
    </a>
  </li> -->

</ul>

</aside><!-- End Sidebar-->