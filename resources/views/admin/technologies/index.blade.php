@extends('adminlte::page')

@section('title', 'Technologies')

@section('content_header')
    <h1>Technologies</h1>
@stop

@section('content')
    @include('partials.notification')
    <div>
        <a href="{{route('technologies.create')}}" class="btn btn-success">Add a new Technology</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Competence</th> 
                <th>Projects</th>
                <th>Update</th>
            </tr>
        </thead>
            <tbody>
                @foreach($technologies as $tech)
                <tr>
                    <td>{{$tech->name}}</td>
                    <td>{{$tech->description}}</td>
                    <td>{{$tech->competence}}</td>
                    <td>
                        @foreach($tech->projects as $project)
                        {{$project->name}}<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('technologies.edit',['technology'=>$tech->id])}}" class="btn btn-warning">Edit</a>
                        <form class="d-inline" method="POST" action="{{route('technologies.destroy',['tech'=>$tech->id])}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
@stop