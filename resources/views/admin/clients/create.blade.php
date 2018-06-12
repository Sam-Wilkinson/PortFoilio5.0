@extends('adminlte::page')

@section('title', 'Clients')

@section('content_header')
    <h1> Add a Client</h1>
@stop

@section('content')
<form method="POST" action="{{route('clients.store')}}" enctype="multipart/form-data">
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
        <input type="text" name="name" id="name" class="form-control border {{$errors->has('name')? 'border-danger': ''}}" value="{{old('name')}}" aria-describedby="helpId">
    </div>

    <div class="border border-dark p-1 my-1">
        <label for="">Description</label>
            @if($errors->has('description'))
                <div class="text-danger">{{$errors->first('description')}}</div>
            @endif
        <textarea class="form-control border {{$errors->has('description')? 'border-danger': ''}}" name="description" id="description" rows="3" placeholder="">{{old('description')}}</textarea>
    </div>
    
    <div class="custom-file my-3 p-1">
            @if($errors->has('image'))
            <div class="text-danger">{{$errors->first('image')}}</div>
            @endif
        <input type="file" class="custom-file-input" id="image" name="image">
        <label class="custom-file-label" for="image" >Choose file</label>
    </div>
    
    <div class="border border-dark p-1 my-1">
    <label for="">Clients Social Media</label>
        @if($errors->has('social'))
            @foreach($errors->get('social') as $error)
                <div class="text-danger">{{$error}}</div>
            @endforeach
        @endif
        <input type="url" name="social" id="social" class="form-control border {{$errors->has('social')? 'border-danger': ''}}" value="{{old('social')}}" aria-describedby="helpId">
    </div>  
    <button class="btn btn-success mt-3 pull-right" type="submit">Create</button>
</form>
@stop