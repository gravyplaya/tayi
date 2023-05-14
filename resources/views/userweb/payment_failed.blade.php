 
@extends('userweb.layout.app')
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-size:20px;
          margin: 0;
        }
      .checkmark {
        color: red;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>

@section('content')


 <div class="container">
        <div class="row">
          
          <center>
            <div class="col-lg-8">
          <div class="card">
          <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <span class="checkmark"><center>X</center></span>
          </div><br>
            <h1 style="color:red;">Failed</h1> 
            <p>Your Payment has been failed!  <br><br><button  data-bs-toggle="modal" data-bs-target="#upgradeplan" class="btn btn-primary">click here to try again </button></p>
          </div>
          </div>
        </center>
        </div>
      </div>
@endsection