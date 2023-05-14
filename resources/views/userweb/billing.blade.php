@extends('userweb.layout.app')

@section('content')

    <style>
        h1.nd,
        h2.nd {
            color: #141125;
            font-weight: 700;
            font-size: 30px;
            line-height: 38px;
            margin-bottom: 3px;
            letter-spacing: -0.02em;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .sub-nd {
            color: #667085;
            font-size: 15px;
            font-weight: 500;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: -0.01em;
            margin-bottom: 20px;
        }

        p {
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 10%), 0 1px 2px 0 rgb(0 0 0 / 6%);
            border-radius: 6px;
        }

        .card {
            border: 0;
            border-radius: 0;
        }

        .grid-margin {
            margin-bottom: 30px;
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.3125rem;
        }

        .billing-plan-name {
            font-size: 17px;
            color: #141125;
            align-items: center;
            margin-bottom: 4px;
        }

        .flex {
            display: flex;
        }

        ul.plan-benefits li {
            width: 33.33333%;
            display: flex;
            align-items: center;
            line-height: 25px;
        }

        ul li,
        ol li,
        dl li {
            line-height: 1.8;
        }

        ul.plan-benefits {
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            color: #4a5568;
            margin-bottom: 0;
            margin-top: 5px;
        }

        ul {
            list-style: none;
        }

        ul,
        ol,
        dl {
            padding-left: 1rem;
            font-size: 0.875rem;
        }

        ul.plan-benefits li i {
            color: #3CCB7F;
            font-size: 18px;
            margin-right: 5px;
        }

        .mdi-check:before {
            content: "\F12C";
        }

        .mdi:before,
        .mdi-set {
            display: inline-block;
            font: normal normal normal 24px/1 "Material Design Icons";
            font-size: inherit;
            text-rendering: auto;
            line-height: inherit;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .page-template-billing .card-footer {
            background-color: #fff;
            border-radius: 0 0 6px 6px;
            padding: 10px 25px 12px !important;
            border-color: #f4f4f4;
            align-items: center;
        }

        .card-footer:last-child {
            border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);
        }

        .justify-right {
            justify-content: right;
        }

        #upgrade-plan {
            font-size: 13px;
            align-items: center;
            padding-right: 12px;
            color: #2e16e6;
        }

        .card-footer {
            padding: 0.75rem 1.25rem;
            background-color: rgba(0, 0, 0, 0.03);
            border-top: 1px solid rgba(0, 0, 0, 0.125);
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search
        </h2>
    </x-slot>
   
    <div  align="center">
        @php($plan=\App\Models\SubMembership::with('mem')->where('id',auth()->user()->plan_id)->first())
        @php($language=\App\Models\Language::count())
        <?php $planend = strtotime(auth()->user()->plan_end);
             $today = strtotime(date('Y-m-d')); 
?>
        <h1 class="nd">Billing</h1>
        <p class="sub-nd">Manage your billing and payment details.</p>
        <div class="card grid-margin" style="width: 70%">
            <div class="card-body">
                <div class="flex space-between">
                    <div class="flex flex-column">
                        <div class="flex billing-plan-name"><strong>{{$plan->mem->name}} @if($plan->id != 5)({{$plan->type}}) @endif</strong></div>
                       @if($plan->id==5) <p class="extra-dark mb-0"><strong>Upgrade your account and enjoy:</strong></p>@endif
                        <ul class="plan-benefits">
                            <li><i class="fa fa-check" aria-hidden="true"></i> @if($plan->id != 5) {{$plan->mem->tokens * $plan->months}} @endif  @if($plan->id==5) {{$plan->mem->tokens }} @endif tokens</li>
                            <li>@if($plan->id==5) <i class="fa fa-close" aria-hidden="true" style="color:red"></i>@else <i class="fa fa-check" aria-hidden="true"></i> @endif Access to all tools</li>
                            <li>@if($plan->id==5) <i class="fa fa-close" aria-hidden="true" style="color:red"></i>@else <i class="fa fa-check" aria-hidden="true"></i> @endif  Unlimited folders</li>
                            <li>@if($plan->id==5)<i class="fa fa-close" aria-hidden="true" style="color:red"></i>@else <i class="fa fa-check" aria-hidden="true"></i> @endif  Unlimited projects</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> {{$language -1}}+ languages</li>
                            <li>@if($plan->id==5)<i class="fa fa-close" aria-hidden="true" style="color:red"></i>@else <i class="fa fa-check" aria-hidden="true"></i> @endif  Article Generator</li>
                            <li>@if($plan->id==5)<i class="fa fa-close" aria-hidden="true" style="color:red"></i>@else <i class="fa fa-check" aria-hidden="true"></i> @endif  Image Generator</li>
                         
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer flex justify-right">
                @if($plan->id==5 || $planend < $today)
                <a class="btn btn-primary rounded shadow-sm btn-sm flex" data-bs-toggle="modal" data-bs-target="#upgradeplan">Upgrade plan </a>
                 @endif
            </div>
        </div>
    </div>
@endsection
