@extends('adminlte::page')

@section('title', 'Projects')

@section('content_header')
    <h1>{{$project->name}}</h1>
@stop

@section('content')
<div class="card mb-3">
        <img href="{{Storage::disk('ProjectImg-banner')->url($project->image)}}" alt="Banner Post Image">
        <div class="card-body">
          <h1 class="card-title text-center">{{$project->name}}</h5>
          <h2 class="card-text text-center">{{$project->description}}</h2>
          <table class=" card-body table">
                <thead>
                    <tr>
                        <th>URL</th>
                        <th>Client</th>
                        <th>Testimonials</th> 
                        <th>Technologies</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$project->URL}}</td>
                        <td>{{$project->client->name}}</td>
                        <td>
                            @foreach($project->testimonials as $testimonial)
                            {{$testimonial->content}}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($project->technologies as $technologies)
                            {{$technologies->name}}<br>   
                            @endforeach
                        </td>
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <h4 class="card-text"><small class="text-muted">{{$project->date}}</small></h4>
                <div>
                    <a href="{{route('projects.edit',['project'=>$project->id])}}" class="btn btn-warning">Edit</a>
                    <form class="d-inline" method="POST" action="{{route('projects.destroy',['project'=>$project->id])}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
@stop