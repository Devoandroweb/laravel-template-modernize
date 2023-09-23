<!DOCTYPE html>
<html lang="en">
@include('panels.head',['title'=>'Login'])
<body>
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="{{asset('images/logos/dark-logo.svg')}}" width="180" alt="">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                @if(session('message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Ups!</strong> {{session('message')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <form action="{{url('auth')}}" class="needs-validation" novalidate method="POST">
                    @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" value="{{old('password')}}" id="exampleInputPassword1" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" name="remember" value="1" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Ingatkan saya
                      </label>
                    </div>
                  </div>
                  <button id="btn-login" type="button" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Masuk</button>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('panels.script')
  <script>
    $("#btn-login").click(function (e) {
        e.preventDefault();
        login()
    });
    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            login()
        }
    });
    function login(){
        $("#btn-login").addClass('disabled')
        $("#btn-login").text('Tunggu sebentar ...')
        $(".card").addClass('box')
        $('form').submit()
    }
  </script>
</body>
</html>

