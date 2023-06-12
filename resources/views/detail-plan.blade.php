@extends('components.layout')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  .list-images {
      width: 50%;
      margin-top: 20px;
      display: inline-block;
  }
  .hidden { display: none; }
  .box-image {
      width: 100px;
      height: 108px;
      position: relative;
      float: left;
      margin-left: 5px;
  }
  .box-image img {
      width: 100px;
      height: 100px;
  }
  .wrap-btn-delete {
      position: absolute;
      top: -8px;
      right: 0;
      height: 2px;
      font-size: 20px;
      font-weight: bold;
      color: red;
      z-index: 999;
  }
  .btn-delete-image {
    cursor: pointer;
    width: 100%;
    display: inline-block;
    height: 100%;
  }
  .table {
      width: 15%;
  }
  .hidden{
    display:none !important;
  }
  .user-confirm-qc{
    display: inline-block;
    float: right;
    vertical-align: middle;
    padding: 0 11px;
    transition: all ease .4;
  }
  .user-confirm-qc:hover > span{
    border-color: #169d2e;
    color: #169d2e;
  }
  .user-confirm-qc > span{
    padding: 0 15px;
    line-height: 39px;
    border: 1px solid #3ca9d4;
    transition: all ease .8s;
    height: 39px;
    display: inline-block;
    color: #3ca9d4;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    border-right: none;
    overflow: hidden;
    position: relative;
  }
  .user-confirm-qc > span::before{
    content: '';
    position: absolute;
    left: -100%;
    top: 0;
    height: 120%;
    width: 18px;
    background: rgb(20 175 26 / 85%);
    box-shadow: 5px 5px 10px #9d9d9d;
    transform-origin: left;
    transition: all ease .4s;
  }
  .user-confirm-qc:hover > span::before{
    left: 100%;
  }
  .user-confirm-qc > #btn-tick-qc{
    border-radius: 0;
  }
  ul{
    padding-left: 0;
    list-style: none;
  }
  .card-body ul li{
    margin-bottom: 15px;
    display: inline-block;
    width: 100%;
    position: relative;
  }
  select.form-control{
    height: 40px;
    display: inline-block;
  }
  .card-body ul li i{
    position: absolute;
    top: calc(50% + 12px);
    transform: translateY(-50%);
    right: 5px;
    z-index: 1;
  }

  .card-body #dashboard-rs ul li input{
    margin: 0;
    margin-right: 40px;
  }
  .alert{
    padding: 7px 10px;
    font-size: 15px;
  }
  .btn.btn-info{
    background: #3ca9d4;
    color: #eef1f4;
    transition: all ease .4s;
    font-size: 14px;
    padding: 8px 20px;
    float: right;
  }
  .btn.btn-info:hover{
    background: #169d2e;
  }
  .card{
    height: calc(100% - 30px)
  }
  .image-item{
    position: relative;
  } 
  .list-image-plan{
    width: 100%;
    margin-top: 30px;
  }
  .list-image-plan .image-item > img{
    height: 130px;
    object-fit: cover;
  }
  .list-image-plan{
    justify-content: space-around;
  }
  .card-body .list-image-plan li{
    width: 40%;
    margin: 0 0 10px 0;
    text-align: center;
    margin-bottom: 20px !important;
  }
  .list-image-plan select.form-control{
    padding: 4px;
    font-size: 13px;
  }
  .wrap-btn-delete{
    width: 25px;
    height: 25px;
    text-align: center;
    line-height: 25px;
    border-radius: 50%;
    background: #3ca9d4;
    color: #fff;
    font-size: 14px;
    position: absolute;
    top: 0;
    right: 0;
    z-index: 1;
    cursor: pointer;
    transition: all ease .4s;
  }
  .wrap-btn-delete:hover{
    background: #cb2525;
  }
  .infor-plan .form-control{
    width: 50%;
    padding-left: 15px;
    padding-right: 15px;
    float: right;
  }
  .form-control{
    appearance:auto;
  }
  .form-dropzone.show-upload-form{
    display: inline-block;
    width: 100%
  }
  .alert-camera{
    font-size: 13px;
    margin-top: 5px;
    text-align: left;
  }
  .list-data-qc{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around
  }
  .card-body ul.list-data-qc > li{
    width: calc(33.33% - 20px);
    background: #f3f3f3;
    margin-bottom: 20px;
    padding: 10px;
  }
  .card-body ul.list-data-qc > li p{
    font-size: 15px;
  }
  .card-body ul.list-data-qc > li .data-qc{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between
  }
  .card-body ul.list-data-qc > li .data-qc > li{
    width: calc(50% - 7.5px);
    background: #5173cd;
    padding: 7.5px 5px;
    text-align: center;
    border-radius: 10px;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    line-height: 1.1;
  }
  .card-body ul.list-data-qc > li .data-qc > li span{    
    display: inline-block;
    width: 100%;
    font-weight: normal;
    font-size: 10px;
    color: #bfefff;
  }
  .group-qc-code{
    font-size: 13px;
  }
  .group-qc-code li.list-group-item{
    margin: 0;
    display: flex;
    padding: 5px 10px;
  }
  .group-qc-code li.list-group-item a{
    cursor: pointer;
  }
  .group-qc-code .col-4{
    position: relative;
  }
  .group-qc-code .list-group{
    display: none;
  }
  #btn-confirm-report{
    font-size: 13px;
  }
  .group-control-note{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding: 10px;
  }
  #type-qc-note,.group-control-note button{
    font-size: 13px;
    width: calc(20% - 10px);
    height: 40px
  }
  #ip-content-note{
    height: 40px;
     width: 60%;
  }
  .group-content-note h5{
    font-size: 16px;
    font-weight: bold;
  }
  .group-content-note .form-group{
    padding: 5px 0;
  }
