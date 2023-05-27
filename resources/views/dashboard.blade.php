@extends('components.layout')
@section('content')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  .pagination svg {
    width: 20px;
  }

  .pagination>nav {
    display: flex;
    width: 100%;
    justify-content: space-between;
  }

  .pagination>nav>div:first-child span.px-4,
  .pagination>nav>div:first-child a {
    font-size: 12px;
    padding: 8px 15px !important;
  }

  .pagination>nav>div:last-child>div:last-child a,
  .pagination>nav>div:last-child>div:last-child span.px-4 {
    font-size: 12px;
    padding: 8px 15px !important;
  }
  .rounded-circle {
    border-radius: 50%!important;
  }
  .align-items-center {
    align-items: center!important;
  }
  .dashboard .card-icon {
    font-size: 32px;
    line-height: 0;
    width: 64px;
    height: 64px;
    flex-shrink: 0;
    flex-grow: 0;
  }
  .dashboard .sales-card .card-icon {
    color: #4154f1;
    background: #f6f6fe;
  }
</style>
<div class="pagetitle">
  <h1>Thống kê / Tiến độ</h1>
</div><!-- End Page Title -->

<section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Biểu đồ thực hiện</h5>

              <div id="pieChart" style="min-height: 400px;" class="echart"></div>
              <script>
                let statistical = '{!! $statistical_map !!}';
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#pieChart")).setOption({
                    title: {
                      text: 'Danh sách buổi tiệc',
                      subtext: 'Tổng số {{ $all_plan }} buổi tiệc',
                      left: 'center'
                    },
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      orient: 'vertical',
                      left: 'left'
                    },
                    series: [{
                      name: 'Thống kê trong tháng',
                      type: 'pie',
                      radius: '50%',
                      data: JSON.parse(statistical),
                      emphasis: {
                        itemStyle: {
                          shadowBlur: 10,
                          shadowOffsetX: 0,
                          shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                      }
                    }]
                  });
                });
              </script>

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Biểu đồ kết quả</h5>
              <div id="donutChart" style="min-height: 400px;" class="echart"></div>
              <script>
                let statistical_success = '{!! $statistical_success_map !!}';
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#donutChart")).setOption({
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      top: '5%',
                      left: 'center'
                    },
                    series: [{
                      name: 'Biểu đồ tc/ktc',
                      type: 'pie',
                      radius: ['40%', '70%'],
                      avoidLabelOverlap: false,
                      label: {
                        show: false,
                        position: 'center'
                      },
                      emphasis: {
                        label: {
                          show: true,
                          fontSize: '18',
                          fontWeight: 'bold'
                        }
                      },
                      labelLine: {
                        show: false
                      },
                      data: JSON.parse(statistical_success),
                    }]
                  });
                });
              </script>
            </div>
          </div>
        </div>
      </div>
    </section>
<section class="section dashboard">
  <div class="row">
  <div class="col-xxl-4 col-md-4">
    <div class="card info-card sales-card">

      <div class="card-body">
        <h5 class="card-title">Tổng số buổi tiệc</h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center icon">
            <i class="ri-bookmark-line"></i>
          </div>
          <div class="ps-3">
            <h6>{{ $statistical['all_plan'] }}</h6>
            <span class="text-muted small pt-2 ps-1">Tổng số buổi tiệc</span>
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="col-xxl-4 col-md-4">
    <div class="card info-card sales-card">
      
      <div class="card-body">
        <h5 class="card-title">Đã thực hiện</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="ri-bookmark-line"></i>
          </div>
          <div class="ps-3">
            <h6>{{ $statistical['plan_making'] }}</h6>
            <span class="text-success small pt-1 fw-bold">{{ $statistical['percent_making']}}</span> <span class="text-muted small pt-2 ps-1">CH</span>
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="col-xxl-4 col-md-4">
    <div class="card info-card sales-card">

      <div class="card-body">
        <h5 class="card-title">Chưa thực hiện</h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="ri-bookmark-line"></i>
          </div>
          <div class="ps-3">
            <h6>{{ $statistical['plan_not_made'] }}</h6>
            <span class="text-danger small pt-1 fw-bold">{{ $statistical['percent_notmake'] }}</span> <span class="text-muted small pt-2 ps-1">CH</span>

          </div>
        </div>
      </div>

    </div>
  </div>
  </div>
