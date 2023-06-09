@extends('components.layout')
@section('content')
    <div class="container mt-5 text-center" style="min-height: 550px">
        <div class="bg-white bg-export">
            <h2 class="font-weight-bold">
                Tải danh sách buổi tiệc
            </h2>
            <a class="btn btn-success" href="{{ route('party-export') }}"><i class="bi bi-cloud-arrow-down"></i> <span>Xuất báo cáo</span></a>
        </div>
    </div>
@endsection