</style>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    #plan-reason.showDefault{
      display:inline-block !important;width:100% !important;margin-bottom:20px !important
    }
    .group-qc-code .button-group.clicked .caret{
      transform: rotate(180deg);
    }
    .group-qc-code .button-group.clicked .list-group{
      display: block;
      position: absolute;
      background: #fff;
      z-index: 1;
      box-shadow: 2px 2px 10px #ccc;
      top: 100%;
    }
    .group-qc-code li.list-group-item:nth-child(2n){
      background-color: #fafafa;
    }
</style>
<div class="pagetitle">
  <h1>Chi tiết plan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#dashboard">Dashboard</a></li>
      <li class="breadcrumb-item">Chi tiết plan</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<script>
  $(document).ready(function(){
    $('.group-qc-code .button-group').click(function(e){
      e.stopPropagation();
      $('.group-qc-code .button-group').removeClass('clicked');
      $(this).addClass('clicked');
    });
    $('body').click(function(){
      $('.group-qc-code .button-group').removeClass('clicked');
    });
    $('.group-qc-code .button-group.clicked .list-group').click(function(e){
      e.stopPropagation();
    });
  });
</script>
<section class="section">
  @if(!empty($data['all_overview_stores']) || count($errors) > 0)
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body" style="padding: 0">
          @if(!empty($data['all_overview_stores']))
          <div class="row">
            <div class="col-lg-12">
                <ul style="display:inline-block; width: 100%; margin: 0">
                  @foreach($data['all_overview_stores'] as $overview)
                    <li style="display: inline-block;width: 155px;margin: 15px 0;text-align: center;font-size: 13px;font-weight: bold;">
                      <a href="http://omafox.com/get-info-plan/{{ $overview['id'] }}">
                        <img width="90" height="90" style="object-fit: cover; border-radius: 8px" src={{ "/storage/app/".$overview['link_image'] }} />
                        <span style="display:block">#{{ $overview['id'] }} {{ $overview['plan_name'] }}</span>
                      </a>
                    </li>
                  @endforeach
                </ul>
            </div>
          </div>
          @endif
          @if (count($errors) > 0)
            <div class="row">
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
                  <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                  </ul>
              </div>
              @endif
                
              @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
              </div> 
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  @endif
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body infor-plan">
          <h5 class="card-title">Chi tiết plan #{{ isset($data['plan_info']->plan_id)?$data['plan_info']->plan_id:'' }}</h5>
            <ul>
                <li>
                    <span>N/Viên thực hiện: {{ $data['plan_info']->username }}</span>
                </li>
                <li>
                    <span>Plan Name: {{ $data['plan_info']->plan_name }}</span>
                </li>
                <li>
                    <span>Round: {{ $data['plan_info']->route_plan }}</span>
                </li>
                <li>
                    <span>Checkin:</span>
                    <input {{ (!empty($data['user_info']))?'':'readonly' }} type="datetime" id="check-in-ip" class="form-control ip-datetime" value="{{ $data['plan_info']->time_checkin }}" />
                </li>
                <li>
                    <span>Toạ độ:</span>
                    <input {{ (!empty($data['user_info']))?'':'readonly' }} id="coordinates-ip" readonly style="background: #f1f1f1;" type="text" value="{{ $data['plan_info']->lat?$data['plan_info']->lat:0.00 }} - {{ $data['plan_info']->long?$data['plan_info']->long:0.00 }}" class="form-control">
                </li>
                <li style="display:flex; justify-content: space-around">
                  <input {{ (!empty($data['user_info']))?'':'readonly' }} id="coordinates-lat" style="margin-right: 15px" placeholder="Latitude" type="text" value="{{ $data['plan_info']->lat?$data['plan_info']->lat:0.00 }}" class="form-control">
                    <span style="font-size: 20; font-weight: bold">-</span>
                  <input {{ (!empty($data['user_info']))?'':'readonly' }} id="coordinates-long" style="margin-left: 15px" type="text" placeholder="Longitude" value="{{ $data['plan_info']->long?$data['plan_info']->long:0.00 }}" class="form-control">
                </li>
                <script>
                  $('#coordinates-lat').on('keyup', function(){
                    let lat_val = $(this).val();
                    let long_val = $('#coordinates-long').val();
                    $('#coordinates-ip').val(lat_val + ' - ' + long_val);
                  });
                  $('#coordinates-long').on('keyup', function(){
                    let lat_val = $('#coordinates-lat').val();
                    let long_val = $(this).val();
                    $('#coordinates-ip').val(lat_val + ' - ' + long_val);
                  });
                </script>
                <li>
                    <span>Thời gian upload:</span>
                    <input {{ (!empty($data['user_info']))?'':'readonly' }} type="datetime" id="date-upload-ip" class="form-control ip-datetime" value="{{ $data['plan_info']->date_upload }}" />
                </li>
                <li>
                    <span>Ghi chú nhân viên:</span>
                    <textarea {{ (!empty($data['user_info']))?'':'readonly' }} class="form-control" id="staff-note">{{ $data['plan_info']->note_employee }}</textarea>
                </li>
                <li>
                    <span>Ghi chú Admin:</span>
                    <textarea {{ (!empty($data['user_info']))?'':'readonly' }} class="form-control" id="admin-note">{{ $data['plan_info']->note_admin }}</textarea>
                </li>
            </ul>
            <span id="alert-message"></span>
          @if(!empty($data['user_info']))
          <button type="button" class="btn btn-info" id="btn-save-planinfo"><i class="bi bi-send-check-fill"></i> Lưu lại</button>
          @endif
        </div>
      </div>
    </div>
    <div class="col-lg-6">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Chi tiết buổi tiệc</h5>
            <ul>
                <li>
                    <span>Tên CH: {{ $data['plan_info']->store_name }}</span>
                </li>
                <li>
                    <span>Mã CH: {{ $data['plan_info']->store_code }}</span>
                </li>
                <li>
                    <span>Vùng: {{ $data['plan_info']->region_store }}</span>
                </li>
                <li>
                    <span>Địa chỉ: {{ $data['plan_info']->address }}</span>
                </li>
                <li>
                    <span>Điện thoại: {{ $data['plan_info']->store_phone }}</span>
                </li>
                <li>
                    <span>ASM: {{ $data['plan_info']->asm_name }}</span>
                </li>
                <li>
                    <span>Điện thoại ASM: {{ $data['plan_info']->asm_phone }}</span>
                </li>
            </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Kết quả trưng bày: 
            @if(!empty($data['plan_info']->result) && $data['plan_info']->plan_status == 1 && $data['plan_info']->result == 'Đạt')
              <span id="rs-txt" style="font-weight: bold; font-size: 20px; color: #2d9705">({{ 'Đạt' }})</span>
            @elseif(!empty($data['plan_info']->result) && $data['plan_info']->result == 'Rớt' || $data['plan_info']->plan_status == 2)
              <span id="rs-txt" style="font-weight: bold; font-size: 20px; color: #c30000">({{ 'Rớt' }})</span>
            @endif
          </h5>
          <!-- <p class="list-result-status">
              <span>Trạng thái: </span>
              <select name="plan_result" class="form-control" id="plan-result" style="display:inline-block; width: auto">
                <option value="*">Kết quả</option>
                <option {{ ($data['plan_info']->plan_status == 1)?"selected":"" }} value="1">Thành công</option>
                <option {{ ($data['plan_info']->plan_status == 2)?"selected":"" }} value="2">Không thành công</option>
              </select>
          </p> -->
          <div id="dashboard-rs">
            @if(!empty($data['reasons']))
            <select name="plan_reason" class="form-control plan-reason-all" id="plan-reason" style="{{empty($data['plan_info']->reason_id)?'display:none;width:100%;margin-bottom:20px':'display:inline-block;width:100%;margin-bottom:20px'; }}">
              <option value="*">Lý do KTC</option>
              @foreach($data['reasons'] as $reason)
              <option {{ ($data['plan_info']->reason_id !== null && !empty($data['plan_info']->reason_id) && $reason->reason_id == $data['plan_info']->reason_id)?"selected":"" }} value="{{ $reason->reason_id }}">{{ $reason->reason_name }}</option>
              @endforeach
            </select>
            @endif
            @if(!empty($data['list_questions']))
            <ul class="{{ ($data['plan_info']->plan_status == 2)?'hidden':'' }}" id="list-ipdata-plan" style="list-style:none">
              @foreach($data['list_questions'] as $question)
                <li style="display:flex; flex-wrap: wrap; justify-content: space-between; width: 100%; margin-top: 10px; align-items: center; vertical-align: middle">
                    <p style="margin-top: 0; margin-bottom: 0">{{ $question['survey_name'] }} ({{ $question['target']?$question['target']:'-' }})</p>
                    <?php if($question['survey_type'] !== 'select'){ ?> 
                      <input {{ (!empty($data['user_info']))?'':'readonly' }} id="ip-data-{{ $question['survey_id'] }}" class="ip-value-survey" type="{{ $question['survey_type'] }}" style="border-radius: 10px; border:none; width: 100%; padding: 5px 10px; border: 1px solid #ccc" value="{{ !empty($data['plan_dt_arr'][$question['survey_id']]['value'])?$data['plan_dt_arr'][$question['survey_id']]['value']:''  }}">
                      <?php if(!empty($data['plan_dt_arr'][$question['survey_id']]['value']) && $data['plan_dt_arr'][$question['survey_id']]['value'] >= $data['plan_dt_arr'][$question['survey_id']]['target']){ ?> 
                        <i class="bi bi-clipboard-check text-success"></i>
                      <?php }else{ ?> 
                        <i class="bi bi-clipboard-x text-danger"></i>
                      <?php } ?>
                    <?php }else{ ?>
                      <?php if(!empty($question['survey_answers'])){ ?>
                        <select 
                          class="form-control"
                          id="ip-data-{{ $question['survey_id'] }}" 
                          class="ip-value-survey"
                          style="border-radius: 10px; border:none; width: 100%; padding: 5px 10px; border: 1px solid #ccc"
                        >
                          <?php foreach($question['survey_answers'] as $answer){ ?>
                            <option {!!  !empty($data['plan_dt_arr'][$question['survey_id']]['value']) && $data['plan_dt_arr'][$question['survey_id']]['value'] == $answer['value'] ? 'selected="selected"' : '' !!} value="{{ $answer['value'] }}">
                              {{ $answer['name'] }}
                            </option>
                          <?php } ?>
                        </select>
                      <?php } ?>
                    <?php } ?>
                </li>
              @endforeach
            </ul>
            @endif
          </div>
          <div id="alert-survey"></div>
          @if(!empty($data['user_info']))
          <button type="button" class="btn btn-info" id="btn-save-data"><i class="bi bi-send-check-fill"></i> Lưu lại</button>
          @endif
        </div>
    </div>
    </div>
    <script>
      $('#plan-result').on("change", function(){
        let check_val = $(this).val();
        if(check_val != 2){
          $('#plan-reason').addClass('hidden');
          if($('#list-ipdata-plan').hasClass('hidden')){
            $('#list-ipdata-plan').removeClass('hidden');
          }
        }else{
          if($('#plan-reason').hasClass('hidden')){
            $('#plan-reason').removeClass('hidden');
          }
          $('#plan-reason').addClass('showDefault');
          $('#list-ipdata-plan').addClass('hidden');
          $('#list-ipdata-plan').removeClass('showDefault');
        }
      })
      $('body').on('keyup','.ip-value-survey', function(){
        let check_val = $(this).val();
        let i_element = $(this).parent('li').find('i');
        if(check_val >= 10){
          if(i_element.hasClass('bi-clipboard-x')){
            i_element.removeClass('bi-clipboard-x');
          }
          if(!i_element.hasClass('bi-clipboard-check')){
            i_element.addClass('bi-clipboard-check');
          }
          if(i_element.hasClass('text-danger')){
            i_element.removeClass('text-danger');
          }
          if(!i_element.hasClass('text-success')){
            i_element.addClass('text-success');
          }
        }else{
          if(!i_element.hasClass('bi-clipboard-x')){
            i_element.addClass('bi-clipboard-x');
          }
          if(i_element.hasClass('bi-clipboard-check')){
            i_element.removeClass('bi-clipboard-check');
          }
          if(!i_element.hasClass('text-danger')){
            i_element.addClass('text-danger');
          }
          if(i_element.hasClass('text-success')){
            i_element.removeClass('text-success');
          }
        }
      });
      $('#btn-save-data').on("click",function(){
        let data_send = {};
        // let plan_result = $('#plan-result').val();
        let valueArray = $('.ip-value-survey').map(function() {
          return this.value;
        }).get();
        // if(plan_result == 2){
        //   let ip_reason = $('#plan-reason').val();
        //   if(ip_reason === '*' || ip_reason === '' || ip_reason === null){
        //     alert("Vui lòng chọn lý do không thành công");
        //     return false;
        //   }else{
        //       data_send['id_reason'] = ip_reason;
        //   }
        // }else if(plan_result == 1){
        for(let i = 0; i < valueArray.length; i++){
          let j = i + 1;
          data_send['data'+j] = valueArray[i];
        }
        // }else{
        //   alert("Vui lòng chọn kết quả");
        // }
        $.ajax({
          type: "POST",
          url: "/update-plan-data",
          data: {
            "_token": "{{ csrf_token() }}",
            "data_send": data_send,
            // "type_data": plan_result,
            "user_id": "{{$data['plan_info']->user_id}}", 
            "plan_id": "{{ $data['plan_info']->plan_id }}"
          },
          dataType: "json",
          success: function (response) {
            if(response.status){
              $('#alert-survey').append('<span class="alert alert-success alert-dismissible fade show">'+response.message+'</span>');
            }else{
              $('#alert-survey').append('<span class="alert alert-danger alert-dismissible fade show">'+response.message+'</span>');
            }
            if(response.result !== undefined){
              $('#rs-txt').text(`(${response.result})`);
              if(response.result == 'Rớt'){
                $('#rs-txt').css('color','#c30000');
              }else{
                $('#rs-txt').css('color','#2d9705');
              }
            }
            if(response.type_data == 2){ 
              $('.ip-value-survey').val(0);
            }else if(response.type_data == 1){
              $('#plan-reason').val("*").change();
            }
            setTimeout(() => {
              $('#alert-survey span').remove();
            }, 2000);
          }
        });
      });

      $('#btn-save-planinfo').on('click', function(){
        let time_checkin = $('#check-in-ip').val();
        let latitude = $('#coordinates-lat').val();
        let longitude = $('#coordinates-long').val();
        let date_upload = $('#date-upload-ip').val();
        let staff_note = $('#staff-note').val();
        let note_admin = $('#admin-note').val();
        $.ajax({
          url:'{{ route("update.detail.plan.web") }}',
          method:'POST',
          data:{
            "_token": "{{ csrf_token() }}",
            "time_checkin": time_checkin,
            "latitude": latitude,
            "longitude": longitude,
            "date_upload": date_upload,
            "note_admin": note_admin,
            "staff_note": staff_note,
            "user_id": "{{$data['plan_info']->user_id}}", 
            "plan_id": "{{ $data['plan_info']->plan_id }}"
          },
          dataType: 'json',
          success: function(res){
            $('#alert-message').text(res.message);
            if(res.status){
              $('#alert-message').addClass('alert alert-success alert-dismissible fade show');
            }else{
              $('#alert-message').addClass('alert alert-danger alert-dismissible fade show');
            }
            setTimeout(function(){
              $('#alert-message').text('');
            },2000);
          }
        });
      });
    </script>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Danh sách hình ảnh 
            @if(!empty($data['user_info']))
            <span class="btn btn-upload-img"><i class="bi bi-file-earmark-plus"></i></span>
            @endif
          </h5>
          @if(session('message_upload_alert'))
            <div class="alert alert-success">
              {{ session('message_upload_alert') }}
            </div> 
            @endif  
            <div id="cnt-img-alert"></div>
          <div class="text-center mt-4 form-dropzone">
            <form action="{{ route('update.image.data') }}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <div class="needsclick dropzone" id="document-dropzone"></div>
                </div>
                <input {{ (!empty($data['user_info']))?'':'readonly' }} type="hidden" name="plan_id" value="{{ $data['plan_info']->plan_id }}">
                <div>
                  <button class="mt-2 btn btn-info" type="submit"><i class="bi bi-send-check-fill"></i> Upload</button>
                </div>
              </form>
            </div>
            @if(!empty($data['plan_images']))
            <ul class="list-image-plan" style="list-style:none; display: flex; flex-wrap: wrap; padding: 0;">
                @foreach($data['plan_images'] as $key=>$image)
                  @if(file_exists('./storage/app/'.$image->link_image)) 
                    <li style="display: inline-block; margin: 5px 10px">
                      <div class="image-item">
                        <a href="{{ '/storage/app/'.$image->link_image }}">
                          <img style="width: 130px; margin-bottom: 10px; border-radius: 5px;object-fit: cover;" src="{{ '/storage/app/'.$image->link_image }}" alt="">
                        </a>
                        @if(!empty(!empty($data['user_info'])))
                        <div class="wrap-btn-delete"><span data-id="img-{{ $key }}" value="{{ $image->id }}" class="btn-delete-image">x</span></div>
                        @endif
                      </div>
                        @if(!empty($data['cameras']))
                          <select name="cameras" value="{{ $image->id }}" class="cameras-type" class="form-control">
                            <option value="*">--- Lựa chọn ---</option>
                            @foreach($data['cameras'] as $camera)
                              <option {{ (!empty($image->type_image)&& $image->type_image == $camera['id'])?'selected':'' }} value="{{ $camera['id'] }}">{{ $camera['type_name'] }}</option>
                            @endforeach
                          </select>
                        @endif
                    </li>
                  @else
                  
                  <li style="display: inline-block; margin: 5px 10px">
                      <div class="image-item">
                        <a href="{{ '/storage/app/'.$image->link_image }}">
                          <img style="width: 130px; margin-bottom: 10px; border-radius: 5px;object-fit: cover;" src="{{ '/storage/app/'.$image->link_image }}" alt="">
                        </a>
                        @if(!empty(!empty($data['user_info'])))
                        <div class="wrap-btn-delete"><span data-id="img-{{ $key }}" value="{{ $image->id }}" class="btn-delete-image">x</span></div>
                        @endif
                      </div>
                        @if(!empty($data['cameras']))
                          <select name="cameras" value="{{ $image->id }}" class="cameras-type" class="form-control">
                            <option value="*">--- Lựa chọn ---</option>
                            @foreach($data['cameras'] as $camera)
                              <option {{ (!empty($image->type_image)&& $image->type_image == $camera['id'])?'selected':'' }} value="{{ $camera['id'] }}">{{ $camera['type_name'] }}</option>
                            @endforeach
                          </select>
                        @endif
                    </li>
                  @endif
                @endforeach
            </ul>
            @endif
        </div>
        <input type="hidden" name="plan_id" value="{{ $data['plan_info']->plan_id }}">
      </div>
    </div>
  </div>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
      $(document).ready(function() {
        $('.list-image-plan').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image...',
            mainClass: 'mfp-img-mobile',
            gallery: {
              enabled: true,
              navigateByImgClick: true,
              preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            }
          });
      });
    </script>
  
  @if(!empty($data['user_info']))
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Qc Plan:</h5>
          <ul class="list-data-qc">
            @foreach($data['group_users_qcs'] as $group_user)
            <li>
              <p>{{ $group_user['group_name'] }}</p>
              @if(!empty($group_user['data']))
              <ul class="data-qc">
                @foreach($group_user['data'] as $group)
                <li>
                  {{ $group['username'] }}
                  <span style="display:inline-block; width: 100%">{{ $group['created_at'] }}</span>
                </li>
                @endforeach
              </ul>
              @endif
            </li>
            @endforeach
          </ul>
          @if(!empty($data['user_info']) && $data['user_info']['group_id'] !== 10)
          <div class="col-lg-12">
            <div class="user-confirm-qc">
              <span>{{ !empty($data['user_info'])&&$data['user_info']['username']?$data['user_info']['username']:'' }}</span><button type="button" plan_id="{{ $data['plan_info']->plan_id }}" user_id="{{$data['user_info']['user_id']}}" group_id="{{ $data['user_info']['group_id'] }}" class="btn btn-info" id="btn-tick-qc">Xác nhận đã QC</button></div>
            <div id="show-alert-qc"></div>
          </div>
          <script>
            $(document).ready(function(){
              $('#btn-tick-qc').on('click', function(){
                let user_id = $(this).attr('user_id');
                let group_id = $(this).attr('group_id');
                let plan_id = $(this).attr('plan_id');
                $.ajax({
                  url: '{{ route("confirm.qc.plan")}}',
                  method: 'POST',
                  data: {
                    "_token": "{{ csrf_token() }}",
                    plan_id: plan_id,
                    user_id: user_id,
                    group_id: group_id
                  },
                  dataType: 'json',
                  success: function(res){
                    $('#btn-tick-qc').remove();
                    if(res.status){
                      $('#show-alert-qc').append('<div class="alert alert-success">'+res.message+'</div>')
                    }else{
                      $('#show-alert-qc').append('<div class="alert alert-error">Có lỗi không thể cập nhật!</div>')
                    }
                    setTimeout(function(){
                      $('#show-alert-qc').html('');
                      location.reload();
                    },1000);
                  }
                });
              });
            });
          </script>
          @endif
        </div>
      </div>
    </div>
  </div>
  @endif
  
  @if(!empty($data['user_info']))
  <div class="row group-qc-code">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Qc Code:</h5>
          @unless(empty($data['code_qcs']))
            <div class="row">
              @foreach($data['code_qcs'] as $key=>$groups)
                @if(!empty($groups))
                  @php
                    $i = 0;
                  @endphp
                  <div class="col-4" style="margin-bottom:15px;">
                    <div class="button-group">
                      <ul class="list-group" style="">
                        @foreach($groups['data_code'] as $group)
                        <li class="list-group-item">
                          <a>
                              @if(!empty($data['plan_qc_codes']) && in_array($group['code_id'],$data['plan_qc_codes']))
                                <input {{ (!empty($data['user_info']))?'':'readonly' }} type="checkbox" checked="checked" name="codes[{{ $group['code_id'] }}]" value="{{ $group['code_id'] }}" id="code-{{ $group['code_id'] }}">
                                <label for="code-{{ $group['code_id'] }}">{{ $group['name_qc'] }}</label>
                                @php
                                  $i++;
                                @endphp
                              @else
                              <input {{ (!empty($data['user_info']))?'':'readonly' }} type="checkbox" name="codes[{{ $group['code_id'] }}]" value="{{ $group['code_id'] }}" id="code-{{ $group['code_id'] }}">
                              <label for="code-{{ $group['code_id'] }}">{{ $group['name_qc'] }}</label>
                              @endif
                          </a>
                        </li>
                        @endforeach
                      </ul>
                      <button type="button" class="btn btn-default btn-sm dropdown-toggle btn-group-justified" data-toggle="dropdown" aria-expanded="false">- {{ isset($groups['group_code'])?$groups['group_code']['group_name']:'' }} <span class="badge bg-info">{{ $i }}</span>
                        <span class="caret"></span>
                      </button>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          @endunless
          <div class="row">
            <div class="col-8 alert-group-qc-code"></div>
            <div classs="col-4">
              @if(!empty($data['user_info']))
              <button class="btn btn-info" id="save-qc-code" type="button"><i class="ri-save-3-fill"></i> Lưu lại</button>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
  
  @if(!empty($data['user_info']))
  <div class="row group-confirm-report">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Xác nhận biên bản:</h5>
          <div class="content">
            @if(empty($data['user_confirm_report']))
            <a href="javascript:void(0);" class="btn btn-info btn-confirm-report">
              <i class="bi bi-send-check-fill"></i>
              <span>{{ !empty($data['user_info'])&&$data['user_info']['username']?$data['user_info']['username']:'' }}</span> Xác nhận
            </a>
            @else
            <button type="button" class="btn btn-success"><i class="ri-shield-check-line"></i> {{ $data['user_confirm_report'] }}</button>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

  @if(!empty(!empty($data['user_info'])))
  <script>
    $(document).ready(function(){
      $('.btn-confirm-report').click(function(){
        $.ajax({
          url: '{{ route("update.report.plan")}}',
          data: {
            "_token": "{{ csrf_token() }}",
            'plan_id': "{{ $data['plan_info']->plan_id }}",
            'user_id': "{{ $data['user_info']['user_id'] }}"
          },
          method: 'POST',
          dataType: 'json',
          success: function (res){
            if(res.status){
              $('.group-confirm-report .content').append(`<div style="display: inline-block;" class="alert alert-success alert-dismissible fade show" role="alert">
                ${res.message}
                <button type="button" style="position: relative;padding: 0px 5px;line-height: 33px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <button type="button" class="btn btn-success"><i class="ri-shield-check-line"></i> {{ !empty($data['user_info'])&&$data['user_info']['username'] }}</button>
              `);
              $('.btn-confirm-report').remove();
            }else{
              $('.group-confirm-report .content').append(`<div style="display: inline-block;" class="alert alert-danger alert-dismissible fade show" role="alert">
                ${res.message}
                <button type="button" style="position: relative;padding: 0px 5px;line-height: 33px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>`);
            }
            setTimeout(()=>{
              $('.group-confirm-report .alert').remove();
            },3000);
          }
        });
      });
    });
  </script>
  @endif

  @if(!empty(!empty($data['user_info'])))
  <div class="row group-qc-note">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="content">
            <div class="row">
              <div class="col-2">
                <h5 class="card-title">Qc Note:</h5>
              </div>
              <div class="col-10 group-control-note">
                <select name="type_qc_note" class="form-select" id="type-qc-note">
                  <option selected value="0"> --- Lựa Chọn --- </option>
                  <option value="1">Admin note</option>
                  <option value="2">Sup note</option>
                  <option value="3">Note data sai</option>
                  <option value="4">Đề nghị khắc phục</option>
                  <option value="5">Note khác</option>
                  <option value="6">Note QC</option>
                  <option value="7">Note App - ghi rõ lỗi</option>
                  <option value="8">Note Unlock</option>
                </select>
                <input {{ (!empty($data['user_info']))?'':'readonly' }} type="text" id="ip-content-note" class="form-control" placeholder="Nhập nội dung ghi chú" />
                @if(!empty($data['user_info']))
                <button class="btn btn-info" type="button"><i class="ri-save-3-fill"></i> Lưu lại</button>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-12 group-content-note">
                <div class="form-group">
                  <h5>Admin note</h5>
                  <div class="cnt-note-1">
                    @unless(empty($data['plan_notes'][1]))
                    @foreach($data['plan_notes'][1] as $plan_note)
                    <div class="item-note" id="item-note-{{ $plan_note->note_id }}">
                      <span class="username"><i class="ri-shield-user-line"></i> {{ $plan_note->username }}</span><span class="content"> {{ $plan_note->note_content }}</span> <span class="time"><i class="ri-time-line"></i> {{ $plan_note->created_at }}</span>
                      <div class="tool-control {{ isset($plan_note->is_done)?'hidden':''}}">
                        <button type="button" class="btn btn-success" onClick="updateStatusNote('{{ $plan_note->note_id }}','done')"><i class="bi bi-check-circle"></i></button>
                        <button type="button" class="btn btn-danger" onclick="updateStatusNote('{{ $plan_note->note_id }}','delete')"><i class="bi bi-trash"></i></button>
                      </div>
                    </div>
                    @endforeach
                    @endunless
                  </div>
                </div>
                <div class="form-group">
                  <h5>Sup note</h5>
                  <div class="cnt-note-2">
                    @unless(empty($data['plan_notes'][2]))
                    @foreach($data['plan_notes'][2] as $plan_note)
                    <div class="item-note" id="item-note-{{ $plan_note->note_id }}">
                      <span class="username"><i class="ri-shield-user-line"></i> {{ $plan_note->username }}</span><span class="content"> {{ $plan_note->note_content }}</span> <span class="time"><i class="ri-time-line"></i> {{ $plan_note->created_at }}</span>
                      <div class="tool-control {{ isset($plan_note->is_done)?'hidden':''}}">
                        <button type="button" class="btn btn-success" onClick="updateStatusNote('{{ $plan_note->note_id }}','done')"><i class="bi bi-check-circle"></i></button>
                        <button type="button" class="btn btn-danger" onclick="updateStatusNote('{{ $plan_note->note_id }}','delete')"><i class="bi bi-trash"></i></button>
                      </div>
                    </div>
                    @endforeach
                    @endunless
                  </div>
                </div>
                <div class="form-group">
                  <h5>Note data sai</h5>
                  <div class="cnt-note-3">
                    @unless(empty($data['plan_notes'][3]))
                    @foreach($data['plan_notes'][3] as $plan_note)
                    <div class="item-note" id="item-note-{{ $plan_note->note_id }}">
                      <span class="username"><i class="ri-shield-user-line"></i> {{ $plan_note->username }}</span><span class="content"> {{ $plan_note->note_content }}</span> <span class="time"><i class="ri-time-line"></i> {{ $plan_note->created_at }}</span>
                      <div class="tool-control {{ isset($plan_note->is_done)?'hidden':''}}">
                        <button type="button" class="btn btn-success" onClick="updateStatusNote('{{ $plan_note->note_id }}','done')"><i class="bi bi-check-circle"></i></button>
                        <button type="button" class="btn btn-danger" onclick="updateStatusNote('{{ $plan_note->note_id }}','delete')"><i class="bi bi-trash"></i></button>
                      </div>
                    </div>
                    @endforeach
                    @endunless
                  </div>
                </div>
                <div class="form-group">
                  <h5>Đề nghị khắc phục</h5>
                  <div class="cnt-note-4">
                    @unless(empty($data['plan_notes'][4]))
                    @foreach($data['plan_notes'][4] as $plan_note)
                    <div class="item-note" id="item-note-{{ $plan_note->note_id }}">
                      <span class="username"><i class="ri-shield-user-line"></i> {{ $plan_note->username }}</span><span class="content"> {{ $plan_note->note_content }}</span> <span class="time"><i class="ri-time-line"></i> {{ $plan_note->created_at }}</span>
                      <div class="tool-control {{ isset($plan_note->is_done)?'hidden':''}}">
                        <button type="button" class="btn btn-success" onClick="updateStatusNote('{{ $plan_note->note_id }}','done')"><i class="bi bi-check-circle"></i></button>
                        <button type="button" class="btn btn-danger" onclick="updateStatusNote('{{ $plan_note->note_id }}','delete')"><i class="bi bi-trash"></i></button>
                      </div>
                    </div>
                    @endforeach
                    @endunless
                  </div>
                </div>
                <div class="form-group">
                  <h5>Note khác</h5>
                  <div class="cnt-note-5">
                    @unless(empty($data['plan_notes'][5]))
                    @foreach($data['plan_notes'][5] as $plan_note)
                    <div class="item-note" id="item-note-{{ $plan_note->note_id }}">
                      <span class="username"><i class="ri-shield-user-line"></i> {{ $plan_note->username }}</span><span class="content"> {{ $plan_note->note_content }}</span> <span class="time"><i class="ri-time-line"></i> {{ $plan_note->created_at }}</span>
                      <div class="tool-control {{ isset($plan_note->is_done)?'hidden':''}}">
                        <button type="button" class="btn btn-success" onClick="updateStatusNote('{{ $plan_note->note_id }}','done')"><i class="bi bi-check-circle"></i></button>
                        <button type="button" class="btn btn-danger" onclick="updateStatusNote('{{ $plan_note->note_id }}','delete')"><i class="bi bi-trash"></i></button>
                      </div>
                    </div>
                    @endforeach
                    @endunless
                  </div>
                </div>
                <div class="form-group">
                  <h5>Note QC</h5>
                  <div class="cnt-note-6">
                    @unless(empty($data['plan_notes'][6]))
                    @foreach($data['plan_notes'][6] as $plan_note)
                    <div class="item-note" id="item-note-{{ $plan_note->note_id }}">
                      <span class="username"><i class="ri-shield-user-line"></i> {{ $plan_note->username }}</span><span class="content"> {{ $plan_note->note_content }}</span> <span class="time"><i class="ri-time-line"></i> {{ $plan_note->created_at }}</span>
                      <div class="tool-control {{ isset($plan_note->is_done)?'hidden':''}}">
                        <button type="button" class="btn btn-success" onClick="updateStatusNote('{{ $plan_note->note_id }}','done')"><i class="bi bi-check-circle"></i></button>
                        <button type="button" class="btn btn-danger" onclick="updateStatusNote('{{ $plan_note->note_id }}','delete')"><i class="bi bi-trash"></i></button>
                      </div>
                    </div>
                    @endforeach
                    @endunless
                  </div>
                </div>
                <div class="form-group">
                  <h5>Note App - ghi rõ lỗi</h5>
                  <div class="cnt-note-7">
                    @unless(empty($data['plan_notes'][7]))
                    @foreach($data['plan_notes'][7] as $plan_note)
                    <div class="item-note" id="item-note-{{ $plan_note->note_id }}">
                      <span class="username"><i class="ri-shield-user-line"></i> {{ $plan_note->username }}</span><span class="content"> {{ $plan_note->note_content }}</span> <span class="time"><i class="ri-time-line"></i> {{ $plan_note->created_at }}</span>
                      <div class="tool-control {{ isset($plan_note->is_done)?'hidden':''}}">
                        <button type="button" class="btn btn-success" onClick="updateStatusNote('{{ $plan_note->note_id }}','done')"><i class="bi bi-check-circle"></i></button>
                        <button type="button" class="btn btn-danger" onclick="updateStatusNote('{{ $plan_note->note_id }}','delete')"><i class="bi bi-trash"></i></button>
                      </div>
                    </div>
                    @endforeach
                    @endunless
                  </div>
                </div>
                <div class="form-group">
                  <h5>Note Unlock</h5>
                  <div class="cnt-note-8">
                    @unless(empty($data['plan_notes'][8]))
                    @foreach($data['plan_notes'][8] as $plan_note)
                    <div class="item-note" id="item-note-{{ $plan_note->note_id }}">
                      <span class="username"><i class="ri-shield-user-line"></i> {{ $plan_note->username }}</span><span class="content"> {{ $plan_note->note_content }}</span> <span class="time"><i class="ri-time-line"></i> {{ $plan_note->created_at }}</span>
                      <div class="tool-control {{ isset($plan_note->is_done)?'hidden':''}}">
                        <button type="button" class="btn btn-success" onClick="updateStatusNote('{{ $plan_note->note_id }}','done')"><i class="bi bi-check-circle"></i></button>
                        <button type="button" class="btn btn-danger" onclick="updateStatusNote('{{ $plan_note->note_id }}','delete')"><i class="bi bi-trash"></i></button>
                      </div>
                    </div>
                    @endforeach
                    @endunless
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
</section>
<script>
  jQuery('.ip-datetime').datetimepicker({
    datepicker:true,
    format:'Y-m-d H:i:s'
  });
