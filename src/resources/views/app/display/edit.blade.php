@extends('showcase::app.layouts.app') 
@section('title', 'Edit Display') 
@section('content')
<main class="col-md-6 showcase-display-main">
    <h1>Edit Display</h1>
    <form action="{{route('displays.update', compact('display'))}}" method="POST">
        {{method_field('PUT')}} {{csrf_field()}}
        <div class="form-group">
            <label for="name">Display Name</label>
            <input class="form-control" type="text" name="name" value="{{$display->name}}">
        </div>
        <div class="form-group">
            <label for="component_view">Component View</label>
            <select class="form-control" name="component_view">
                @foreach($displayViews as $view)
                <option
                    value="{{ $view }}" 
                    {{ 
                        old('component_view', $display->component_view) === $view 
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
            <label for="default_trophy_component_view">Default Trophy Component View</label>
            <select class="form-control" name="default_trophy_component_view">
                @foreach($trophyViews as $view)
                <option
                    value="{{ $view }}"
                    {{
                        old(
                            'default_trophy_component_view',
                            $display->default_trophy_component_view
                        ) === $view 
                            ? 'selected'
                            : ''
                    }}
                >{{ $view }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" name="force_trophy_default" value="1" {{$display->force_trophy_default ? 'checked' : ''}}>
            <label class="form-check-label" for="force_trophy_default">Force Default Trophy View</label>
        </div>
        <div class="form-group">
                <label for="trophies[]">Trophies</label>
                <select class="form-control" name="trophies[]" id="" multiple="">
                    @foreach($trophies as $trophy)
                    <option value="{{$trophy->id}}" {{!$display->hasTrophy($trophy) ?: 'selected'}}>{{$trophy->name}}</option>
                    @endforeach
                </select>
            </div>
        <button class="btn btn-success btn-block" type="submit">Update</button>
    </form>
</main>



@stop