@extends('platform::dashboard')

@section('title','Title')
@section('description', 'Description')

@section('content')
    <div class="wrapper-md">
        <div data-controller="hello">
            <input data-target="hello.name" type="text">

            <button data-action="click->hello#greet">
                Greet
            </button>

            <span data-target="hello.output"></span>
        </div>
    </div>
@stop