</script>
<script>
  var uploadedDocumentMap = {}
  Dropzone.options.documentDropzone = {
    url: "{{ route('upload.imagePlanWeb') }}",
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('form').find('input[name="document[]"][value="' + name + '"]').remove()
    },
    init: function () {
    }
  }
</script>
<script>
  $(document).ready(function(){
    setTimeout(function(){
      $('.alert').remove();
    },5000);
  });
</script>
<script>
  $('.btn-upload-img').on('click', function(){
    $('.form-dropzone').toggleClass('show-upload-form');
  });
  $('.btn-delete-image').on('click', function(){
    let text_confirm = "Vui lòng xác nhận xoá hình ảnh này!";
    $(this).parent().parent().parent().remove();
    if(confirm(text_confirm) === true){
      let id_val = $(this).attr('value');
      $.ajax({
        url: "{{ route('delete.image') }}",
        method: "POST",
        data: {
          "_token": "{{ csrf_token() }}",
          id: id_val
        },
        dataType: 'json',
        success: function(res){
          $('#cnt-img-alert').append(`
            <div class="alert">
              ${res.message}
            </div>`);
          if(res.status == 1){
            $('#cnt-img-alert .alert').addClass('alert-success alert-dismissible fade show');
          }else{
            $('#cnt-img-alert .alert').addClass('alert-danger alert-dismissible fade show');
          }
        }
      });
    }
  });
