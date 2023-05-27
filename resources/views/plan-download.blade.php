@extends('components.layout')
@section('content')
    <div class="container mt-5 text-center" style="min-height: 550px">
        <div class="bg-white bg-export">
            <h2 class="mb-4">
                Tải danh sách plan
            </h2>
            <a class="btn btn-success" href="{{ route('plan-export') }}">Export data</a>
        </div>
    </div>
@endsection