@extends('adminlte::page')

@section('title', 'Clients')

@section('content_header')
    <h1>Clients</h1>
@stop

@section('content')
    @include('partials.notification')
<div>
     <a href="{{route('clients.create')}}" class="btn btn-success">Add a new Client</a>
</div>
<div class="d-flex justify-content-between flex-wrap">
@foreach($clients as $client)
    <div class="card col-3 m-2">
        @if($client->image != null)
            <img class="p-1 " src="{{Storage::disk('ClientImg-thumb')->url($client->image)}}" alt="Banner Post Image">
        @else 
            <img class="p-1 " src="{{Storage::disk('ClientImg-thumb')->url($client->image)}}" alt="Banner Post Image">
        @endif
        <div class="card-body ">
            <h5 class="card-title">{{$client->name}}</h5>
            <p class="card-text">{{$client->description}}</p>
            <a href="{{$client->social}}">{{$client->social}}</a>
        </div>
        <ul class="list-group my-1">
            <li class="list-group-item active m-1">Projects</li>
            @if($client->projects != null)
                @foreach($client->projects as $project)
                    <a href="{{route('projects.show',['project'=>$project->id])}}" class="list-group-item list-group-item-action text-dark m-1">{{$project->name}}</a>
                @endforeach
            @endif
        </ul>
        <ul class="list group p-0 my-1">
            <li class="list-group-item active m-1">Testimonials</li>
            @if($client->testimonials != null)
                @foreach($client->testimonials as $testimonial)
                    <a href="#" class="list-group-item m-1 list-group-item-action">{{$testimonial->content}}</a>
                @endforeach
            @endif
        </ul>         
        <div class="card-body">
            <a href="{{route('clients.show',['client'=>$client->id])}}" class="card-link btn btn-primary">Details</a>
        </div>
  </div>
@endforeach
</div>
@stop