</script>
@if(!empty(!empty($data['user_info'])))
<script>
  $(document).ready(function(){
    $('.cameras-type').on('change', function(){
      if(confirm('Xác nhận chuyển đổi loại hình ảnh') === true){
        let id_image = $(this).attr('value');
        let type_image = $(this).val();
        $(this).addClass("changing");
        $.ajax({
          url: "{{ route('update.status.image') }}",
          method: 'POST',
          data: {
            "_token": "{{ csrf_token() }}",
            'id_image': id_image,
            'type_image': type_image
          },
          dataType: 'json',
          success: function(res){
            $('.cameras-type.changing').parent().append('<p class="alert-camera text-alert">'+res.message+'</p>');
            if(res.status == 1){
              $('.alert-camera.text-alert').addClass('alert-success alert-dismissible fade show');
            }else{
              $('.alert-camera.text-alert').addClass('alert-danger alert-dismissible fade show');
            }
            setTimeout(function(){
              $('.cameras-type').removeClass('changing');
              $('.alert-camera').remove();
            },2000);
          }
        });
      }else{
        $(this).removeAttr('selected');
      }
    });
  });
</script>
@endif
<script>
  $(document).ready(function(){ 
    $('.group-control-note button').click(function(){
      let type_note = $('#type-qc-note').val();
      let content_note = $('#ip-content-note').val();
      let user_id = "{{$data['plan_info']->user_id}}"; 
      let plan_id = "{{ $data['plan_info']->plan_id }}";
      if(type_note == 0 || type_note == '' || type_note == '*'){
        alert('Vui lòng chọn loại notes');
        return;
      }
      if(content_note == ''){
        alert('Vui lòng nhập nội dung cần truyền tải');
        return;
      }
      $.ajax({
        url: "{{ route('update.plan.note') }}",
        data: {
          "_token": "{{ csrf_token() }}",
          "type_note": type_note,
          "content_note": content_note,
          "user_id": user_id,
          "plan_id": plan_id
        },
        method: 'POST',
        dataType: 'json',
        success: function(res){
          if(res.status){
            $('.cnt-note-'+type_note).append(
              `
                <div class="item-note">
                  <span class="username"><i class="ri-shield-user-line"></i> {{ $data['plan_info']->username }}</span><span class="content"> ${content_note}</span> <span class="time"><i class="ri-time-line"></i> ${res.time_update}</span>
                </div>
              `
            );
          }else{
            alert(res.message);
          }
        }
      });
    });
  });
