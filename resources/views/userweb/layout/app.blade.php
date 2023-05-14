<!DOCTYPE html>
<html lang="en">
<head>
   @php($logo=\App\Models\Setting::where('name','logo')->first()->value)
     @php($appname=\App\Models\Setting::where('name','app_name')->first()->value)
    @php($favicon=\App\Models\Setting::where('name','favicon')->first()->value)
    @php($currency_symbol=\App\Models\Setting::where('name','currency_symbol')->first()->value)
    @php($razorpay=\App\Models\PaymentGateway::where('id',1)->first())
    @php($stripe=\App\Models\PaymentGateway::where('id',2)->first())
   @php($btncolor=\App\Models\Setting::where('name','btncolor')->first()->value)

    <?php 
       $storage= \DB::table('image_spaces')
                    ->first();

        if($storage->aws == 1){
            $storage_space = "s3.aws";
        }
        else if($storage->wasabi == 1){
            $storage_space = "s3.wasabi";
        }else{
            $storage_space ="same_server";
        }

         if($storage_space != "same_server"){
           $url_aws =  rtrim(\Storage::disk($storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 
       

    ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="{{$appname}}">
  <meta name="author" content="{{$appname}}">
  <meta name="keywords" content="{{$appname}}">

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
  <!-- End plugin css for this page -->
  <!-- Layout styles -->  
  <link rel="stylesheet" href="{{url('user_assets/css/demo1/style.css')}}">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{$url_aws}}admin/{{$favicon}}" />
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<style>
   body,a,p,h1,h2,h3,h4,h5,h6,button,div{
  font-family: Plus Jakarta Sans !important;
}
.title{
  font-weight:bolder !important;
}

.navbar{
    border-bottom: 1px solid #e9ecef !important;
}

   span.link-title {
    font-weight: bolder !important;
}

.btn-outline-primary{
 border-color: {{$btncolor}} !important;
}
	.btn-custom{
		background-color: {{$btncolor}} !important;
		color:#ffff !important;
	}
.btn-outline-primary:hover{
  background-color: {{$btncolor}} !important;
}
.btn-primary{
  border-color: {{$btncolor}} !important;
 background-color: {{$btncolor}} !important;
}
.border-bottom
{
  border-bottom : 4px solid {{$btncolor}} !important;
}
.nav-item.active .nav-link .link-icon {
  color:{{$btncolor}}  !important;
}
.nav-link:hover{
  color:{{$btncolor}} !important;
}

.planprices:hover{
  background-color: {{$btncolor}} !important;
  color:white !important;

}
</style>
</head>
@php($get_user_details=\App\Models\User::where('id',auth()->user()->id)->first())
@php($get_user_plan_details=\App\Models\SubMembership::with('mem')->where('id',$get_user_details->plan_id)->first())



<body>
  <div class="main-wrapper">

      @include('userweb.layout.sidebar')

  
  
  
    <div class="page-wrapper">
        @include('userweb.layout.nav')




      <div class="page-content mt-2">

           @yield('content')

      </div>

      @include('userweb.layout.footer')
    
    </div>
  </div>


 <!-- Modal -->
            <div class="modal fade" id="changelang" tabindex="-1" aria-labelledby="changelangLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="projecttofolderLabel">Select Language</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  </div>
                 <form action="{{route('set_language')}}" method="post">
                  @csrf
                  <div class="modal-body">
                    
                      <div class="form-group">
                         <label id="folderLabel">Select Input Language</label>
                         
                         <select name="input_lang" class="form-control" required>
                           @php($languages= \App\Models\Language::get())
                                        @foreach($languages as $lang)
                                           <option value="{{$lang->name}}"  @if(auth()->user()->input_lang == $lang->name) selected @endif   style="background-image:url({{url('user_assets/images/noprojects.png')}});">{{$lang->flag}} {{ucfirst($lang->name)}}</option>
                                         @endforeach
                        </select>
                        
                       </div>
                        <br>

                       <div class="form-group">
                         <label id="folderLabel">Select Output Language</label>
                         
                         <select name="output_lang" class="form-control" required>
                           @php($languages= \App\Models\Language::get())
                                @foreach($languages as $lang)
                                   <option value="{{$lang->name}}" @if(auth()->user()->output_lang == $lang->name) selected @endif>{{$lang->flag}} {{ucfirst($lang->name)}}</option>
                                 @endforeach
                        </select>
                        
                       </div>
                      
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Set Languages</button>
                  </div>
                </form>
                
                </div>
              </div>
            </div>
	
	





<!-- ////words top-up plans//// -->
  <!-- Modal -->

   @if($razorpay->active !=1)
      
      <div class="modal modal-md fade" id="upgradetokens" tabindex="-1" aria-labelledby="upgradetokensLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="projecttofolderLabel">Top-Up</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  </div>
                  @php($currency=\App\Models\Setting::where('name','currency_symbol')->first()->value)
                 @php($plans=\App\Models\Plan::get());
       
                  <div class="modal-body">
                    <div class="row">
                    @foreach($plans as $plan)
                       
                      <div class="col-md-4 col-xl-4 col-sm-12 col-xs-12 col-lg-4 grid-margin">
                        

                       <form  action="{{ route('token_top_up') }}" method="post"  enctype="multipart/form-data">
                         @csrf
                         <input type="hidden" class="form-control" name="amount" value="{{$plan->price}}">
                         <input type="hidden" class="form-control" name="plan_id" value="{{$plan->id}}">
                         <input type="hidden" class="form-control" name="plan_tokens" value="{{$plan->tokens}}">
                         <div class="card"  style="font-size: 18px;margin-top: 12px;border:1px solid yellow;background:#ffda973b">
                        <button type="submit" class="p-4" style="background: transparent;border:none">
                          <center>
                           <h4>{{$plan->tokens}} Words</h4>
                           <hr>
                           <h4><b>{{$currency}} {{$plan->price}}</b></h4>
                         </center>
                         </button>
                         </div>
                       </form>
                       </div>
                      
                    @endforeach
                  </div>
                     
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
            
                
                </div>
              </div>
            </div>


            <!--//upgrade plan//-->
  
  <!-- Modal -->
            <div class="modal modal-md fade" id="upgradeplan" tabindex="-1" aria-labelledby="upgradeplanLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="projecttofolderLabel">Upgrade plan</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                  @php($member=\App\Models\SubMembership::with('mem')->where('id','!=',5)->get())
                    <?php $j=1; ?>
                  @foreach($member as $me)
                <li class="nav-item">
                <a class="nav-link @if($j==1) active @endif" id="home-tab{{$me->id}}" data-bs-toggle="tab" href="#tab{{$me->id}}" role="tab" aria-controls="home" aria-selected="true">{{Ucfirst($me->type)}} @if($me->discount > 0) (Save {{$me->discount}}%) @endif</a>
                </li>
                    <?php $j++; ?>
                @endforeach
               
              </ul>
              
                    
                  <div class="modal-body">
                    
                     <div class="container mt-5">
            <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 col-lg-12 col-sm-12 col-xs-12 mr-auto">
          
              <div class="tab-content border border-top-0 p-3" id="myTabContent">
                <?php $i=1; ?>
              @foreach($member as $me)
                 <?php $total_price=$me->mem->price * $me->months;
                    $discount=($total_price * $me->discount)/100;
                    $finalamount=$total_price-$discount;
                    $monthly=$finalamount/$me->months;
                  ?>
                       <div class="tab-pane fade @if($i==1) active show @endif" id="tab{{$me->id}}" role="tabpanel" aria-labelledby="home-tab{{$me->id}}" style="padding: 15px;">
                    <form class="forms-sample" action="{{ route('make-payment') }}" method="post"  enctype="multipart/form-data">
                    @csrf
              
                      <h4 class="text-center mt-3 mb-4">{{$me->type}} Plan</h4>
                      <i data-feather="award" class="text-primary icon-xxl d-block mx-auto my-3"></i>
                      <h1 class="text-center">{!! $currency_symbol !!} {{$monthly}} </h1>
                      <p class="text-muted text-center mb-4 fw-light">per month</p>
                      <h5 class="text-primary text-center mb-4">Total {!! $currency_symbol !!} {{$finalamount}} for {{$me->months}} months</h5>
                      <table class="mx-auto">
                        <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <?php
                      $precision=1;
                      $n=$me->mem->tokens * $me->months;
                       if ($n < 900) {
                        // 0 - 900
                        $n_format = number_format($n, $precision);
                        $suffix = '';
                    } else if ($n < 900000) {
                        // 0.9k-850k
                        $n_format = number_format($n / 1000, $precision);
                        $suffix = 'K';
                    } else if ($n < 900000000) {
                        // 0.9m-850m
                        $n_format = number_format($n / 1000000, $precision);
                        $suffix = 'M';
                    } else if ($n < 900000000000) {
                        // 0.9b-850b
                        $n_format = number_format($n / 1000000000, $precision);
                        $suffix = 'B';
                    } else {
                        // 0.9t+
                        $n_format = number_format($n / 1000000000000, $precision);
                        $suffix = 'T';
                    }
                  
                    if ( $precision > 0 ) {
                        $dotzero = '.' . str_repeat( '0', $precision );
                        $n_format = str_replace( $dotzero, '', $n_format );
                    }
                  $numberr=$n_format . $suffix;
                  ?>
                          <td><p>{{ $numberr }} words</p></td>
                        </tr>
                        <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <td><p>{{$me->mem->speech_minutes * $me->months}} mins for Speech to Text</p></td>
                        </tr>
                         <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <td><p>Add/Manage {{$me->mem->team_limit}} Team Members</p></td>
                        </tr>
                        <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <td><p>unlimited folder</p></td>
                        </tr>
                        <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <td><p>unlimited project</p></td>
                        </tr>
                        
                         <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <td><p>Article Generator</p></td>
                        </tr>
                         <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <td><p>Image Generator and Editor</p></td>
                        </tr>
                      </table>
                      <input type="hidden" class="form-control" name="amount" value="{{$finalamount}}">
                      <input type="hidden" class="form-control" name="mem_id" value="{{$me->id}}">
                      <input type="hidden" class="form-control" name="plan_type" value="{{$me->type}}">
                      <div class="d-grid">
                        <button class="btn btn-primary mt-4"  type="submit" style="color:white !important">Upgrade Plan</a>
                      </div>

                   
                </form>
                    </div>


                <?php $i++; ?>

                   <!--payment gateway-->

    


              @endforeach
               
              </div>
              
            </div>
            
             
             </div></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
               
                
                </div>
              </div>
            </div>


   @else



   <!--//upgrade plan//-->
  
  <!-- Modal -->
            <div class="modal modal-md fade" id="upgradeplan" tabindex="-1" aria-labelledby="upgradeplanLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="projecttofolderLabel">Upgrade plan</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                  @php($member=\App\Models\SubMembership::with('mem')->where('id','!=',5)->get())
                    <?php $j=1; ?>
                  @foreach($member as $me)
                <li class="nav-item">
                <a class="nav-link @if($j==1) active @endif" id="home-tab{{$me->id}}" data-bs-toggle="tab" href="#tab{{$me->id}}" role="tab" aria-controls="home" aria-selected="true">{{Ucfirst($me->type)}} @if($me->discount > 0) (Save {{$me->discount}}%) @endif</a>
                </li>
                    <?php $j++; ?>
                @endforeach
               
              </ul>
                 <form action="#" method="post">
                  @csrf
                  <div class="modal-body">
                    
                     <div class="container mt-5">
            <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 col-lg-12 col-sm-12 col-xs-12 mr-auto">
          
              <div class="tab-content border border-top-0 p-3" id="myTabContent">
                <?php $i=1; ?>
              @foreach($member as $me)
                 <?php $total_price=$me->mem->price * $me->months;
                    $discount=($total_price * $me->discount)/100;
                    $finalamount=$total_price-$discount;
                    $monthly=$finalamount/$me->months;
                  ?>
                <div class="tab-pane fade @if($i==1) active show @endif" id="tab{{$me->id}}" role="tabpanel" aria-labelledby="home-tab{{$me->id}}" style="padding: 15px;">
                      <h4 class="text-center mt-3 mb-4">{{$me->type}} Plan</h4>
                      <i data-feather="award" class="text-primary icon-xxl d-block mx-auto my-3"></i>
                      <h1 class="text-center">{!! $currency_symbol !!} {{$monthly}} </h1>
                      <p class="text-muted text-center mb-4 fw-light">per month</p>
                      <h5 class="text-primary text-center mb-4">Total {!! $currency_symbol !!} {{$finalamount}} for {{$me->months}} months</h5>
                      <table class="mx-auto">
                        <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <?php
                      $precision=1;
                      $n=$me->mem->tokens * $me->months;
                       if ($n < 900) {
                        // 0 - 900
                        $n_format = number_format($n, $precision);
                        $suffix = '';
                    } else if ($n < 900000) {
                        // 0.9k-850k
                        $n_format = number_format($n / 1000, $precision);
                        $suffix = 'K';
                    } else if ($n < 900000000) {
                        // 0.9m-850m
                        $n_format = number_format($n / 1000000, $precision);
                        $suffix = 'M';
                    } else if ($n < 900000000000) {
                        // 0.9b-850b
                        $n_format = number_format($n / 1000000000, $precision);
                        $suffix = 'B';
                    } else {
                        // 0.9t+
                        $n_format = number_format($n / 1000000000000, $precision);
                        $suffix = 'T';
                    }
                  
                    if ( $precision > 0 ) {
                        $dotzero = '.' . str_repeat( '0', $precision );
                        $n_format = str_replace( $dotzero, '', $n_format );
                    }
                  $numberr=$n_format . $suffix;
                  ?>
                          <td><p>{{ $numberr }} words</p></td>
                        </tr>
                        <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <td><p>{{$me->mem->speech_minutes * $me->months}} mins for Speech to Text</p></td>
                        </tr>
                         <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <td><p>Manage Team Members</p></td>
                        </tr>
                        <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <td><p>unlimited folder</p></td>
                        </tr>
                        <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <td><p>unlimited project</p></td>
                        </tr>
                        
                         <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <td><p>Article Generator</p></td>
                        </tr>
                         <tr>
                          <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                          <td><p>Image Generator and Editor</p></td>
                        </tr>
                      </table>
                      <div class="d-grid">
                        <a class="btn btn-primary mt-4"  data-bs-toggle="modal" data-bs-target="#payment{{$me->id}}" style="color:white !important">Upgrade Plan</a>
                      </div>

                    </div>
               


                <?php $i++; ?>

                   <!--payment gateway-->

    


              @endforeach
               
              </div>
              
            </div>
            
             
             </div></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </form>
                
                </div>
              </div>
            </div>
            <div class="modal modal-md fade" id="upgradetokens" tabindex="-1" aria-labelledby="upgradetokensLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="projecttofolderLabel">Top-Up</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  </div>
                  @php($currency=\App\Models\Setting::where('name','currency_symbol')->first()->value)
                 @php($plans=\App\Models\Plan::get());
       
                  <div class="modal-body">
                    <div class="row">
                    @foreach($plans as $plan)
                     
                      <div class="col-md-4 col-xl-4 col-sm-12 col-xs-12 col-lg-4 grid-margin">
                        <div class="card p-4"  style="font-size: 18px;margin-top: 12px;border:1px solid yellow;background:#ffda973b">
                        <a data-bs-toggle="modal" data-bs-target="#plan{{$plan->id}}">
                          <center>
                           <h4>{{$plan->tokens}} Words</h4>
                           <hr>
                           <h4><b>{{$currency}} {{$plan->price}}</b></h4>
                         </center>
                         </a>
                         </div>
                       </div>
                      
                    @endforeach
                  </div>
                     
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
            
                
                </div>
              </div>
            </div>

  @foreach($plans as $plan)
         <div class="modal modal-md fade" id="plan{{$plan->id}}" tabindex="-1" aria-labelledby="plan{{$plan->id}}Label" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="plan{{$plan->id}}Label">Top up of {{$plan->tokens}} words</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  </div>
              
                 <form  action="{{ route('token_top_up') }}" method="post"  enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="row d-flex">
                     <input type="hidden" class="form-control" name="amount" value="{{$plan->price}}">
                      <input type="hidden" class="form-control" name="plan_id" value="{{$plan->id}}">
                      <input type="hidden" class="form-control" name="plan_tokens" value="{{$plan->tokens}}">
                  </div>

                  <h4>Pay Via </h4>
                       <hr>
                       <center>
                       <div class="d-flex w-100" align="center">
                        @if($razorpay->active ==1)
                      <a href="javascript:void(0)" class="btn float-right tokens_now" data-amount="{{$plan->price}}" data-id="{{$plan->id}}" data-tokens="{{$plan->tokens}}"><img src="{{url('user_assets/images/razorpay.png')}}" alt="razorpay" style="max-width: 100px; float: right;margin-top: 12px;float:right;"></a> 
                        @endif

                       @if($stripe->active ==1)
                        <button class="btn" type="submit"><img src="{{url('user_assets/images/stripe.png')}}" alt="stripe"  style="max-width: 100px; float: right;margin-top: 12px;"> </button>
                        @endif
                      </div>
                     
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </form>
                
                </div>
              </div>
            </div>
 @endforeach


 @foreach($member as $me)
            <!-- Modal -->
            <div class="modal fade" id="payment{{$me->id}}" tabindex="-1" aria-labelledby="paymentLabel{{$me->id}}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="paymentLabel{{$me->id}}">Select Payment method</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  </div>
                 
                  @csrf
                  <div class="modal-body">
                   <?php $total_price=$me->mem->price * $me->months;
                    $discount=($total_price * $me->discount)/100;
                    $finalamount=$total_price-$discount;
                    $monthly=$finalamount/$me->months;
                     ?>
                    
                       

                  <div class="card  reset-style">
                    <div class="card-header">
                      <div class="card-title">
                         <h5> Membership Details </h5>
                      </div>
                    </div>
                    <div class="card-body">
                  <form class="forms-sample" action="{{ route('make-payment') }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Plan Name</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="exampleInputEmail2" autocomplete="off" placeholder="Email" value="{{$me->type}} ({{$me->discount}}%)" readOnly disabled>
                    </div>
                  </div>
                  
                  <div class="row mb-3">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Words</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="name" id="exampleInputUsername2" placeholder="Name" value="{{$me->mem->tokens * $me->months}} words"  readOnly disabled>
                    </div>
                  </div>
                  
                
                  <div class="row mb-3">
                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Folders</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="exampleInputPassword2" autocomplete="off" value="Unlimited"  readOnly disabled>
                    </div>
                  </div>
                   
                    <div class="row mb-3">
                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Projects</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="exampleInputPassword2" autocomplete="off" value="Unlimited" readOnly disabled>
                      <input type="hidden" class="form-control" name="amount" value="{{$finalamount}}">
                      <input type="hidden" class="form-control" name="mem_id" value="{{$me->id}}">
                      <input type="hidden" class="form-control" name="plan_type" value="{{$me->type}}">
                    </div>
                  </div>


                       <h4>Pay Via </h4>
                       <hr>
                       <center>
                       <div class="d-flex w-100" align="center">
                        @if($razorpay->active ==1)
                      <a href="javascript:void(0)" class="btn float-right order_now" data-amount="{{$finalamount}}" data-id="{{$me->id}}" data-tokens="{{$me->mem->tokens * $me->months}}"><img src="{{url('user_assets/images/razorpay.png')}}" alt="razorpay" style="max-width: 100px; float: right;margin-top: 12px;float:right;"></a> 
                        @endif

                       @if($stripe->active ==1)
                        <button class="btn" type="submit"><img src="{{url('user_assets/images/stripe.png')}}" alt="stripe"  style="max-width: 100px; float: right;margin-top: 12px;"> </button>
                        @endif
                      </div>
                    </center>
                     </form>
                   </div>
                 </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  
                  </div>
               
                
                </div>
              </div>
            </div>
    <!--stripe  -->


    @endforeach
 @endif



    @php($razorpay=\App\Models\PaymentGateway::where('id',1)->first())
  <!-- core:js -->
  <script src="{{url('user_assets/vendors/core/core.js')}}"></script>
  <!-- endinject -->

  <!-- Plugin js for this page -->
  <script src="{{url('user_assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
  <script src="{{url('user_assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
  <!-- End plugin js for this page -->

  <!-- inject:js -->
  <script src="{{url('user_assets/vendors/feather-icons/feather.min.js')}}"></script>
  <script src="{{url('user_assets/js/template.js')}}"></script>


  <!-- Custom js for this page -->
  <script src="{{url('user_assets/js/dashboard-light.js')}}"></script>
  <!-- End custom js for this page -->

  <!-- ///razorpay///-->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
var SITEURL = '{{URL::to('/')}}';
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
}); 
$('body').on('click', '.order_now', function(e){
var totalAmount = $(this).attr("data-amount");
var plan_id =  $(this).attr("data-id");
var tokens =  $(this).attr("data-tokens");
var options = {
"key": "{{$razorpay->api_key}}",
"amount": totalAmount*100,
"name": "{{$appname}}",
"description": "Payment",
"image": "{{$url_aws}}admin/{{$favicon}}",
"handler": function (response){
window.location.href = SITEURL +'/'+ 'paysuccess?payment_id='+response.razorpay_payment_id+'&plan_id='+plan_id+'&amount='+totalAmount;
},
"prefill": {
"email":   "{{auth()->user()->email}}",
},
"theme": {
"color": "#528FF0",
},
};
var rzp1 = new Razorpay(options);
rzp1.open();
e.preventDefault();
});

