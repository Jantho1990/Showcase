@extends('showcase::app.layouts.app') 
@section('content')
<main class="col-md-6 col-md-offset-2">
    <h1>All Displays</h1>
    @foreach($displays as $display)
    <div class="showcase-display-container">
        <div class="showcase-display-admin">
            <div class="showcase-display-admin-left">
                <span>{{ $display->name }}</span>
            </div>
            <div class="showcase-display-admin-right">
                <a href="/displays/{{$display->id}}/" class="btn btn-sm btn-info">View</a>
                <a href="/displays/{{$display->id}}/edit" class="btn btn-sm btn-warning">Edit</a>
                <form action="/displays/{{$display->id}}" method="post">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
        @showcase($display)
    </div>
    @endforeach
</main>

@stop