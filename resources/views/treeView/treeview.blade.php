@extends('layouts.master')

@section('page_title')
    Categories
@endsection

@section('contents')
    <div class="container">
      {!! $tree !!}
    </div>
@endsection