</section>

<section class="section">
  <div class="col-12">
    <div class="card recent-sales overflow-auto">

      <div class="card-body">
        <h5 class="card-title">Tiến độ thực hiện</h5>

          <div class="row" style="margin-bottom: 10px" >
          <div class="col-lg-3">
            <select id="route-plan-ip" name="route_plan" onChange="filter()" class="form-select">
              <option value="*">--- Tháng ---</option>
              @foreach($route_plans as $plan)
                <option {{ (isset($params_search['route_plan']) && $params_search['route_plan'] == $plan->route_plan )?"selected":""; }} value="{{ $plan->route_plan }}">{{ $plan->route_plan }}</option>
              @endforeach            
            </select>
          </div>
          <div class="col-sm-3">
            <select id="province-filter" name="province_filter" onChange="filter()" class="form-select">
              <option value="*">--- Tỉnh thành ---</option>
              @foreach($province_filter as $province)
                <option value="{{ $province }}">{{ $province }}</option>
              @endforeach            
            </select>
          </div>
          <div class="col-sm-3">
            <input type="datetime" name="start_date" id="start-date-ip" onChange="filter()" value="{{ (isset($params_search['start_date']))?$params_search['start_date']:""; }}" class="form-control ip-datetime" placeholder="Bắt đầu từ..." />
          </div>
          <div class="col-sm-3">
            <input type="datetime" name="end_date" id="end-date-ip" onChange="filter()" value="{{ (isset($params_search['end_date']))?$params_search['end_date']:""; }}" class="form-control ip-datetime" placeholder="...ngày kết thúc" />
          </div>
          <!-- <div class="col-sm-2 text-center"> -->
            <!-- <button class="btn-clear-filter btn btn-info" onclick="clearFilter()"><i class="bi bi-eraser"></i></button> -->
          <!-- </div> -->
        </div>
        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th>Khu vực</th>
              <th scope="col">Nhân viên</th>
              <th scope="col">Tổng plans</th>
              <th scope="col">Hôm nay</th>
              <th scope="col">Tiến độ</th>
              <th scope="col">% Tiến độ</th>
              <th scope="col">Tc/Ktc</th>
              <th scope="col">Đã Qc</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data_users as $key => $user)
            @if($user['total'] > 0)
            <tr>
              <th scope="row"><a href="#">#{{ $key }}</a></th>
              <td>{{ $user['region_name'] }}</td>
              <td>{{ $user['user_name'] }}</td>
              <td><a href="get-list-plans/?user_id={{ $user['id'] }}" target="_blank" class="text-primary">{{ $user['total'] }}</a></td>
              <td>{{ $user['checkin_today'] }}</td>
              <td>{{ $user['progress'] }}</td>
              <td>{{ $user['percent_progress'] }}</td>
              <td>{{ $user['status_tc'] }} / {{ $user['status_ktc'] }}</td>
              <td>{{ $user['total_data_qc'] }}</td>
            </tr>
            @endif
            @endforeach
          </tbody>
        </table>

      </div>

    </div>
  </div>
</section>
<script>
  function filter(){
    var val_route_name = document.getElementById('route-plan-ip').value;
    var val_start_date = document.getElementById('start-date-ip').value;
    var val_end_date = document.getElementById('end-date-ip').value;
    var val_province = document.getElementById('province-filter').value;
    var url_back = "/dashboard?";
    if(val_route_name !== '*'){
      url_back += "route_name="+val_route_name;
    }
    if(val_start_date != '' && val_start_date != undefined && val_start_date != null){
      url_back += "&start_date="+val_start_date;
    }
    if(val_end_date != '' && val_end_date != undefined && val_end_date != null){
      url_back += "&end_date="+val_end_date;
    }
    if(val_province != '*' && val_province != '' && val_province != undefined && val_province != null){
      url_back += "&val_province="+val_province;
    }
    window.location.href = url_back;
  }
</script>
<script>
  function clearFilter(){
    window.location.href="{{ route('dashboard') }}";
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