</script>
<script>
  function updateStatusNote(id_plan_note,type_update){
    $.ajax({
      url: '{{ route("update.status.plan.note") }}',
      data:{
        '_token': "{{ csrf_token() }}",
        'id_plan_note': id_plan_note,
        'type_update': type_update
      },
      dataType: 'json',
      method: 'POST',
      success: function (data) {
        if(data.status){
          if(type_update == 'delete'){
            $('#item-note-'+id_plan_note).remove();
          }else{
            $('#item-note-'+id_plan_note+' .tool-control').remove();
          }
        }
      }
    });
  }
</script>
<script>
  $(document).ready(function(){
    $('.group-qc-code ul.list-group input:checkbox').change(function(){
      let count_checked = $(this).parent().parent().parent().find('input:checkbox:checked').length;
      $(this).parent().parent().parent().parent().find('.badge').text(count_checked);
    });
  });
</script>
<script>
  $(document).ready(function(){
    $('#save-qc-code').click(()=>{
      let array_value = [];
      $(".group-qc-code ul.list-group input:checkbox:checked").each(function(){
        array_value.push($(this).val());
      });
      $.ajax({
        url: '{{ route("update.qc.code")}}',
        data: {
          "_token" : "{{ csrf_token()}}",
          "data_code": array_value.toString(),
          "user_id": "{{$data['plan_info']->user_id}}", 
          "plan_id": "{{ $data['plan_info']->plan_id }}"
        },
        method: 'POST',
        dataType: 'json',
        success: function(res){
          if(res.status){
            $('.alert-group-qc-code').append(`
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                ${res.message}
                <button type="button" style="padding: 5px;height: 28px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            `);
          }else{
            $('.alert-group-qc-code').append(`
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ${res.message}
                <button type="button" style="padding: 5px;height: 28px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            `);
          }
          setTimeout(function(){
            $('.alert-group-qc-code .alert').remove();
          },3000);
        }
      });
    });
  });
</script>
<style>
  .item-note{
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-align: stretch;
    align-items: stretch;
    width: 100%;
    margin-bottom: 5px;
  }
  .tool-control{
    margin-left: 5px;
  }
  .item-note .username,.item-note .time{
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding: 5px 10px;
    margin-bottom: 0;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    font-size: 14px;
    text-align: center;
    white-space: nowrap;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
  }
  .item-note .username i,.item-note .time i{
    margin-right: 5px
  }
  .item-note .username{
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
  }
  .item-note .time{
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
  }
  .item-note .content{
    flex: 1;
    padding: 4px 14px;
    border: 1px solid #ced4da;
  }
</style>
@endsection