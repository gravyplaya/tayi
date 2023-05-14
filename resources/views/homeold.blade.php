<?php

    $footer_logo=\App\Models\Setting::where('name','footer_logo')->first()->value;
    $appname=\App\Models\Setting::where('name','app_name')->first()->value;
    $favicon=\App\Models\Setting::where('name','favicon')->first()->value;
    $footer_logo=\App\Models\Setting::where('name','footer_logo')->first()->value;
    $routee=$title ??"";
    $currency_symbol=\App\Models\Setting::where('name','currency_symbol')->first()->value;
    $facebook=\App\Models\Setting::where('name','facebook')->first()->value;
    $twitter=\App\Models\Setting::where('name','twitter')->first()->value;
    $google=\App\Models\Setting::where('name','google')->first()->value;
    $logo=\App\Models\Setting::where('name','logo')->first()->value;
 
    $storage= \DB::table('image_spaces')->first();

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Codefuse">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{$url_aws}}admin/{{$favicon}}">
    <title>{{$appname}}</title>
    <link rel="stylesheet" href="{{url('user_assets/assets/css/style-s2.css?v1.1.0')}}">
</head>
 <?php
if (isset($_GET['tool'])) {
    $slug=$_GET['tool'];
}else{
  $slug="ai-article-writer";
}?>
<body class="nk-body" data-menu-collapse="lg">
    <div class="nk-app-root  bg-darker">
        <header class="nk-header bg-darker is-dark has-mask">
            <div class="nk-mask bg-pattern-dot-white-sm bg-blend-bottom"></div>
            <div class="nk-header-main nk-menu-main is-transparent will-shrink on-dark ignore-mask">
                <div class="container">
                    <div class="nk-header-wrap">
                        <div class="nk-header-logo">
                            <a href="{{ url('/') }}" class="logo-link">
                                <div class="logo-wrap">
                                    <img class="logo-img logo-light" src="{{$url_aws}}admin/{{$logo}}" srcset="{{$url_aws}}admin/{{$logo}}" alt="logo" style="max-width:140px;max-height:40px;">
                                    <img class="logo-img logo-dark" src="{{$url_aws}}admin/{{$footer_logo}}" srcset="{{$url_aws}}admin/{{$footer_logo}}" alt="dark-logo" style="max-width:140px;max-height:50px;">
                                </div>
                            </a>
                        </div><!-- .nk-header-logo -->
                        <div class="nk-header-toggle">
                            <button class="btn btn-light btn-icon header-menu-toggle">
                                <em class="icon ni ni-menu"></em>
                            </button>
                        </div>
                        <nav class="nk-header-menu nk-menu">
                            <ul class="nk-menu-list me-auto">
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link">
                                        <span class="nk-menu-text">Home</span>
                                    </a>                                   
                                </li>
                                <li class="nk-menu-item">
                                    <a href="#howto" class="nk-menu-link">
                                        <span class="nk-menu-text">How To</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="#usecase" class="nk-menu-link">
                                        <span class="nk-menu-text">Use Cases</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="#pricing" class="nk-menu-link">
                                        <span class="nk-menu-text">Pricing</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="#faq" class="nk-menu-link">
                                        <span class="nk-menu-text">FAQ</span>
                                    </a>
                                </li>
                                
                            </ul><!-- .nk-menu-list -->
                            <ul class="nk-menu-buttons flex-lg-row-reverse">
								@if (auth()->user() != null)
								   <li><a href="{{ route('user_dashboard')}}" class="btn btn-outline-primary rounded-pill">Dashboard</a></li>

								@else
								 <li><a href="{{ route('register')}}" class="btn btn-outline-primary rounded-pill">Get Started</a></li>
								 <li><a class="link link-light" href="{{ route('login')}}">Sign in </a></li>
							   @endif
                            </ul><!-- .nk-menu-buttons -->
                        </nav><!-- .nk-header-menu -->
                    </div>
                </div>
            </div>
            <!-- .header -->
            <div class="nk-hero py-xl-5 overflow-hidden has-shape">
                <div class="nk-shape bg-shape-blur-b mt-n5 start-50 top-50 translate-middle"></div>
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-11 col-xl-10 col-xxl-9">
                            <div class="nk-hero-content py-5 py-lg-6">
								@if($slug=="ai-article-writer")
                                <h1 class="title mb-3 mb-lg-4 display-6">AI Writer for Creating <div class="text-gradient-primary"><span class="type-init" data-strings='"Social Posts", "Blogs & Articles", "Emails & more"'></span></div>
                                </h1>
								@elseif($slug=="ai-image-generator")
								 <h1 class="title mb-3 mb-lg-4 display-6">AI Image for Generating <div class="text-gradient-primary"><span class="type-init" data-strings='"Image Faster"'></span></div>
                                </h1>
								@elseif($slug=="social-post-writer")
								 <h1 class="title mb-3 mb-lg-4 display-6">AI Writer for Creating <div class="text-gradient-primary"><span class="type-init" data-strings='"Social Post"'></span></div>
                                </h1>
								 @elseif($slug=="blog-writer")
								 <h1 class="title mb-3 mb-lg-4 display-6">AI Writer for Creating <div class="text-gradient-primary"><span class="type-init" data-strings='"Blogs"'></span></div>
                                </h1>
								 @elseif($slug=="keywords-generator")
								 <h1 class="title mb-3 mb-lg-4 display-6">AI Generator for Generating <div class="text-gradient-primary"><span class="type-init" data-strings='"Keywords"'></span></div>
                                </h1>
								 @else
								 <h1 class="title mb-3 mb-lg-4 display-6">AI for Answering <div class="text-gradient-primary"><span class="type-init" data-strings='"GK Questions", "Math Questions", "History Questions and more"'></span></div>
                                </h1>
								 @endif
                                <p class="lead px-md-8 px-lg-6 px-xxl-12 mb-4 mb-lg-5">Tayi AI is revolutionizing the way content is created. It can create content for blogs, articles, websites, social media and more.</p>
                                <ul class="btn-list btn-list-inline">
                                    <li><a href="{{route('login')}}" class="btn btn-primary btn-lg rounded-pill"><span>Start writing for free</span></a></li>
                                </ul>
                                <p class="sub-text mt-2">No credit card required</p>
                            </div>
                            <div class="nk-hero-gfx position-relative">
                                <img class="w-100 rounded-4" src="{{ asset('assets/images/gfx/banner/c.jpg') }}" alt=""><!-- large banner image -->
                                <div class="d-none d-md-block position-absolute top-0 end-100 me-5 me-lg-8 me-xl-12 mt-n3">
                                    <div class="media media-2xl rounded-pill mx-auto">
                                        <img src="{{ asset('assets/images/avatar/illustration/a.jpg') }}" alt="">
                                    </div>
                                    <div class="badge bg-dark p-2 mt-2 fw-normal text-white text-opacity-75">Freelancer</div>
                                </div><!-- floating user -->
                                <div class="d-none d-md-block position-absolute top-50 end-100 me-3 me-lg-4 mt-n5">
                                    <div class="media media-2xl rounded-pill mx-auto">
                                        <img src="{{ asset('assets/images/avatar/illustration/b.jpg') }}" alt="">
                                    </div>
                                    <div class="badge bg-dark p-2 mt-2 fw-normal text-white text-opacity-75">Marketer</div>
                                </div><!-- floating user -->
                                <div class="d-none d-md-block position-absolute top-0 start-100 ms-5 ms-lg-7 ms-xl-10 mt-n7">
                                    <div class="media media-2xl rounded-pill mx-auto">
                                        <img src="{{ asset('assets/images/avatar/illustration/c.jpg') }}" alt="">
                                    </div>
                                    <div class="badge bg-dark p-2 mt-2 fw-normal text-white text-opacity-75">Copywriter</div>
                                </div><!-- floating user -->
                                <div class="d-none d-md-block position-absolute top-50 start-100 ms-4 ms-lg-5 mt-n2">
                                    <div class="media media-2xl rounded-pill mx-auto">
                                        <img src="{{ asset('assets/images/avatar/illustration/d.jpg') }}" alt="">
                                    </div>
                                    <div class="badge bg-dark p-2 mt-2 fw-normal text-white text-opacity-75">Blogger</div>
                                </div><!-- floating user -->
                            </div>
                            <div class="nk-hero-content py-6">
                                <h6 class="lead-text">Trusted by 60,000+ freelancers, marketing teams and agencies.</h6>
                                <ul class="d-flex flex-wrap justify-content-center pt-4 has-gap gy-3">
                                    <li class="px-3 px-sm-5">
                                        <img class="h-2rem" src="{{ asset('assets/images/brands/72-b-white.png') }}" alt="">
                                    </li>
                                    <li class="px-3 px-sm-5">
                                        <img class="h-2rem" src="{{ asset('assets/images/brands/72-c-white.png') }}" alt="">
                                    </li>
                                    <li class="px-3 px-sm-5">
                                        <img class="h-2rem" src="{{ asset('assets/images/brands/72-d-white.png') }}" alt="">
                                    </li>
                                    <li class="px-3 px-sm-5">
                                        <img class="h-2rem" src="{{ asset('assets/images/brands/72-e-white.png') }}" alt="">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main class="nk-pages">
            <section class="section bg-darker is-dark section-top-0 has-shape">
                <div class="nk-shape bg-shape-blur-a start-50 top-50 translate-middle"></div>
                <div class="container">
                    <div class="section-head">
                        <div class="row justify-content-center text-center">
                            <div class="col-lg-9 col-xl-6 col-xxl-5">
                                <h2 class="title">Superpower with AI Writer</h2>
                                <p class="lead">Let our AI assist with most time consuming to write blog articles, product descriptions and more.</p>
                            </div>
                        </div>
                    </div><!-- .section-head -->
                    <div class="section-content">
                        <div class="row g-gs">
                            <div class="col-md-6 col-xl-4">
                                <div class="card rounded-4 border-0 h-100">
                                    <div class="card-body">
                                        <div class="feature">
                                            <div class="feature-media">
                                                <div class="media media-middle media-xl text-info bg-info bg-opacity-20 rounded-3">
                                                    <em class="icon ni ni-bulb"></em>
                                                </div>
                                            </div>
                                            <div class="feature-text">
                                                <h4 class="title">Brainstorm faster</h4>
                                                <p>Use our advanced AI as your personal content writer or partner for your endless work for your business. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card rounded-4 border-0 h-100">
                                    <div class="card-body">
                                        <div class="feature">
                                            <div class="feature-media">
                                                <div class="media media-middle media-xl text-primary bg-primary bg-opacity-20 rounded-3">
                                                    <em class="icon ni ni-cpu"></em>
                                                </div>
                                            </div>
                                            <div class="feature-text">
                                                <h4 class="title">Tools and templates</h4>
                                                <p>Using our AI tools and pre-built template to create content briefs, write and optimize content in one place.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card rounded-4 border-0 h-100">
                                    <div class="card-body">
                                        <div class="feature">
                                            <div class="feature-media">
                                                <div class="media media-middle media-xl text-indigo bg-indigo bg-opacity-20 rounded-3">
                                                    <em class="icon ni ni-spark"></em>
                                                </div>
                                            </div>
                                            <div class="feature-text">
                                                <h4 class="title">Write content faster</h4>
                                                <p>You do not need to spend hours to write good content — let our advance AI Writer to get it done.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card rounded-4 border-0 h-100">
                                    <div class="card-body">
                                        <div class="feature">
                                            <div class="feature-media">
                                                <div class="media media-middle media-xl text-success bg-success bg-opacity-20 rounded-3">
                                                    <em class="icon ni ni-swap-alt"></em>
                                                </div>
                                            </div>
                                            <div class="feature-text">
                                                <h4 class="title">Repurpose content easily</h4>
                                                <p>Write and saved once, use everywhere. Also rewrite content for different porpose with minimal effort.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card rounded-4 border-0 h-100">
                                    <div class="card-body">
                                        <div class="feature">
                                            <div class="feature-media">
                                                <div class="media media-middle media-xl text-danger bg-danger bg-opacity-20 rounded-3">
                                                    <div class=" d-flex align-items-end">
                                                        <em class="icon ni ni-text"></em>
                                                        <em class="icon half ms-n2 ni ni-text"></em>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="feature-text">
                                                <h4 class="title">Write in Any Language</h4>
                                                <p>Let AI write for you in over 40 languages. Our AI can write in English, Spanish, French and many more language.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card rounded-4 border-0 h-100">
                                    <div class="card-body">
                                        <div class="feature">
                                            <div class="feature-media">
                                                <div class="media media-middle media-xl text-warning bg-warning bg-opacity-20 rounded-3">
                                                    <em class="icon ni ni-file-docs"></em>
                                                </div>
                                            </div>
                                            <div class="feature-text">
                                                <h4 class="title">Copy and publish anywhere</h4>
                                                <p>You can simply copy your desire content and then you can publish, like Shopify, WordPress, or anywhere.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .section-content -->
                </div>
            </section><!-- .section -->
            <section class="section section-bottom-0 bg-white rounded-top-6" id="howto">
                <div class="container">
                    <div class="section-head">
                        <div class="row justify-content-center text-center">
                            <div class="col-lg-9 col-xl-8 col-xxl-5">
                                <div class="badge text-bg-primary-soft-outline text-uppercase text-tracking-1 rounded-pill px-3 py-2 mb-3">How To</div>
                                <h2 class="title">Few steps to write content </h2>
                                <p class="lead">Let our AI assist with most time consuming to write blog articles, product descriptions and more.</p>
                            </div>
                        </div>
                    </div><!-- .section-head -->
                    <div class="section-content">
                        <div class="row gy-3 justify-content-center">
                            <div class="col-xxl-12">
                                <div class="bg-primary bg-opacity-10 p-5 p-lg-6 rounded-4">
                                    <div class="row g-gs flex-lg-row-reverse justify-content-between align-items-center">
                                        <div class="col-lg-6 col-xl-5">
                                            <div class="rounded-4 bg-gradient-primary bg-opacity-50 p-5 pb-0">
                                                <div class="block-gfx">
                                                    <img class="w-100 rounded-top-3 shadow-sm" src="{{ asset('assets/images/gfx/process/a.jpg') }}" alt="">
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-lg-6 col-xxl-5">
                                            <div class="block-text pe-xl-5">
                                                <img class="h-3rem mb-3" src="{{ asset('assets/images/icon/text.svg') }}" alt="">
                                                <h3 class="title">Select writing template</h3>
                                                <p>Simply choose a template from available list to write content for blog posts, landing page, website content etc.</p>
                                                <ul class="list gy-3">
                                                    <li><em class="icon text-info fs-5 ni ni-check-circle-fill"></em><span>Available more than 10 template.</span></li>
                                                    <li><em class="icon text-info fs-5 ni ni-check-circle-fill"></em><span>A clean and minimalist editor.</span></li>
                                                    <li><em class="icon text-info fs-5 ni ni-check-circle-fill"></em><span>Article generator wizard.</span></li>
                                                </ul>
                                            </div>
                                        </div><!-- .col -->
                                    </div><!-- .row -->
                                </div><!-- box -->
                            </div><!-- .col -->
                            <div class="col-xxl-12">
                                <div class="bg-warning bg-opacity-10 p-5 p-lg-6 rounded-4">
                                    <div class="row g-gs flex-lg-row-reverse justify-content-between align-items-center">
                                        <div class="col-lg-6 col-xl-5">
                                            <div class="rounded-4  bg-gradient-warning bg-opacity-50 p-5 pb-0">
                                                <div class="block-gfx">
                                                    <img class="w-100 rounded-top-3 shadow-sm" src="{{ asset('assets/images/gfx/process/b.jpg') }}" alt="">
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-lg-6 col-xxl-5">
                                            <div class="block-text pe-xl-5">
                                                <img class="h-3rem mb-3" src="{{ asset('assets/images/icon/edit.svg') }}" alt="">
                                                <h3 class="title">Describe your topic</h3>
                                                <p>Provide our AI content writer with few sentences on what you want to write, and it will start writing for you.</p>
                                                <ul class="list gy-3">
                                                    <li><em class="icon text-info fs-5 ni ni-check-circle-fill"></em><span>Simply provide a few input as topic</span></li>
                                                    <li><em class="icon text-info fs-5 ni ni-check-circle-fill"></em><span>Type a topic like "best ways to earn money"</span></li>
                                                    <li><em class="icon text-info fs-5 ni ni-check-circle-fill"></em><span>Facebook Ads, Headlines and other 10+ tools</span></li>
                                                </ul>
                                            </div>
                                        </div><!-- .col -->
                                    </div><!-- .row -->
                                </div><!-- box -->
                            </div><!-- .col -->
                            <div class="col-xxl-12">
                                <div class="bg-info bg-opacity-10 p-5 p-lg-6 rounded-4">
                                    <div class="row g-gs flex-lg-row-reverse justify-content-between align-items-center">
                                        <div class="col-lg-6 col-xl-5">
                                            <div class="rounded-4  bg-gradient-info bg-opacity-50 p-5 pb-0">
                                                <div class="block-gfx">
                                                    <img class="w-100 rounded-top-3 shadow-sm" src="{{ asset('assets/images/gfx/process/c.jpg') }}" alt="i">
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-lg-6 col-xxl-5">
                                            <div class="block-text pe-xl-5">
                                                <img class="h-3rem mb-3" src="{{ asset('assets/images/icon/paper.svg') }}" alt="n">
                                                <h3 class="title">Generate quality content</h3>
                                                <p>Our powerful AI tools will generate content in few second, then you can export it to wherever you need.</p>
                                                <ul class="list gy-3">
                                                    <li><em class="icon text-info fs-5 ni ni-check-circle-fill"></em><span>Generate content in under 30 seconds.</span></li>
                                                    <li><em class="icon text-info fs-5 ni ni-check-circle-fill"></em><span>All content is unique and original.</span></li>
                                                    <li><em class="icon text-info fs-5 ni ni-check-circle-fill"></em><span>Generate up to 200 words each time.</span></li>
                                                </ul>
                                            </div>
                                        </div><!-- .col -->
                                    </div><!-- .row -->
                                </div><!-- box -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .section-content -->
                </div>
            </section>
            <section class="section bg-white has-mask" id="usecase">
                <div class="nk-mask bg-pattern-dot-sm bg-blend-around"></div>
                <div class="container">
                    <div class="section-head">
                        <div class="row justify-content-center text-center">
                            <div class="col-lg-9 col-xl-8 col-xxl-7">
                                <div class="badge text-bg-primary-soft-outline text-uppercase text-tracking-1 rounded-pill px-3 py-2 mb-3">Use Cases</div>
                                <h2 class="title h1">Generate in seconds using AI</h2>
                                <p class="lead px-xl-6">Let our AI assist with most time consuming to write blog articles, product descriptions and more.</p>
                            </div>
                        </div>
                    </div><!-- .section-head -->
                    <div class="section-content">
                        <div class="row justify-content-center">
                            <div class="col-xxl-11">
                                <div class="row gy-6 gx-5 text-center">
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="h-100 px-xl-4 px-xxl-5">
                                            <div class="feature">
                                                <div class="feature-media">
                                                    <div class="media media-middle media-xl media-border text-bg-danger-soft-outline rounded-3">
                                                        <img class="h-2rem" src="{{ asset('assets/images/icon/articles.svg')}}" alt="img not">
                                                    </div>
                                                </div>
                                                <div class="feature-text">
                                                    <h3 class="title">Blog Post &amp; Articles</h3>
                                                    <p>Generate optimized blog post and articles to get organic traffic - making you visible on the world. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="h-100 px-xl-4 px-xxl-5">
                                            <div class="feature">
                                                <div class="feature-media">
                                                    <div class="media media-middle media-xl media-border text-bg-success-soft-outline rounded-3">
                                                        <img class="h-2rem" src="{{ asset('assets/images/icon/product-discription.svg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="feature-text">
                                                    <h3 class="title">Product Description</h3>
                                                    <p>Create a perfect description for your products to engage your customers to click and buy. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="h-100 px-xl-4 px-xxl-5">
                                            <div class="feature">
                                                <div class="feature-media">
                                                    <div class="media media-middle media-xl media-border text-bg-purple-soft-outline rounded-3">
                                                        <img class="h-2rem" src="{{ asset('assets/images/icon/hand-mic.svg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="feature-text">
                                                    <h3 class="title">Social Media Ads</h3>
                                                    <p>Create ads copies for your social media - make an impact with your online marketing campaigns.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="h-100 px-xl-4 px-xxl-5">
                                            <div class="feature">
                                                <div class="feature-media">
                                                    <div class="media media-middle media-xl media-border text-bg-info-soft-outline rounded-3">
                                                        <img class="h-2rem" src="{{ asset('assets/images/icon/praying-hand.svg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="feature-text">
                                                    <h3 class="title">Product Benefits</h3>
                                                    <p>Create a bullet point list of your product benefits that appeal to your customers to purchase.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="h-100 px-xl-4 px-xxl-5">
                                            <div class="feature">
                                                <div class="feature-media">
                                                    <div class="media media-middle media-xl media-border text-bg-primary-soft-outline rounded-3">
                                                        <img class="h-2rem" src="{{ asset('assets/images/icon/stock-up.svg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="feature-text">
                                                    <h3 class="title">Suggest Improvements</h3>
                                                    <p>Need to improve your existing content? Our AI will rewrite and improve the content for you.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="h-100 px-xl-4 px-xxl-5">
                                            <div class="feature">
                                                <div class="feature-media">
                                                    <div class="media media-middle media-xl media-border text-bg-indigo-soft-outline rounded-3">
                                                        <img class="h-2rem" src="{{ asset('assets/images/icon/website.svg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="feature-text">
                                                    <h3 class="title">Landing Page Content</h3>
                                                    <p>Write very attractive headlines, slogans or paragraph for your landing page of your website.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div>
                        </div>
                    </div><!-- .section-content -->
                </div>
            </section>
            <section class="section section-bottom-0 bg-light" id="pricing">
                <div class="container">
                    <div class="section-head">
                        <div class="row justify-content-center text-center">
                            <div class="col-lg-9 col-xl-8 col-xxl-6">
                                <div class="badge text-bg-primary-soft-outline text-uppercase text-tracking-1 rounded-pill px-3 py-2 mb-3">Pricing</div>
                                <h2 class="title h1">Plans that start free and fits with your needs</h2>
                                <p class="lead">With our simple plans, supercharge your content writing to helps your business. Let’s make great content together.</p>
                            </div>
                        </div>
                    </div><!-- .section-head -->
					@php($member_year=\App\Models\SubMembership::with('mem')->where('type','Yearly')->first())
                    <div class="section-content">
                        <div class="pricing-toggle-wrap mb-4">
                            <div class="h5 mb-0 pricing-toggle-text monthly">Monthly</div>
                            <div class="mx-3">
                                <button class="pricing-toggle" data-parent="pricing-toggle-wrap" data-target="pricing-price-wrap">
                                    <span class="pricing-toggle-ball"></span>
                                </button>
                            </div>
                            <div class="h5 mb-0 pricing-toggle-text yearly position-relative"> Yearly <span class="badge text-bg-success-soft fw-normal text-uppercase smaller rounded-pill position-absolute ms-n5 mb-2 mb-sm-0 ms-sm-3 translate-middle-sm-y start-100 bottom-100 bottom-sm-auto top-sm-50">Save {{$member_year->discount}}% </span>
                            </div>
                        </div><!-- .pricing-toggle -->
                        <div class="row g-gs">
                            <div class="col-xxl-4 col-xl-4">
                                <div class="pricing h-100 pricing-featured bg-gradient-primary">
                                    <div class="pricing-body h-100 p-5 pt-3 p-md-0 pt-md-0 p-xl-5 pt-xl-3 d-md-flex d-xl-block">
                                        <div class="text-center p-md-5 p-xl-0 w-md-50 w-xl-100">
                                            <div class="badge bg-gradient-primary bg-opacity-20 gradient-angle-90 mb-4 px-3 py-2 rounded-pill small text-primary text-tracking-1">
                                                <div class="p-1">Most Popular</div>
                                            </div>
                                            <?php   
                                                // free plan
                                                $freemember=\App\Models\SubMembership::with('mem')->where('id',5)->first();
                                              // Plan price  Calculation for monthly                                         
                                                $member_month=\App\Models\SubMembership::with('mem')->where('type','Monthly')->first();
                                                $k=1;
                                                $total_price=$member_month->mem->price * $member_month->months;
                                                $discount=($total_price * $member_month->discount)/100;
                                                $monthly_finalamount=$total_price-$discount;
                                                $monthly=$monthly_finalamount/$member_month->months;
                                                
                                                // Plan price Calculation  for yearly 
                                                $member_year=\App\Models\SubMembership::with('mem')->where('type','Yearly')->first();
                                                $total_year_price=$member_year->mem->price * $member_year->months;
                                                $discount=($total_year_price * $member_year->discount)/100;
                                                $yearly_finalamount=$total_year_price-$discount;
                                                $yearly_per_month=$yearly_finalamount/$member_year->months;
                                            ?>
                                        
                                            <h3 class="mb-3">Pro</h3>
                                            <div class="pricing-price-wrap">
                                                <div class="pricing-price monthly">
                                                    <h3 class="display-5 mb-3">{{$currency_symbol}}{{ $monthly_finalamount}} <span class="caption-text text-muted"> / month</span></h3>
                                                </div>
                                                <div class="pricing-price yearly">
                                                    <h3 class="display-5 mb-3">{{$currency_symbol}}{{ $yearly_finalamount}} <span class="caption-text text-muted"> / yearly</span></h3>
                                                </div>
                                            </div>
                                            <p class="fw-bold text-primary">For content marketers, bloggers, freelancers &amp; startups</p>
                                            <div class="bg-light px-4 py-2 mb-4 smaller rounded-1">Try out all features to determine what works best for you</div>
                                            <div class="px-4">
                                            
                                                <a href="{{'register'}}" class="btn btn-outline-primary btn-block rounded-pill">Start Free Trial</a>
                                            </div>
                                        </div>
                                        <div class="d-none d-md-block d-xl-none border-start h-100"></div>
                                        <div class="pt-4 p-md-5 p-xl-0 pt-xl-4 w-md-50 w-xl-100">
                                            <h5 class="fw-medium pb-1">Everything in Free, plus month</h5>
                                            <?php
                                            $precision=1;
                                            $n=$member_month->mem->tokens * $member_month->months;
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
                                            <ul class="list gy-3">
												  <div class="pricing-price-wrap">
                                                <div class="pricing-price monthly">
                                                <li class="monthly"><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span><strong>50,000</strong> Words </span></li></div>
													   <div class="pricing-price yearly">
												 <li class="yearly"><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span><strong>600,000</strong> Words </span></li></div></div>
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span><strong>Pro</strong> Templates</span></li>
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>Blog Wizard Tool
</span></li>
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>AI Images, Chat & Speech to Text</span></li>
												<li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>5 Team Members
