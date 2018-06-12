@extends('adminlte::page')

@section('title', 'Clients')

@section('content_header')
    <h1>{{$client->name}}</h1>
@stop

@section('content')
    @include('partials.notification')
<div class="card mb-3">
    <img src="{{Storage::disk('ClientImg-banner')->url($client->image)}}" alt="Banner Post Image">
    <div class="card-body">
        <h1 class="card-title text-center">{{$client->name}}</h5>
        <h2 class="card-text text-center">{{$client->description}}</h2>
        <div class="card-text text-center">
            <a href="{{$client->social}}">{{$client->social}}</a>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{route('clients.edit',['client'=>$client->id])}}" class="btn btn-warning mx-1">Edit</a>
            <form class="d-inline" method="POST" action="{{route('clients.destroy',['client'=>$client->id])}}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </div>
    </div>
</div>
<h1>Projects and Testimonials</h1>
@if($client->projects->isEmpty())
@else
@foreach($client->projects as $project)
    <div class="d-flex justify-content-around">
            <a href="{{route('projects.show',['project'=>$project->id])}}" class="list-group-item list-group-item-action">
                <h5>{{$project->name}}</h5>
                <h5>{{$project->description}}</h5>
            </a>
            <div>
                <ul class="list-group-item">
                    @foreach($project->testimonials as $testimonial)
                        <a href="#" class="list-group-item list-group-item-action">{{$testimonial->content}}</a>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
@endif
@stop