</script>


<script>
var SITEURL = '{{URL::to('/')}}';
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
}); 
$('body').on('click', '.tokens_now', function(e){
var totalAmount = $(this).attr("data-amount");
var plan_id =  $(this).attr("data-id");
var tokens =  $(this).attr("data-tokens");
var options = {
"key": "{{$razorpay->api_key}}",
"amount": totalAmount*100,
"name": "{{$appname}}",
"description": "Payment",
"image": "{{$url_aws}}admin/{{$favicon}}",
"handler": function (response){
window.location.href = SITEURL +'/'+ 'paysuccess_tokens?payment_id='+response.razorpay_payment_id+'&plan_id='+plan_id+'&amount='+totalAmount;
},
"prefill": {
"email":   "{{auth()->user()->email}}",
},
"theme": {
"color": "#528FF0",
},
};
var rzp1 = new Razorpay(options);
rzp1.open();
e.preventDefault();
});

</script>

<!-- razorpay end -->

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function () {
        var $form = $(".stripe-payment");
        $('form.stripe-payment').bind('submit', function (e) {
            var $form = $(".stripe-payment"),
                inputVal = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputVal),
                $errorStatus = $form.find('div.error'),
                valid = true;
            $errorStatus.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorStatus.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-num').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeRes);
            }

        });

        function stripeRes(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });

