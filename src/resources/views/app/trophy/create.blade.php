@extends('showcase::app.layouts.app')

@section('title', 'Create Trophy')

@section('content')
<main class="col-md-6 showcase-trophy-main">
    <h1>Create New Trophy</h1>
    <form action="{{route(config('showcase.route_prefix', 'showcase') . '.trophies.store', compact('trophies'))}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Component View</label>
            {{-- <input class="form-control" type="text" name="component_view" value="{{old('component_view')}}"> --}}
            <select class="form-control" name="component_view">
                @foreach($trophyViews as $view)
                <option value="{{ $view }}" {{ old('component_view') === $view ? 'selected' : '' }}>{{ $view }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Trophy Name</label>
            <input class="form-control" type="text" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input class="form-control" type="text" name="link" value="{{old('link')}}">
        </div>
        <div class="form-group">
            <label for="image_url">Image URL</label>
            <input class="form-control" type="text" name="image_url" value="{{old('image_url')}}">
        </div>
        <div class="form-group">
            <label for="description">Short Description</label>
            <input type="text" class="form-control" name="description" value="{{old('description')}}">
        </div>
        <div class="form-group">
            <label for="displays[]">Displays</label>
            <select class="form-control" name="displays[]" id="" multiple="">
                @foreach($displays as $display)
                <option value="{{$display->id}}">{{$display->name}}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success btn-block" type="submit">Save</button>
    </form>
</main>
@stop