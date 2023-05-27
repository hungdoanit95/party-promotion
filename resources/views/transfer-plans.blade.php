@extends('components.layout')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
<style>
    .pagination svg{
        width: 20px;
    }
    .pagination > nav{
        display: flex;
        width: 100%;
        justify-content: space-between;
    }
    .pagination > nav > div:first-child span.px-4,.pagination > nav > div:first-child a{
        font-size: 12px;
        padding: 8px 15px !important;
    }
    .pagination > nav > div:last-child > div:last-child a,.pagination > nav > div:last-child > div:last-child span.px-4{
        font-size: 12px;
        padding: 8px 15px !important;
    }
    #inputPlanName,.ip-datetime,.btn-clear-filter{
      margin-top: 20px;
    }
    table{
      margin-top: 40px;
    }
    .btn-search-plan, .btn-clear-filter{
      height: 40px;
      width: 48px;
      margin: 20px 10px;
    }
    .btn-link-plan{
      font-size: 13px;
      color: #fff !important;
    }
    #inputUser_chosen a.chosen-single,#inputUserNew_chosen a.chosen-single,#inputUserOld_chosen a.chosen-single,#inputMonth_chosen a.chosen-single{
      position: relative;
      display: block;
      overflow: hidden;
      padding: 0 0 0 8px;
      height: 38px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background: #fff;
      color: #444;
      text-decoration: none;
      white-space: nowrap;
      box-shadow: unset;
      line-height: 38px;
      margin-top: 10px;
    }
    .chosen-container-single .chosen-single div b{
      background-position: 0 9px;
    }
    .container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    h4 {
      width: 100%;
      text-align: center;
      text-transform: capitalize;
      font-family: sans-serif;
      font-size: 12px;
    }

    .wrapper {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .loader {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      position: absolute;
    }
    #show-loading{
      opacity: 0;
      transition: all ease .4s;
      margin-top: 15px;
    }
    #show-loading.show{
      opacity: 1;
    }

    .spinner {
      width: 5px;
      height: 5px;
      background-color: #34bde2;
      border-radius: 50%;
      box-shadow: 0 0 10px 0.5px #34bde2;
    }

    .loader:first-child {
      transform: rotate(120deg);
      animation: load1 2s linear 1.1s infinite;
    }

    .loader:nth-child(2) {
      transform: rotate(90deg);
      animation: load2 2s linear 1.2s infinite;
    }

    .loader:nth-child(3) {
      transform: rotate(60deg);
      animation: load3 2s linear 1.3s infinite;
    }

    .loader:nth-child(4) {
      transform: rotate(30deg);
      animation: load4 2s linear 1.4s infinite;
    }

    .loader:nth-child(5) {
      transform: rotate(10deg);
      animation: load5 2s linear 1.5s infinite;
    }

    .loader:nth-child(6) {
      animation: load6 2s linear 1.6s infinite;
    }

    .loader:nth-child(7) {
      animation: load7 2s linear 1.7s infinite;
    }

    .loader:last-child {
      animation: load8 2s linear 1.8s infinite;
    }

    @keyframes load1 {
      75% {
        opacity: 0;
      }

      85% {
        opacity: 0.3;
      }

      100% {
        transform: rotate(339deg);
        opacity: 1;
      }
    }

    @keyframes load2 {
      75% {
        opacity: 0;
      }

      85% {
        opacity: 0.3;
      }

      100% {
        transform: rotate(342deg);
        opacity: 1;
      }
    }

    @keyframes load3 {
      75% {
        opacity: 0;
      }

      85% {
        opacity: 0.3;
      }

      100% {
        transform: rotate(345deg);
        opacity: 1;
      }
    }

    @keyframes load4 {
      75% {
        opacity: 0;
      }

      85% {
        opacity: 0.3;
      }

      100% {
        transform: rotate(348deg);
        opacity: 1;
      }
    }

    @keyframes load5 {
      50% {
        opacity: 0;
      }

      100% {
        transform: rotate(351deg);
        opacity: 0;
      }
    }

    @keyframes load6 {
      50% {
        opacity: 0;
      }

      100% {
        transform: rotate(354deg);
        opacity: 0;
      }
    }

    @keyframes load7 {
      50% {
        opacity: 0;
      }

      100% {
        transform: rotate(357deg);
        opacity: 0;
      }
    }

    @keyframes load8 {
      50% {
        opacity: 0;
      }

      100% {
        transform: rotate(360deg);
        opacity: 0;
      }
    }
