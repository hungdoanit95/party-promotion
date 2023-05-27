@extends('components.layout')
@section('content')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<section class="section dashboard">
    <div class="pagetitle">
      <h1>Biểu đồ thống kê</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Biểu đồ thống kê</li>
        </ol>
      </nav>
    </div>
    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Thống kê hoàn thành</h5>

              <div id="pieChart" style="min-height: 400px;" class="echart"></div>

              <script>
                let statistical = '{!! $statistical !!}';
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#pieChart")).setOption({
                    title: {
                      text: 'Thống kê plan',
                      subtext: 'Tổng số plan thực hiên {{ $all_plan }} plans',
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
              <h5 class="card-title">Biểu đồ tc / ktc</h5>
              <div id="donutChart" style="min-height: 400px;" class="echart"></div>
              <script>
                let statistical_success = '{!! $statistical_success !!}';
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
</section>
<script>
  function filter(){
    var val_route_name = document.getElementById('route-plan-ip').value;
    var val_start_date = document.getElementById('start-date-ip').value;
    var val_end_date = document.getElementById('end-date-ip').value;
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
    window.location.href = url_back;

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