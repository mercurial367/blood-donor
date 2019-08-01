<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rakta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.9.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
    <div>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #d73925;">
        <a class="navbar-brand" href="/"> <b> Rakta </b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto" >
            
            
          </ul>
         <ul class="navbar-nav">
             <li class="nav-item"><a class="nav-link" href="/login" style="color: #fff;"> <i class="fa fa-sign-in"></i> Login</a></li>
             <li class="nav-item"><a class="nav-link" href="/register" style="color: #fff;"><i class="fa fa-user-plus"></i> Register</a></li>             
         </ul>
        </div>
      </nav>
    </div>
    <section class="container">
        @yield('publicFunctions')
    </section>
      {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> --}}
    
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <footer class="text-center" style="bottom:0; position: fixed; background:#6cf; width:100%;">
      &copy; 2019, All Rights Reserved
    </footer>
</body>
</html>