</style>
@section('content')
@if(!empty($user_logged) && $user_logged['group_id'] == 10)
<script>
  $(window).ready(function(){
    $('body').addClass('toggle-sidebar');
    $('header .bi-list.toggle-sidebar-btn').hide();
  })
</script>
<style>
  .toggle-sidebar .sidebar, header .bi-list.toggle-sidebar-btn{
    display: none !important;
    left: -100% !important;
  }
</style>
@endif
    <div class="pagetitle">
      <h1>Chuyển plan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#dashboard">Dashboard</a></li>
          <li class="breadcrumb-item">Chuyển plan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body" style="padding-top: 20px">
              <div class="row">
                <div class="col-lg-3">
                  <label><i class="bi bi-person-badge-fill"></i> N.viên chuyển</label>
                  <select id="inputUserOld" style="margin-top: 10px" class="form-select">
                    <option selected value="*">--- Nhân viên ---</option>
                    @foreach($data['all_users'] as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-3">
                  <label><i class="bi bi-person-badge"></i> N.viên nhận plan</label>
                  <select id="inputUserNew" style="margin-top: 10px" class="form-select">
                    <option selected value="*">--- Nhân viên ---</option>
                    @foreach($data['all_users'] as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-3">
                  <label><i class="bi bi-calendar2-week"></i> Tháng làm</label>
                  <select id="inputMonth" style="margin-top: 10px" class="form-select">
                    <option selected value="*">--- Tháng làm ---</option>
                    @foreach($data['group_month'] as $month)
                      @if((!empty($month)))
                        <option value="{{ $month->route_plan }}">{{ $month->route_plan }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-3">
                  <button class="btn btn-info" id="transferPlan" type="button" style="color: #fff"><i class="bi bi-arrow-left-right"></i> Chuyển đổi</button>
                </div>
              </div>
              <div class="container" id="show-loading">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
      $(document).ready(function() {
        $('table tbody .td-image').magnificPopup({
          type: 'image',
          closeOnContentClick: true,
          mainClass: 'mfp-img-mobile',
          image: {
            verticalFit: true
          }
        });
      });
    </script>
    <style>
      img.mfp-img{
        width: 800px;
      }
      .pagination > nav > div:last-child > div:last-child{
        display: flex;
      overflow: hidden;
      border-top: 1px solid #ccc;
      border-bottom: 1px solid #ccc;
      color: #ccc;
      }
      .pagination > nav > div:last-child > div:last-child a{
        padding: 5px 15px;
        color: #ccc;
      }
      .pagination > nav > div:last-child > div:last-child a:hover{
        color: #000;
      }
      .pagination nav span.inline-flex > span{
        display: inline-grid;
      }
      .pagination nav span.inline-flex > span > span{
        background: #10adde !important;
        margin: 0;
        overflow: hidden;
        color: #fff;
      }
      #btn-download-payroll{
        list-style-type: none;
        background-color: #2778b6;
        color: #efefef;
        line-height: 43px;
        height: 43px;
        padding: 0px;
        margin: 0px 0px 1px 0px;
        -webkit-transition: all 0.25s ease-in-out;
        -moz-transition: all 0.25s ease-in-out;
        -o-transition: all 0.25s ease-in-out;
        transition: all 0.25s ease-in-out;
        cursor: pointer;
        width: 140px;
        display: flex;
        color: #fff;
        align-items: center;
        justify-content: center;
        position: fixed;
        z-index: 999;
        right: 0;
        top: 50%;
        transition: all ease .4s;
        width: auto;
      }
      #btn-download-payroll i{
        width: 45px;
        display: inline-block;
        line-height: 40px;
        text-align: center;
        vertical-align: middle;
        transition: all ease .4s;
        font-size: 20px;
      }
      #btn-download-payroll span{
        padding: 0;
        font-size: 13px;
        width: 0;
        opacity: 0;
        display: block;
        overflow: hidden;
        transition: all ease .5s;
      }
      #btn-download-payroll:hover > span{
        display: block;
        padding: 0 10px;
        width: auto;
        opacity: 1;
        overflow: hidden;
        animation: showbtnDownload .5s ease;
        background-color: #3aa0ef;
      }
      @keyframes showbtnDownload {
        from {
          width: 0;
          opacity: 0;
          display: block;
          overflow: hidden;
          padding: 0;
        }
        to{
          padding: 0 10px;
          width: auto;
          opacity: 1;
          display: block;
          overflow: hidden;
        }
      }
      #btn-download-payroll.show span{
        animation: showbtn .4s ease-out;
      }
      @keyframes showbtn {
        from{
          opacity: 0;
          width: 0;
          display: none;
        }
        to{
          opacity: 1;
          display: block;
        }
      }
    </style>
    <button onclick="downloadExcel()" id="btn-download-payroll" class="btn btn-dark-success btn-md">
      <i class="bi bi-cloud-arrow-down"></i>
      <span>Tải Bc QC</span>
    </button>
    <script>
      $('#inputUserOld').chosen();
      $('#inputUserNew').chosen();
      $('#inputMonth').chosen();
    </script>
    <script>
        $(window).load(function(){
          $('#transferPlan').click(function(){
            let month = $('#inputMonth').chosen().val();
            let user_old_id = $('#inputUserOld').chosen().val();
            let user_new_id = $('#inputUserNew').chosen().val();
            if(month === '*'){
              alert('Vui lòng chọn tháng của plan');
              return;
            }
            if(user_old_id === '*' || user_new_id === '*'){
              alert('Vui lòng chọn đủ người chuyển và người nhận plan');
              return;
            }
            if(user_old_id === user_new_id){
              alert('Người chuyển và người nhận plan đang trùng nhau');
              return;
            }
            $.ajax({
              url: "{{ route('update.transfer.plan') }}",
              data:{
                '_token': "{{ csrf_token() }}",
                'month': month,
                'user_old_id': user_old_id,
                'user_new_id': user_new_id
              },
              method: 'POST',
              dataType: 'json',
              beforeSend: function (){
                $('#show-loading').css('opacity',1);
                $('#show-loading').append(`<h5>Vui lòng chờ</h5>
        <div class="wrapper">
            <div class="loader">
                <div class="spinner"></div>
            </div>
            <div class="loader">
                <div class="spinner"></div>
            </div>
            <div class="loader">
                <div class="spinner"></div>
            </div>
            <div class="loader">
                <div class="spinner"></div>
            </div>
            <div class="loader">
                <div class="spinner"></div>
            </div>
            <div class="loader">
                <div class="spinner"></div>
            </div>
            <div class="loader">
                <div class="spinner"></div>
            </div>
            <div class="loader">
                <div class="spinner"></div>
            </div>
        </div>`);
              },
              success: function(data){
                $('#show-loading').html(`<h5>${data.message}</h5><a href="{{ route('get-list-plans') }}" class="btn btn-info btn-link-plan">Danh sách plan</a>`);
              }
            })
          });
        });
    </script>
    <script>
      function clearFilter(){
        window.location.href='/get-list-plans';
      }
    </script>
    <script>
      jQuery('.ip-datetime').datetimepicker({
        datepicker:true,
        timepicker:false,
        format:'Y-m-d'
      });
    </script>
@endsection