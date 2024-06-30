

<!doctype html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="{{asset('storage/favicon.ico')}}" />
    <title>VIETDAI EDUACATION</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  </head>
  <body>
    <body style=" background: rgb(247,248,252);">
      <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="container" style="display: flex;justify-content: center;">
      <form action='/change_password' method="post" enctype="multipart/form-data" style="height: 550px">
        {{csrf_field() }}
        <h3>Đổi mật khẩu</h3>
        <hr class="border-primary-subtle mb-4">
        <div class="row gy-3 overflow-hidden" style="margin-top:15px">
          <div class="col-12">
            <a style="font-size:15px;font-weight:bold"><i class="fi fi-rr-following"></i> Tên đăng nhập</a>
            <div class="form-floating mb-3" style="margin-top:5px">
              <input type="text" placeholder="Tên đăng nhập" name="name" id="name" value="{{Auth::user()->name}}" class="form-control" style="font-size: 15px" placeholder="Tên đăng nhập" readonly >
              <label for="email" class="form-label" style="font-size: 15px">Tên đăng nhập</label>
            </div>
          </div>
          <div class="col-12" style="margin-top:5px">
            <a style="font-size:15px;font-weight:bold">
              <i class="fi fi-rr-key" style="font-size:16px"></i> Mật khẩu mới
            </a>
            <div class="form-floating mb-3" style="margin-top:5px">
              <input type="password" placeholder="Mật khẩu mới" name="password" id="password" class="form-control" value="" placeholder="Mật khẩu" required>
              <label for="password" class="form-label" style="font-size: 15px">Mật khẩu</label>
            </div>
            <div class="form-floating mb-3" style="margin-top:5px">
              <input type="password" placeholder="Nhập lại mật khẩu mới" name="confim_password" id="password" class="form-control" value="" placeholder="Mật khẩu" required>
              <label for="password" class="form-label" style="font-size: 15px">Nhập lại mật khẩu mới</label>
            </div>
          </div>
          <div class="col-12" style="margin-top:5px">
            @if (Session::has('error'))
              <div class="alert-error" role="alert">
                  {{ session('error') }}
              </div>
            @endif
          </div>
         </div>
          <div class="col-12" style="margin-top:5px">
            <div class="d-grid">
              <button class="btn btn-primary btn-lg" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;" type="submit">Đăng nhập</button>
            </div>
          </div>
         <div class="col-12"  style="margin-top:5px">
          <a style="color:black; font-size:14px;">Mật khẩu chứa ít nhất 8 kí tự tồn tại số, chữ thường và chữ hoa.</a>
         </div>
          
        </div>
      </form>
    </div>
      <footer>
          <p>
              Copyright@2023 VIETDAI EDUACATION
          </p>
      </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

      



