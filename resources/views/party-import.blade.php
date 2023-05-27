@extends('components.layout')
@section('content')
    <div class="container mt-5 text-center" style="min-height: 550px">
        <div class="bg-white bg-import">
            <h2 class="mb-4 font-weight-bold">
                Nhập danh sách buổi tiệc
            </h2>
            <form action="{{ route('party-import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                    <div class="custom-file text-left">
                        <input type="file" name="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="form-group mt-4" style="max-width: 100%; width: 500px; display: flex; flex-wrap: wrap; justify-content: space-between; margin: 0 auto;">
                    <a href="{{ asset('./assets/excel/template-party.xlsx') }}" target="_blank" title="Tải template">Download template</a>
                    <button type="submit" class="btn btn-primary">Import data</button>
                </div>
            </form>
        </div>
    </div>
@endsection