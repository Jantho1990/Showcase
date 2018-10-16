@extends('showcase::app.layouts.app') 
@section('title', 'Create Display') 
@section('content')
<main class="col-sm-6 showcase-display-main">
    <h1>Create New Display</h1>
    <form action="{{route('displays.store')}}" method="POST">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Display Name</label>
            <input class="form-control" type="text" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="component_view">Component View</label>
            <select class="form-control" name="component_view">
                @foreach($displayViews as $view)
                <option value="{{ $view }}">{{ $view }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="default_trophy_component_view">Default Trophy Component View</label>
            {{-- <input class="form-control" type="text" name="default_trophy_component_view" value="{{old('default_trophy_component_view')}}"> --}}
            <select class="form-control" name="default_trophy_component_view">
                @foreach($trophyViews as $view)
                <option value="{{ $view }}">{{ $view }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group form-check">
        <input class="form-check-input" type="checkbox" name="force_trophy_default" value="1" {{old('force_trophy_default') !== '1' ?: 'checked'}}>
            <label class="form-check-label" for="force_trophy_default">Force Default Trophy View</label>
        </div>
        <div class="form-group">
            <label for="trophies[]">Trophies</label>
            <select class="form-control" name="trophies[]" id="" multiple="">
                @foreach($trophies as $trophy)
                <option value="{{$trophy->id}}">{{$trophy->name}}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success btn-block" type="submit">Save</button>
    </form>
</main>
@stop