</span></li>
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>30+ Languages
</span></li>
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>Unlimited Projects & Folders</span></li>
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>Priority support</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-xxl-4 col-xl-4 col-md-6 order-xl-first">
                                <div class="h-100 pt-xl-6">
                                    <div class="pricing h-100">
                                        <div class="pricing-body h-100 p-5">
                                            <div class="text-center">
                                                <h3 class="mb-3">Free</h3>
                                                <h3 class="display-5 mb-3">Forever </h3>                                                
                                                <p class="fw-bold">Access to AI writer features to help you get a taste of AI writing.</p>
                                                <div class="bg-light px-4 py-2 mb-4 smaller rounded-1">Try out all features to determine what works best for you</div>
                                                <div class="px-4">
                                                    <a href="{{'register'}}" class="btn btn-outline-primary btn-block rounded-pill">Start Free Trial</a>
                                                </div>
                                            </div>
                                            <h5 class="fw-medium pt-4 pb-1">Give a try for free</h5>
                                            <ul class="list gy-3">
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span><strong>5000</strong> Words</span></li>
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span><strong>Free</strong> Templates</span></li>
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>Blog Wizard Tool
</span></li>
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>AI Images, Chat & Speech to Text
</span></li>

                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>30+ Languages
</span></li>
												
												 <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>Limited Projects & Folders

