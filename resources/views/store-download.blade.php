@extends('components.layout')
@section('content')
    <div class="container mt-5 text-center" style="min-height: 550px">
        <div class="bg-white bg-export">
            <h2 class="mb-4 font-weight-bold">
                Tải danh sách cửa hàng
            </h2>
            <a class="btn btn-success" onClick="exportStore()">Export data</a>
        </div>
    </div>
    <script>
        function exportStore(){
            var key_search = '{{ $key_search }}';
            var url_download = '/store-export';
            if(key_search){
                url_download += '?key_search='+encodeURI(key_search);
            }
            window.location.href = url_download;
        }
    </script>
@endsection