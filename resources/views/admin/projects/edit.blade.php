@extends('adminlte::page')

@section('title', 'Projects')

@section('content_header')
    <h1>Edit a Project</h1>
@stop

@section('content')
<form method="POST" action="{{route('projects.update',['project'=>$project->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
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
        <input type="text" name="name" id="name" class="form-control border {{$errors->has('name')? 'border-danger': ''}}" value="{{old('name',$project->name)}}" aria-describedby="helpId">
    </div>

    <div class="border border-dark p-1 my-1">
        <label for="">Description</label>
            @if($errors->has('description'))
                <div class="text-danger">{{$errors->first('description')}}</div>
            @endif
        <textarea class="form-control border {{$errors->has('description')? 'border-danger': ''}}" name="description" id="description" rows="3" placeholder="">{{old('description',$project->description)}}</textarea>
    </div>

    <div class="custom-file my-3 p-1">
            @if($errors->has('image'))
            <div class="text-danger">{{$errors->first('image')}}</div>
            @endif
        <input type="file" class="custom-file-input" id="image" name="image">
        <label class="custom-file-label" for="image" >Choose file</label>
    </div>

    <div class="border border-dark p-1 my-1">
    <label for="">URL of Project</label>
        @if($errors->has('URL'))
            @foreach($errors->get('URL') as $error)
                <div class="text-danger">{{$error}}</div>
            @endforeach
        @endif
        <input type="url" name="URL" id="URL" class="form-control border {{$errors->has('URL')? 'border-danger': ''}}" value="{{old('URL',$project->URL)}}" aria-describedby="helpId">
    </div>

    <div class="border border-dark p-1 my-1">
    <label for="">Date of Project</label>
        @if($errors->has('date'))
            @foreach($errors->get('date') as $error)
                <div class="text-danger">{{$error}}</div>
            @endforeach
        @endif
        <input type="date" name="date" id="date" class="form-control border {{$errors->has('date')? 'border-danger': ''}}" value="{{old('date',$project->date)}}" aria-describedby="helpId">
    </div>

    <div class="border border-dark p-1 my-1">
        <label for="">Technology</label>
        @if($errors->has('technologies'))
            @foreach($errors->get('technologies') as $error)
                <div class="text-danger">{{$error}}</div>
            @endforeach
        @endif
        @foreach($technologies as $tech)
        <div>
            <input type="checkbox" id="technologies" name="technologies[]" value="{{$tech->id}}" 
                @foreach($project->technologies as $techno){{old('technologies',
                    $techno->id==$tech->id? 'checked' : '')}}
                @endforeach>
            <label for="coding">{{$tech->name}}</label>
        </div>
        @endforeach
    </div>

    <div class="border border-dark p-1 my-1">
        <label for="">Client</label>
        @if($errors->has('client'))
            @foreach($errors->get('client') as $error)
                <div class="text-danger">{{$error}}</div>
            @endforeach
        @endif
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Client List
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach($clients as $client)
                    <input type="radio" id="client" name="client" value="{{$client->id}}"{{old('client',
                    $project->client->id==$client->id? 'checked' : '')}}>{{$client->name}}<br>
                @endforeach
            </div>
        </div>
    </div>  
    <button class="btn btn-success mt-3 pull-right" type="submit">Update</button>
</form>
@stop