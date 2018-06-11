@extends('adminlte::page')

@section('title', 'Projects')

@section('content_header')
    <h1>Projects</h1>
@stop

@section('content')
<div>
     <a href="{{route('projects.create')}}" class="btn btn-success">Add a new Project</a>
</div>
<div class="d-flex justify-content-between flex-wrap">
@foreach($projects as $project)
    <div class="card col-3 m-2" style="width: 18rem;">
            <img href="{{Storage::disk('ProjectImg-thumb')->url($project->image)}}" alt="Banner Post Image">
        <div class="card-body">
            <h5 class="card-title">{{$project->name}}</h5>
            <p class="card-text">{{$project->description}}</p>
            <h6>{{$project->date}}</h6>
            <h6>{{$project->URL}}</h6>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Client: {{$project->client->name}}</li>
            @if($project->testimonials != null)
                @foreach($project->testimonials as $testimonial)
                    <li class="list-group-item">Testimonial: {{$testimonial->content}}</li>
                @endforeach
            @endif
            <li class="list-group-item">Technologies:
                @foreach($project->technologies as $tech)
                     {{$tech->name}}
                @endforeach
            </li>
           
        </ul>
        <div class="card-body">
            <a href="{{route('projects.show',['project'=>$project->id])}}" class="card-link btn btn-primary">Project</a>
            <a href="#" class="card-link btn btn-warning">Client</a>
            <a href="#" class="card-link btn btn-danger">Tech</a>
        </div>
  </div>
@endforeach
</div>
@stop