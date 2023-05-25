<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

  <title>Signin Template for Bootstrap</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

  <!-- Bootstrap core CSS -->
  <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
  {{-- <script src="https://apis.google.com/js/platform.js" async defer></script> --}}
</head>
<link rel="stylesheet" href="/css/sign-in.css">

    
    <main class="form-signin w-100 m-auto">
      @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}

    </div>     
    @endif
    @if (session()->has('loginError'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('loginError') }}

    </div>     

    @endif
      {{-- <form action="/login" method="post" class="form-signin">
        @csrf
        <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please Login</h1>
    
        <div class="form-floating">
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email"  autofocus required>
          <label for="email">Email address</label>
          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
          <label for="password">Password</label>
        </div>
    
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
      </form> --}}


      <body class="text-center">
        <form class="form-signin" action="/login" method="post">
          @csrf
          <img class="mb-4" src="https://upload.wikimedia.org/wikipedia/commons/3/37/Graduate_%28921139%29_-_The_Noun_Project.svg" alt="" width="72" height="72">
          <h1 class="h3 mb-3 font-weight-normal">Login</h1>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email"  autofocus required>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
          <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
        </form>
        <a class="btn btn-danger" href="{{ '/auth/redirect'}}">google</a>
      
    
    </body>
    </main>