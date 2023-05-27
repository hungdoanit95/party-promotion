@extends('components.layout')
@section('content')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    .ip-datetime,.btn-clear-filter{
      margin-top: 20px;
    }
    table{
      margin-top: 40px;
    }
    .alert{
      position: fixed;
      top: 20%;
      right: 0;
      z-index: 2;
    }
</style>
    <div class="pagetitle">
      <h1>Danh sách plans</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#dashboard">Dashboard</a></li>
          <li class="breadcrumb-item">Plan Lists</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-5" style="position: relative">
                  <input type="text" style="margin-top: 10px" class="form-control" value="{{ $key_search }}" id="search-global" placeholder="Gõ từ khoá và nhấn Enter..." />
                  <button type="button" class="btn btn-info" id="search-stores" style="position: absolute;top: 10px;right: 5px;color: #033f3e;"><i class="bi bi-search"></i></button>
                </div>
              </div>
              @if($store_lists)
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Hình</th>
                        <th scope="col">Tên CH</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Asm</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($store_lists as $key => $store)
                          @if(!empty($store))
                            <tr style="font-size: 14px">
                                <td scope="row"><a href="{{ !empty($store->overview_img)?'/storage/app/'.$store->overview_img:asset('assets/img/store.jpg')}}" class="td-image" target="_blank"><img width="120" style="border-radius: 5px; max-height: 100px; object-fit: cover;" src="{{ !empty($store->overview_img)?'/storage/app/'.$store->overview_img:asset('assets/img/store.jpg')}}" /></a></td>
                                <td>{{ $store->store_name }}</td>
                                <td>
                                    <p style="font-size: 13px; font-weight: bold; margin-bottom: 2px;">Mã buổi tiệc: {{ $store->store_code }}</p>
                                    <p style="font-size: 13px; margin-bottom: 2px;">Địa chỉ: {{ $store->address }}</p>
                                    <p style="font-size: 13px; margin-bottom: 2px;">Toạ độ: {{ $store->lat }} - {{ $store->long }}</p>
                                    <p style="font-size: 13px; margin-bottom: 2px;">Vùng: {{ $store->region }}</p>
                                    <p style="font-size: 13px; margin-bottom: 2px;">Ghi chú: {{ $store->store_note }}</p>
                                </td>
                                <td>
                                  <p style="font-size: 13px; margin-bottom: 2px;">Tên: {{ $store->asm_name }}</p>
                                  <p style="font-size: 13px; margin-bottom: 2px;">Sdt: {{ $store->asm_phone }}</p>
                                </td>
                            </tr>
                          @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $store_lists->links() }}
                </div>
                @else if
                    <p>Không có dữ liệu!</p>
                @endif
              <!-- End Default Table Example -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <style>
      #btn-download-payroll,#btn-update-overview,#btn-group-store{
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
        transform: translateY(-50%);
        transition: all ease .4s;
        width: auto;
      }
      #btn-update-overview {
        top: calc(50% + 65px);
      }
      #btn-group-store{
        top: calc(50% + 130px);
      }
      #btn-download-payroll i,#btn-update-overview i,#btn-group-store i{
        width: 45px;
        height: 40px;
        display: inline-block;
        line-height: 40px;
        text-align: center;
        vertical-align: middle;
        transition: all ease .4s;
        font-size: 20px;
      }
      #btn-download-payroll span, #btn-update-overview span, #btn-group-store span{
        padding: 0;
        font-size: 13px;
        width: 0;
        opacity: 0;
        display: block;
        overflow: hidden;
        transition: all ease .5s;
      }
      #btn-download-payroll:hover > span, #btn-update-overview:hover > span, #btn-group-store:hover > span{
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
      #btn-download-payroll.show span,#btn-update-overview.show span,#btn-group-store.show span{
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
    <button onclick="updateImageOverview()" id="btn-update-overview" class="btn btn-dark-success btn-md">
      <i class="bi bi-images"></i>
      <span>Cập nhật hình</span>
    </button>
    <button onclick="groupStoreId()" id="btn-group-store" class="btn btn-dark-success btn-md">
      <i class="bi bi-gear"></i>
      <span>Gộp mã buổi tiệc</span>
    </button>
    <script>
      function downloadExcel(){
        val_search = $("#search-global").val();
        if(val_search){
          window.location.href="/download-store-page?key_search="+encodeURI(val_search);
        }else{
          window.location.href="/download-store-page";
        }
      }
    </script>
    <script>
      function updateImageOverview(){
        $.ajax({
          url: "{{ route('update-overview-stores')}}",
          method: "POST",
          dataType: "json",
          data:{
            "_token": "{{ csrf_token() }}",
            "update_overview": 1,
          },
          success: function(res){
            alert(res.message);
            if(res.status){
              window.location.reload();
            }else{
              window.location.reload();
            }
          }
        });
      }
    </script>
    <script>
      $(document).ready(function(){
        $('body').on('keyup','#search-global',function(e){
          if (e.key === 'Enter' || e.keyCode === 13) {
            val_search = $(this).val();
            if(val_search){
              window.location.href="/get-store-list?key_search="+encodeURI(val_search);
            }else{
              window.location.href = '/get-store-list';
            }
          }
        });
        $('#search-stores').click(()=>{
            val_search = $('#search-global').val();
            if(val_search){
              window.location.href="/get-store-list?key_search="+encodeURI(val_search);
            }else{
              window.location.href = '/get-store-list';
            }
        });
      });
    </script>
    <script>
      function groupStoreId(){
        $.ajax({
          url: "{{ route('group-store-code')}}",
          method: 'POST',
          data: {
            '_token': '{{ csrf_token() }}',
            'group_data': 1
          },
          dataType: 'json',
          success: function(data){
            if(data.status == 1){
              $('main').append(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                ${data.message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>`);
            }else if(data.status == 2){
              $('main').append(`<div class="alert alert-warning alert-dismissible fade show" role="alert">
                ${data.message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>`);
            }else{
              $('main').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ${data.message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>`);
            }
            setTimeout(()=>{
              $('main .alert').remove();
            },3000);
          }
        });
      }
    </script>
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
@endsection