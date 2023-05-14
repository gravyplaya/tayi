@extends('admin.layout.app')
@section('content')
<div class="container">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
            <h6 class="card-title" >Edit Home Page</h6>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-8">
                        <img src="{{ asset('assets/home/how_to.png')}}" alt="how_to_section" height="400px"  width="100%" >
                    </div>
                    
                    <div class="col-2">
                    <a href="{{ route('admin.home_how_to_list')}}" class="btn btn-primary btn-lg " style="margin:50% 20% 0% 20%" >Edit</a>
                    </div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-8">
                        <img src="{{ asset('assets/home/use_cases.png')}}" alt="use_cases" height="400px" width="100%" >
                    </div>
                    
                    <div class="col-2">
                    <a href="{{ route('admin.use_cases_list')}}" class="btn btn-primary btn-lg" style="margin:50% 20% 50% 20%">Edit</a>
                    </div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-8">
                        <img src="{{ asset('assets/home/Home2Box.png')}}" alt="home2_box" height="400px"  width="100%" >
                    </div>
                    
                    <div class="col-2">
                    <a href="{{ route('admin.home2_box_list')}}" class="btn btn-primary btn-lg" style="margin:50% 20% 0% 20%">Edit</a>
                    </div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-8">
                        <img src="{{ asset('assets/home/faq.png')}}" alt="FAQ" height="400px"  width="100%" >
                    </div>
                    
                    <div class="col-2">
                    <a href="{{ route('admin.faq_list')}}" class="btn btn-primary btn-lg" style="margin:50% 20% 0% 20%">Edit</a>
                    </div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-8">
                        <img src="{{ asset('assets/home/footer_block.png')}}" alt="Footer Block" height="400px"  width="100%" >
                    </div>
                    
                    <div class="col-2">
                    <a href="{{ route('admin.footer_block_edit')}}" class="btn btn-primary btn-lg" style="margin:50% 20% 50% 20%">Edit</a>
                    </div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-8">
                        <img src="{{ asset('assets/home/banner_edit.png')}}" alt="Banner Block" height="400px"  width="100%" >
                    </div>
                    
                    <div class="col-2">
                    <a href="{{ route('admin.banner_edit')}}" class="btn btn-primary btn-lg" style="margin:50% 20% 50% 20%">Edit</a>
                    </div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-8">
                        <img src="{{ asset('assets/home/pricing.png')}}" alt="Payment Section" height="400px"  width="100%" >
                    </div>
                    
                    <div class="col-2">
                        <a href="{{ route('admin.pricing_list')}}" class="btn btn-primary btn-lg" style="margin:50% 20% 50% 20%">Edit</a>
                    </div>
                </div>
                

            </div>
        </div>
    </div>
</div>



@endsection
@push('scripts')
@endpush