</span></li>
												 <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>Email Support
</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-xxl-4 col-xl-4 col-md-6">
                                <div class="h-100 pt-xl-6">
                                    <div class="pricing h-100">
                                        <div class="pricing-body h-100 p-5">
                                            <div class="text-center">
                                                <h3 class="mb-3">Custom</h3>
                                                <div class="media media-middle media-2xl bg-light rounded-pill mb-4 mt-3">
                                                    <em class="icon ni ni-building"></em>
                                                </div>
                                                <p class="fw-bold">Design your custom package for teams and business needs</p>
                                                <div class="bg-light px-4 py-2 mb-4 smaller rounded-1">Take your business to the another level with custom package and support.</div>
                                                <div class="px-4">
                                                    {{-- <button class="btn btn-outline-primary btn-block rounded-pill">Request for Demo</button> --}}                                                    
                                                    <a href="{{'register'}}" class="btn btn-outline-primary btn-block rounded-pill">Start Free Trial</a>
                                                </div>
                                            </div>
                                           
                                            <h5 class="fw-medium pt-4 pb-1">Everything in Pro, plus</h5>
                                            <ul class="list gy-3">
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span><strong>Custom pricing</strong></span></li>
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>Custom number of users</span></li>
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>Custom number of words</span></li>
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>Manage team member</span></li>
                                                <li><em class="icon fs-4 ni ni-check-circle-fill text-info"></em> <span>Premium support</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .section-content -->
                </div>
            </section>
            <section class="section bg-light" id="faq">
                <div class="container">
                    <div class="section-head">
                        <div class="row justify-content-center text-center">
                            <div class="col-xl-8">
                                <h2 class="title">Frequently Asked Questions</h2>
                                <p class="lead">If you have any questions not answered in the FAQ, please do not hesitate to contac us.</p>
                            </div>
                        </div>
                    </div><!-- .section-head -->
                    <div class="section-content">
                        <div class="row g-gs justify-content-center">
                            <div class="col-xl-9 col-xxl-8">
                                <div class="accordion accordion-separated accordion-plus-minus" id="faq-1">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#faq-1-1"> What is a copy? </button>
                                        </h2>
                                        <div id="faq-1-1" class="accordion-collapse collapse show" data-bs-parent="#faq-1">
                                            <div class="accordion-body"> Yes, you can write long articel for your blog posts, product descriptions or any long article with CopyGen. We're always updating our template and tools, so let us know what are expecting! </div>
                                        </div>
                                    </div><!-- .accordion-item -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-1-2"> Does CopyGen to write long articles? </button>
                                        </h2>
                                        <div id="faq-1-2" class="accordion-collapse collapse" data-bs-parent="#faq-1">
                                            <div class="accordion-body"> Yes, you can write long articel for your blog posts, product descriptions or any long article with CopyGen. We're always updating our template and tools, so let us know what are expecting! </div>
                                        </div>
                                    </div><!-- .accordion-item -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-1-3"> Is the generated content original? </button>
                                        </h2>
                                        <div id="faq-1-3" class="accordion-collapse collapse" data-bs-parent="#faq-1">
                                            <div class="accordion-body"> Yes, you can write long articel for your blog posts, product descriptions or any long article with CopyGen. We're always updating our template and tools, so let us know what are expecting! </div>
                                        </div>
                                    </div><!-- .accordion-item -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-1-4"> Do you have wordpress plugin? </button>
                                        </h2>
                                        <div id="faq-1-4" class="accordion-collapse collapse" data-bs-parent="#faq-1">
                                            <div class="accordion-body"> Yes, you can write long articel for your blog posts, product descriptions or any long article with CopyGen. We're always updating our template and tools, so let us know what are expecting! </div>
                                        </div>
                                    </div><!-- .accordion-item -->
                                </div><!-- .accordion -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .section-content -->
                </div><!-- .container -->
            </section><!-- .section -->
        </main>
        <!-- start page footer -->
        <footer class="nk-footer">
            <section class="section bg-light section-0 has-mask">
                <div class="nk-mask bg-darker top-50"></div>
                <div class="container container-xl">
                    <div class="section-wrap bg-dark is-dark rounded-4 has-shape overflow-hidden">
                        <div class="nk-shape bg-shape-blur-b start-50 top-50 translate-middle"></div>
                        <div class="section-content p-4 p-sm-5 p-xl-7">
                            <div class="row justify-content-between align-items-center g-5">
                                <div class="col-xl-5 col-lg-6">
                                    <div class="block-text">
                                        <h6 class="overline-title text-primary">Boost your writing productivity</h6>
                                        <h2 class="title">End writer’s block today</h2>
                                        <p>It’s like having access to a team of copywriting experts writing powerful copy for you in 1-click.</p>
                                        <ul class="list list-row gx-3 gy-0">
                                            <li><em class="icon fs-5 ni ni-check-circle-fill text-info"></em><span>No credit card required</span></li>
                                            <li><em class="icon fs-5 ni ni-check-circle-fill text-info"></em><span>Cancel anytime</span></li>
                                        </ul>
                                        <ul class="btn-list btn-list-inline gy-0">
                                            <li><a href="{{route('login')}}" class="btn btn-lg btn-primary rounded-pill"><span>Start writing for free</span><em class="icon ni ni-arrow-long-right"></em></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 align-self-end">
                                    <div class="bg-white rounded-top-4">
                                        <div class="rounded-top-4 bg-gradient-primary bg-opacity-70 p-5 pb-0 mb-n4 mb-sm-n5 mb-xl-n7">
                                            <div class="block-gfx">
                                                <img class="w-100 rounded-top-3 shadow-sm" src="{{ asset('assets/images/gfx/process/c.jpg') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .container -->
            </section><!-- .section -->
            <section class="section bg-darker is-dark">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-xl-4 col-lg-3 me-auto">
                            <div class="block-text">
                                <a href="index.html" class="logo-link mb-4">
                                    <div class="logo-wrap">
                                        <img class="logo-img logo-light" src="{{$url_aws}}admin/{{$logo}}" srcset="{{$url_aws}}admin/{{$logo}}" alt="">
                                        <img class="logo-img logo-dark" src="{{$url_aws}}admin/{{$logo}}" srcset="{{$url_aws}}admin/{{$logo}} " alt="">
                                    </div>
                                </a>
                                <ul class="btn-list btn-list-inline g-1">
                                    <li><a class="link-base" href="{{$facebook}}"><em class="icon fs-3 ni ni-facebook-fill"></em></a></li>
                                    <li><a class="link-base" href="{{$google}}"><em class="icon fs-3 ni ni-youtube-round"></em></a></li>
                                    <li><a class="link-base" href="{{$twitter}}"><em class="icon fs-3 ni ni-linkedin-round"></em></a></li>
                                </ul>
                            </div>
                        </div><!-- .col -->
                        <div class="col-xl-2 col-lg col-md-3 col-6">
                            <div class="wgs">
                                <h6 class="wgs-title">Tools</h6>
                                <ul class="list gy-2 list-link-base">
									<li><a href="{{url('/')}}?tool=ai-article-writer">AI Rewriter</a></li>
									  <li> <a class="link-base" href="{{url('/')}}?tool=ai-image-generator">AI Image Generator</a></li>
									  <li><a class="link-base" href="{{url('/')}}?tool=social-post-writer">Social Post Writer</a></li>
									  <li><a class="link-base" href="{{url('/')}}?tool=blog-writer">Blog writer</a></li>
									  <li><a class="link-base" href="{{url('/')}}?tool=keywords-generator">Keywords Generator</a></li>
									  <li><a class="link-base" href="{{url('/')}}?tool=answer-my-question">Answer My Question</a></li>
                                </ul>
                            </div>
                        </div><!-- .col -->
                        <div class="col-xl-2 col-lg col-md-3 col-6">
                            <div class="wgs">
                                <h6 class="wgs-title">Resources</h6>
                                <ul class="list gy-2 list-link-base">
                                    <li><a class="link-base" href="#">Facebook Group</a></li>
                                    <li><a class="link-base" href="#">Discord Community</a></li>
                                    <li><a class="link-base" href="#">Guide and Tutorials</a></li>
                                    <li><a class="link-base" href="#">Request API access</a></li>
                                </ul>
                            </div>
                        </div><!-- .col -->
                        <div class="col-xl-2 col-lg col-md-3 col-6">
                            <div class="wgs">
                                <h6 class="wgs-title">Company</h6>
                                <ul class="list gy-2 list-link-base">
                                    <li><a class="link-base" href="#">About us</a></li>
                                    <li><a class="link-base" href="#">Careers</a></li>
                                    <li><a class="link-base" href="#">Pricing</a></li>
                                    <li><a class="link-base" href="#">Contact Us</a></li>
                                    <li><a class="link-base" href="#">Wall of Love</a></li>
                                </ul>
                            </div>
                        </div><!-- .col -->
                        <div class="col-xl-2 col-lg col-md-3 col-6">
                            <div class="wgs">
                                <h6 class="wgs-title">Use Case</h6>
                                <ul class="list gy-2 list-link-base">
                                    <li><a class="link-base" href="#">AI Writer</a></li>
                                    <li><a class="link-base" href="#">AI Articel Writer</a></li>
                                    <li><a class="link-base" href="#">Content Generator</a></li>
                                    <li><a class="link-base" href="#">AI Content Writing</a></li>
                                    <li><a class="link-base" href="#">Content Rewriter</a></li>
                                    <li><a class="link-base" href="#">Blog Post Writer</a></li>
                                </ul>
                            </div>
                        </div><!-- .col -->
                    </div>
                </div><!-- .container -->
            </section><!-- .section -->
            <div class="bg-darker is-dark">
                <div class="container">
                    <hr class="border-opacity-25 border-white m-0">
                    <div class="py-5">
                        <div class="row">
                            <div class="col-md">
                                <p class="mb-2 mb-md-0">&copy;{{date('Y')}} {{$appname}}.</p>
                            </div>
                            <div class="col-md">
                                <ul class="list list-row gx-4 justify-content-start justify-content-md-end">
                                    <li><a href="#" class="link-primary">Terms</a></li>
                                    <li><a href="#" class="link-primary">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end page footer -->
    </div>
    <script src="{{url('user_assets/assets/js/bundle.js?v1.1.0')}}"></script>
    <script src="{{url('user_assets/assets/js/scripts.js?v1.1.0')}}"></script>
</body>

</html>