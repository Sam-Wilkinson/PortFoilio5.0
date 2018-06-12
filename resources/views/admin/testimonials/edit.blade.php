@extends('adminlte::page')

@section('title', 'Testimonials')

@section('content_header')
    <h1>Edit a Testimonial</h1>
@stop

@section('content')
<form method="POST" action="{{route('testimonials.store')}}" enctype="multipart/form-data">
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
        <label for="">Content</label>
            @if($errors->has('content'))
                <div class="text-danger">{{$errors->first('content')}}</div>
            @endif
        <textarea class="form-control border {{$errors->has('content')? 'border-danger': ''}}" name="content" id="content" rows="3" placeholder="">{{old('content',$testimonial->content)}}</textarea>
    </div> 
    <div class="border border-dark p-1 my-1">
            <label for="">Client</label>
            @if($errors->has('client'))
                @foreach($errors->get('client') as $error)
                    <div class="text-danger">{{$error}}</div>
                @endforeach
            @endif
            <ul class="d-flex justify-content-start flex-wrap">
                    @foreach($clients as $client)
                    <li class="list-group-item col-sm-3">
                        <input type="radio" id="client" name="client" value="{{$client->id}}" {{old('client',
                        $testimonial->client->id==$client->id? 'checked' : '')}}>{{$client->name}}
                    </li>
                    @endforeach
            </ul>
        </div>  
        <p>Do some Fancy Js to show the projects only associated with one client</p>
    <button class="btn btn-success mt-3 pull-right" type="submit">Create</button>
</form>
@stop