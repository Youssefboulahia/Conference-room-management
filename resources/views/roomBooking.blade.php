<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

       <!-- Fonts -->
       <link rel="dns-prefetch" href="//fonts.gstatic.com">
       <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
   
        <!-- Font Awesome Icons -->
     <link rel="stylesheet" href={{url("bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css" )}}>
     <!-- Theme style -->
     <link rel="stylesheet" href={{url("bower_components/admin-lte/dist/css/adminlte.min.css" )}}>
     <!-- Google Font: Source Sans Pro -->
     <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   
       <!-- Styles -->
       <link href="{{ asset('css/app.css') }}" rel="stylesheet">

       <style>
         .centered {
            position: fixed;
            top: 50%;
            left: 50%;
            /* bring your own prefixes */
            transform: translate(-50%, -50%);
          }

          .centered_x {
            position: relative;  
            left: 50%;
            /* bring your own prefixes */
            transform: translateX(-50%);
          }

          html, body
          {
              width: 100%;
              height: 100%;
          }
          body
          {
            background:linear-gradient(0deg, rgba(86, 86, 86,0.9), rgba(58, 59, 91,0.9)), url(images/backkk.jpg);
              width: 100%;
              height: 100%;
              background-attachment: fixed;
          }

          @media (max-width:909px){
            .sm_text{
              font-size:20px;
            }
          }
          @media (min-width:909px){
            .sm_text{
              font-size:27px;
            }
          }
       </style>

</head>
<body>
    
    <div class="container">
        @if(session()->has('warning'))
        <div class="alert alert-danger text-center">{{ session()->get('warning') }}</div>
      @endif
     <div class="centered" >
        <h3 style="color:#fff; text-align:center; position:relative;bottom:20px" class="sm_text">You must enter the security code to have an access to the Room Booking System</h3>
        <form action="{{ route('login') }}" method="GET">
            <div class="form-group">
              <input type="text" name="code" style="width:170px; text-align: center" class="form-control centered_x" id="code" aria-describedby="emailHelp" placeholder="Enter code">
            </div>
            <button type="submit" class="btn btn-primary centered_x" style="width:90px; padding-top:2px ; padding-bottom:2px">Submit</button>
          </form>
     </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>