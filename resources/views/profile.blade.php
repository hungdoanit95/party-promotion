@extends('components.layout')
@section('content')
    <div class="container mt-2 text-center">
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="{{ !empty($user_info['avatar'])?$user_info['avatar']:'/assets/img/user-icon.png'}}" alt="Profile" class="rounded-circle">
              <h2>{{ isset($user_info['username'])?$user_info['username']:'-----'; }}</h2>
              <h3>{{ isset($user_info['group_name'])?$user_info['group_name']:'-----'; }}</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Tổng quan</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Thiết lập</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Thay đổi mật khẩu</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Thông tin cá nhân</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Mã nhân viên</div>
                    <div class="col-lg-9 col-md-8">{{ isset($user_info['usercode'])?$user_info['usercode']:'-----'; }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Họ và tên</div>
                    <div class="col-lg-9 col-md-8">{{ isset($user_info['username'])?$user_info['username']:'-----'; }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nhóm nhân viên</div>
                    <div class="col-lg-9 col-md-8">{{ isset($user_info['group_name'])?$user_info['group_name']:'-----'; }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Loại tài khoản</div>
                    <div class="col-lg-9 col-md-8">{{ isset($user_info['group_code'])?$user_info['group_code']:'-----'; }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Số điện thoại</div>
                    <div class="col-lg-9 col-md-8">{{ isset($user_info['telephone'])?$user_info['telephone']:'-----'; }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{ isset($user_info['email'])?$user_info['email']:'-----'; }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Công ty</div>
                    <div class="col-lg-9 col-md-8">CPS Retail Plus</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Địa chỉ</div>
                    <div class="col-lg-9 col-md-8">{{ isset($user_info['address'])?$user_info['address']:'-----'; }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tk ngân hàng</div>
                    <div class="col-lg-9 col-md-8">{{ isset($user_info['bank_number'])?$user_info['bank_number']:'-----'; }}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form>
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="{{ !empty($user_info['avatar'])?$user_info['avatar']:'/assets/img/user-icon.png'}}" alt="Profile">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Họ và tên</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="{{ isset($user_info['username'])?$user_info['username']:'-----'; }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="telephone" class="col-md-4 col-lg-3 col-form-label">Số điện thoại</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="telephone" type="text" class="form-control" id="telephone" value="{{ isset($user_info['telephone'])?$user_info['telephone']:'-----'; }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="text" class="form-control" id="email" value="{{ isset($user_info['email'])?$user_info['email']:'-----'; }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="bank_number" class="col-md-4 col-lg-3 col-form-label">Tài khoản ngân hàng</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="bank_number" type="text" placeholder="Tài khoản ngân hàng" class="form-control" id="bank_number" value="{{ isset($user_info['bank_number'])?$user_info['bank_number']:'-----'; }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
    </div>
@endsection