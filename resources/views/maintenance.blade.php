<!DOCTYPE html>
<html class="no-js"  lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="/" />
     <?php $base_url=\URL::to('/'); ?>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

      <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/frontend/favicon.ico')}}">

    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/frontend/bootstrap.min.css')}}">
        
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('css/frontend/style.css')}}">

    <link rel="stylesheet" href="{{asset('css/frontend/main.css')}}">
  
</head>
<style>
  @media(max-width:576px){
    .img,.maintain {
      width:100% !important
    }
  }
  section {
    height:100vh
  }
</style>
<body class="h-100">

    <section class="sidenav_main_content d-flex flex-column flex-sm-row justify-content-between align-items-center p-5" style="text-align: center" >
    <div class="img w-50 order-2 order-sm-1">
      <img src="../../public/images/Maintenance.png" height="100%" width="100%">
        </div>
    <div class="maintain w-50 order-1 order-sm-2">
        <div >
        <a href="#"><img src='http://cms.xelwel.com.np/public/images/frontend/logo.png' alt="Mero Rug" class="logo my-3" height="170" width="100%"></a>    
        </div>
        <div >
          <div class="row" >
            <div class="col-md-12">
              <h1 style="color:red;font-weight:600">Maintenance Mode</h1>
              <p>Our site is under Maintenance. Our regular visitors are inconvenienced. We are really sorry for this. We will be back soon. Type maintainance key if you have key
              </p>
            </div>
            
            <div class="col-md-12">
              <div class="col-md-12 text-danger border border-danger" id="error"></div>
            <form {{--action="api/maintenance_key_access"--}} method="post" id="maintenanceForm">
              @csrf
              <div class="form-group col-6 mx-auto ">
                <input type="text" name="maintenance_key" placeholder="Enter Maintainance Key here ..." class="my-3 form-control mb-2"/>          
                <button type="submit" class="btn" id="form-submit">Submit</button>
              </div>
            </form>
            </div>
          </div>
          {{-- <div class="socialize">
              <h4>In the mean time connect with us with the information below.</h4>
              <div class="social">
                <ul>
                <li class="fb">
                <a href="https://www.facebook.com/s" target="_blank">
                <i class="fa fa-facebook"></i>
                </a>
                </li>   
                            
                <li class="twt">
                <a href="https://twitter.com/s" target="_blank">
                <i class="fa fa-twitter"></i>
                </a>
                </li>                                                  
                </ul>
              </div>
            </div> --}}
        </div>
       </div>
      </section>

<!-- jQuery JS -->
<script src="{{asset('js/frontend/vendor/jquery-1.12.4.min.js')}}"></script>


<script>
  //-----------------
  $(document).ready(function(){
  $('#form-submit').click(function(e){
     e.preventDefault();
     /*Ajax Request Header setup*/
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
     /* Submit form data using ajax*/
     $.ajax({
        url: "{{ url('api/maintenance_key_access')}}",
        method: 'post',
        data: $('#maintenanceForm').serialize(),
        success: function(response){
          console.log(response.status); 
          if(response.status == 'success'){
            setTimeout(() => {
              location.reload();
            }, 1000);
          }else if(response.status == 'error'){
            $('#error').html('Invalid Key');
            setTimeout(() => {
               $('#error').html(''); 
            }, 2000);
          }
        }});
     });
  });
  //-----------------
  </script>


</body>
</html>
