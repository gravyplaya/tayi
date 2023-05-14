 @php($logo=\App\Models\Setting::where('name','logo')->first()->value)
     @php($appname=\App\Models\Setting::where('name','app_name')->first()->value)
    @php($favicon=\App\Models\Setting::where('name','favicon')->first()->value)
     @php($footer_text1=\App\Models\Setting::where('name','footer_text1')->first()->value)
     @php($footer_text2=\App\Models\Setting::where('name','footer_text2')->first()->value)
<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
        <p class="text-muted mb-1 mb-md-0">{{$footer_text1}} <a href="{{url('/')}}" target="_blank">{{$appname}}</a>.</p>
        <p class="text-muted">{{$footer_text2}}</p>
      </footer>