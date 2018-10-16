@extends('showcase::app.layouts.app') 
@section('title', 'Edit Trophy') 
@section('content')
<main class="col-md-6 showcase-trophy-main">
    <h1>Edit Trophy</h1>
    <form action="{{route('trophies.update', compact('display', 'trophy'))}}" method="post">
        {{csrf_field()}} {{method_field('PUT')}}
        <div class="form-group">
            <label for="name">Component View</label>
            {{-- <input class="form-control" type="text" name="component_view" value="{{$trophy->component_view}}"> --}}
            <select class="form-control" name="component_view">
                @foreach($trophyViews as $view)
                <option
                    value="{{ $view }}" 
                    {{
                        (old('component_view') === $view || $trophy->component_view === $view)
                            ? 'selected'
                            : ''
                    }}
                >
                    {{ $view }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Trophy Name</label>
            <input class="form-control" type="text" name="name" value="{{$trophy->name}}">
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input class="form-control" type="text" name="link" value="{{$trophy->link}}">
        </div>
        <div class="form-group">
            <label for="image_url">Image URL</label>
            <input class="form-control" type="text" name="image_url" value="{{$trophy->image_url}}">
        </div>
        <div class="form-group">
            <label for="description">Short Description</label>
            <input type="text" class="form-control" name="description" value="{{$trophy->description}}">
        </div>
        <div class="form-group">
                <label for="displays[]">Displays</label>
                <select class="form-control" name="displays[]" id="" multiple="">
                    @foreach($displays as $display)
                    <option value="{{$display->id}}" {{!$trophy->hasDisplay($display) ?: 'selected'}}>{{$display->name}}</option>
                    @endforeach
                </select>
            </div>
        <button class="btn btn-success btn-block" type="submit">Update</button>
    </form>
</main>

@stop