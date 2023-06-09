@extends('components.layout')
@section('content')
    <div class="container mt-5 text-center" style="min-height: 550px">
        <div class="bg-white bg-export">
            <h2>
                Tải danh sách plan party
            </h2>
            <a class="btn btn-success" href="{{ route('plan-party-export') }}"><i class="bi bi-cloud-arrow-down"></i> <span>Xuất báo cáo</span></a>
        </div>
    </div>
@endsection