</script>
<!-- Award Modal -->
<?php 

$loginuser = \App\Models\User::where('id',auth()->user()->id)->first();
$re_token = $loginuser->token_reached;
$awards = \App\Models\Award::where('tokens','<',$re_token)->orderBy('id', 'DESC')->first();
$userawards = \App\Models\UserAward::where('user_id',$loginuser->id)->get();
$allaward_id = Null;
foreach($userawards as $key => $useraward){
 $allaward_id[] = $useraward->award_id;
}
if($allaward_id != NULL){

  $allaward = implode(',',$allaward_id);
}else{
  $allaward = "0";
}
?>
@if($awards)
<div class="modal fade" id="awards" tabindex="-1" aria-labelledby="folderLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
           
        </div>
        <form action="{{route('user.award')}}" method="post" enctype="multipart/form-data">
          @csrf
        <div class="modal-body">
            <div class="form-group">
                <center>
                  <img src="{{ $url_aws.'awards/'.$awards->icon}}" height="50px" alt="image">
                  </center>
            </div>  
            <input type="hidden" value="{{ $allaward }}" id="useraward">
            <input type="hidden" name="user_id" class="form-control" value="{{ $loginuser->id }}">
            <input type="hidden" id="award_id" name="award_id" class="form-control" value="{{ $awards->id }}">
        </div>
        <div class="modal-footer">        
          <button type="submit" id="submit" class=" btn btn-primary" style="margin-right: 165px">{{ __('lang.awesome')}}</button>

        </div>
        </form>
      </div>
    </div>
  </div> 
<script type="text/javascript">
    $(document).ready(function() {
     var usr_awd= $("#useraward").val();
     var awd= $("#award_id").val();
     if($.inArray(awd,usr_awd)== -1){
      $("#awards").modal('show');
     }else{ 
      $("#awards").modal('hide');
     }
        
    });
</script>
@endif



</body>
</html>    