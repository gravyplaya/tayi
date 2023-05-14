<!DOCTYPE html>

<html lang="en">
<head>

    @php($logo=\App\Models\Setting::where('name','logo')->first()->value)
     @php($appname=\App\Models\Setting::where('name','app_name')->first()->value)
    @php($favicon=\App\Models\Setting::where('name','favicon')->first()->value)
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="TotalAI Admin Panel">
  <meta name="author" content="TotalAI">
  <meta name="keywords" content="TotalAI">

  <title>{{$appname}}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

  <!-- core:css -->
  <link rel="stylesheet" href="{{url('user_assets/vendors/core/core.css')}}">
  <!-- endinject -->

  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{url('user_assets/vendors/flatpickr/flatpickr.min.css')}}">
  <!-- End plugin css for this page -->

  <!-- inject:css -->
  <link rel="stylesheet" href="{{url('user_assets/fonts/feather-font/css/iconfont.css')}}">
  <link rel="stylesheet" href="{{url('user_assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
  <!-- endinject -->


<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <!-- End plugin css for this page -->
    
  <!-- Layout styles -->  
  <link rel="stylesheet" href="{{url('user_assets/css/demo1/style.css')}}">  
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{url('storage/app/public/admin/')}}/{{$favicon}}" />
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400&display=swap" rel="stylesheet">
<style>
  body,a,p,h1,h2,h3,h4,h5,h6,button,div{
  font-family: Plus Jakarta Sans !important;
}
.title{
  font-weight:bolder !important;
}
</style>
</head>
<body>
  <div class="main-wrapper">

      @include('admin.layout.sidebar')

  
  
  
    <div class="page-wrapper">
        @include('admin.layout.nav')




      <div class="page-content">

           @yield('content')

      </div>

      @include('admin.layout.footer')
    
    </div>
  </div>


  <!-- core:js -->
  <script src="{{url('user_assets/vendors/core/core.js')}}"></script>
  <!-- endinject -->
      <!-- Form  summernote JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <!-- Plugin js for this page -->
  <script src="{{url('user_assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
  <script src="{{url('user_assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
  <!-- End plugin js for this page -->

  <!-- inject:js -->
  <script src="{{url('user_assets/vendors/feather-icons/feather.min.js')}}"></script>
  <script src="{{url('user_assets/js/template.js')}}"></script>
  <!-- endinject -->
   <script src="{{url('user_assets/vendors/easymde/easymde.min.js')}}"></script>

  <!-- Custom js for this page -->
  <script src="{{url('user_assets/js/dashboard-light.js')}}"></script>
  <!-- End custom js for this page -->

  <script src="{{url('user_assets/js/easymde.js')}}"></script>
  <script src="{{url('user_assets/vendors/tinymce/tinymce.min.js')}}"></script>
    <script src="{{url('user_assets/js/tinymce.js')}}"></script>
    
<script type="text/javascript">
        $('#summernote1').summernote({
            height: 400
        });
    </script>

@stack("scripts")
</body>
</html>    