@extends('components.layout')
@section('content')
    <div class="container mt-5 text-center" style="min-height: 550px">
        <div class="bg-white bg-import">
            <h2 class="mb-4 font-weight-bold">
                Nhập danh sách plan
            </h2>
            <form action="{{ route('plan-import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4" style="max-width: 100%; width: 500px;">
                    <div class="custom-file text-left">
                        <input type="file" name="file" class="custom-file-input" id="customFile">
                    </div>
                </div>
                <div class="form-group mt-4" style="max-width: 100%; width: 500px; display: flex; flex-wrap: wrap; justify-content: space-between; margin: 0 auto;">
                    <a href="{{ asset('./assets/excel/template-plan.xlsx') }}" target="_blank" title="Tải template">Tải template import</a>
                    <button type="submit" class="btn btn-primary">Import data</button>
                </div>
            </form>
        </div>
    </div>
@endsection