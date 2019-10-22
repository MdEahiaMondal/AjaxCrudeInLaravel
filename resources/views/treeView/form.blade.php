@extends('layouts.master')

@section('page_title')
    Categories
@endsection

@section('contents')

    <div class="container mt-5">
        <div class="row justify-content-center">

            <div class="col-4">
               @php
                   $categories =  App\Category::where('parent_id', null) ->get();
               @endphp

                // View
                <ul>
                    @foreach($categories as $category)
                        <li>{{ $category->name }}
                            @if(count( $category->subcategory) > 0 )
                                <ul>
                                    @foreach($category->subcategory as $subcategory)
                                        <li>{{ $subcategory->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>


            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Categories</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Category</label>
                                <input type="text" class="form-control" name="category" id="category" placeholder="Enter category name">
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Parent Category</label>
                                <select class="form-control" id="parent_id">
                                    <option>Select Parent</option>
                                    @foreach($mainCategory as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
