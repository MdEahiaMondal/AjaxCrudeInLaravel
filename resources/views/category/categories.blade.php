@extends('layouts.master')

@section('page_title')
    Categories
@endsection

@section('contents')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Categories</div>
                    <a href="{{ route('categories.create') }}" class="btn btn-group-sm btn-success">Create</a>
                    <div class="card-body">


                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Si</th>
                                    <th>Category Name</th>
                                    <th>parent Category</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($Categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                        @if($category->parent_id == null)
                                            <td>Primary</td>
                                            @else
                                        <td>{{ $category->subCategory->name }}</td>
                                        @endif
                                    <td>{{ $category->created_at }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>



                       {{-- @foreach($parentCategories as $category)
                            <ul>
                                <li>{{$category->name}}</li>
                            </ul>
                        @endforeach--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




