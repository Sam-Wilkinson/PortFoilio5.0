@extends('layout.Master')

@section('content')

<div class="w3-padding-large" id="main">

@include('welcome-content.Header')

@include('welcome-content.About.Description')

@include('welcome-content.About.Table')
  
@include('welcome-content.About.Testimonials')
    
@include('welcome-content.Projects')
  
@include('welcome-content.Contact')

</div>

@endsection 