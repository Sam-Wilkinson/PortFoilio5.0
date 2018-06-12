@extends('adminlte::page')

@section('title', 'Technologies')

@section('content_header')
    <h1> Add a Technology</h1>
@stop

@section('content')
<form method="POST" action="{{route('technologies.store')}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="border border-dark p-1 my-1">
            <label for="">Name</label>
            @if($errors->has('name'))
                @foreach($errors->get('name') as $error)
                    <div class="text-danger">{{$error}}</div>
                @endforeach
            @endif
            <input type="text" name="name" id="name" class="form-control border {{$errors->has('name')? 'border-danger': ''}}" value="{{old('name',$technology->name)}}" aria-describedby="helpId">
    </div>
    
    <div class="border border-dark p-1 my-1">
            <label for="">Description</label>
                @if($errors->has('description'))
                    <div class="text-danger">{{$errors->first('description')}}</div>
                @endif
            <textarea class="form-control border {{$errors->has('description')? 'border-danger': ''}}" name="description" id="description" rows="3" placeholder="">{{old('description',$technology->description)}}</textarea>
    </div>

    <div class="border border-dark p-1 my-1">
            <label for="">Competence</label>
            @if($errors->has('competence'))
                @foreach($errors->get('competence') as $error)
                    <div class="text-danger">{{$error}}</div>
                @endforeach
            @endif
            <input type="number" name="competence" id="competence" class="form-control border {{$errors->has('name')? 'border-danger': ''}}" value="{{old('competence',$technology->competence)}}" aria-describedby="helpId">
    </div>

    <div class="border border-dark p-1 my-1">
            <label for="">Projects</label>
            @if($errors->has('project'))
                @foreach($errors->get('project') as $error)
                    <div class="text-danger">{{$error}}</div>
                @endforeach
            @endif
            <ul class="d-flex justify-content-start flex-wrap">
                @foreach($projects as $project)
                <li class="list-group-item col-sm-3">
                    <input type="checkbox" id="projects" name="projects[]" value="{{$project->id}}"
                    @foreach($technology->projects as $techproject)
                    {{old('projects',$techproject->id==$project->id? 'checked' : '')}}
                    @endforeach>
                    {{$project->name}}
                </li>
                @endforeach
            </ul>
    </div>      
    <button class="btn btn-success mt-3 pull-right" type="submit">Update</button>
</form>
@stop