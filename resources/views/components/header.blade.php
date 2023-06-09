<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Website quản trị</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
        <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{asset('./assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('./assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
        <link href="{{asset('./assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
        <link href="{{asset('./assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
        <link href="{{asset('./assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
        <link href="{{asset('./assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
        <link href="{{asset('./assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
        <!-- Template Main CSS File -->
        <link href="{{asset('./assets/css/style.css')}}" rel="stylesheet">
        <style>
            .toggle-sidebar .bi-text-indent-right::before{
                content: "\f5c5"
            }
            .bg-import{
              padding: 25px 15px;
            }
            .bg-import h2{
              font-size: 25px;
              margin-bottom: 15px !important;
            }
            .bg-export{
              padding: 15px
            }
            .bg-export h2{
              font-size: 20px;
              font-weight: bold;
            }
            .bg-export a{
              font-size: 15px;
            }
        </style>
    </head>
    <body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="group-logo d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
          <img src="{{asset('assets/img/logo.jpg')}}" alt="">
          <span class="d-none d-lg-block">Party Promotion</span>
        </a>
        <i class="bi bi-text-indent-right toggle-sidebar-btn"></i>
        </div>
        <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
        </div>
        <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item d-block d-lg-none">
              <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
              </a>
            </li>

            <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-person-lines-fill"></i>
              <span class="d-none d-md-block dropdown-toggle ps-2">{{ !empty($user_info['username'])?$user_info['username']:''; }}</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                  <h6>{{ !empty($user_info['username'])?$user_info['username']:''; }}</h6>
                  <span>{{ !empty($user_info['group_name'])?$user_info['group_name']:''; }}</span>
                </li>
                <li>
                <hr class="dropdown-divider">
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="{{ route('logout.page') }}">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Thoát</span>
                  </a>
                </li>

            </ul>
            </li>

        </ul>
        </nav>

        </header>