<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Dashboard - CARIT</title>
    <link rel="stylesheet" href="css/simplebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/feather.css">
    <link rel="stylesheet" href="css/daterangepicker.css">
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
  </head>
  <body class="light rtl">
    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">
        <form action="{{ route('login') }}" method="post"  class="col-lg-3 col-md-4 col-10 mx-auto text-center form-login">
          @csrf
          <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
            <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
              <g>
                <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
              </g>
            </svg>
          </a>
          <h1 class="h6 mb-3">تسجيل الدخول</h1>
          <div class="form-group">
            <label for="inputEmail" class="input-label">البريد الإلكتروني</label>
            <input name="email" type="email" id="inputEmail" class="form-control form-control-lg" placeholder="أدخل البريد الإلكتروني" required="" autofocus="">
            <span class="text-danger" style="text-align: right!important;" id="email-error"></span>

          </div>
          <div class="form-group">
            <label for="inputPassword" class="input-label">كلمة المرور</label>
            <input name="password" type="password" id="inputPassword" class="form-control form-control-lg" placeholder="أدخل كلمة المرور" required="">
            <span class="text-danger" style="text-align: right!important;" id="password-error"></span>

          </div>
          <div class="checkbox mb-3">
            
          </div>
          <button type="submit" class="btn btn-lg btn-primary btn-block" type="submit">تسجيل الدخول</button>
          <div class="container-fluid">
          <div class="col footer mt-5">
              <div class="row-sm-6">
                  <script>document.write(new Date().getFullYear())</script> © 
                  <span class="gradient-text">
                      <a href="https://www.facebook.com/lyndaagency"><span class="gradient-text">LINDA AGENCY</span></a>
                  </span>
              </div>
              <div class="row-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                  Design & Develop by <a href="https://www.linkedin.com/in/hkmt-ali/" class="text-decoration-underline"><span class="gradient-text">Hkmt Ali</span></a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/simplebar.min.js') }}"></script>
    <script src='{{ asset('js/daterangepicker.js') }}'></script>
    <script src='{{ asset('js/jquery.stickOnScroll.js') }}'></script>
    <script src="{{ asset('js/tinycolor-min.js') }}"></script>
    {{-- <script src="{{ asset('js/config.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/apps.js') }}"></script> --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
      <script src="{{ asset('js/ajax.js') }}"></script>
     
    </body>
</html>
</body>
</html>