@extends('adminlte::page')

@section('title', 'Testimonials')

@section('content_header')
    <h1>Testimonials</h1>
@stop

@section('content')
    @include('partials.notification')
    <div>
        <a href="{{route('testimonials.create')}}" class="btn btn-success">Add a new Testimonial</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Content</th>
                <th>From</th>
                <th>For</th> 
                <th>Update</th>
            </tr>
        </thead>
            <tbody>
                @foreach($testimonials as $testimonial)
                <tr>
                    <td>{{$testimonial->content}}</td>
                    <td>{{$testimonial->client->name}}</td>
                    <td>
                        @foreach($testimonial->projects as $project)
                        {{$project->name}}<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('testimonials.edit',['testimonial'=>$testimonial->id])}}" class="btn btn-warning">Edit</a>
                        <form class="d-inline" method="POST" action="{{route('testimonials.destroy',['testimonial'=>$testimonial->id])}}">
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