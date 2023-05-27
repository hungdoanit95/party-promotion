@extends('components.layout-nosidebar')
@section('content')
<style>
    #main, #footer{
        margin: 0 !important
    }
    .header .search-bar, .header .header-nav{
      opacity: 0 !important;
    }
    .header .toggle-sidebar-btn{
        display: none;
    }
    .card-body{
        padding: 20px !important;
    }
</style>
<main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                <div class="card-body">
                  @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                  @endif
                  <form class="row g-3 needs-validation" method="POST" action="{{ route('check.login') }}">
                    @csrf
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="ip-username"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Vui lòng username của bạn.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Mật khẩu</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="ip-password"><i class="bi bi-shield-lock"></i></span>
                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                        <div class="invalid-feedback">Vui lòng nhập mật khẩu của bạn!</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ghi nhớ tài khoản</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Đăng nhập</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main>
@endsection