@extends('layouts.master')
@section('page_title')
    Dynamic Fields
@endsection
@section('contents')

<div class="container">
    <h2>Laravel 5.8 Ajax Dynamic Fields Add using Datatable by</h2>
    <br>
    <br><br>
    <div class="table-responsive">
        <form  method="post" id="dynamicForm">
            @csrf
            <span id="result"></span>

        <table class="table table-bordered table-striped"  id="dynamic_table">
            <thead>
            <tr>
                <th width="35">First Name</th>
                <th width="35">Last Name</th>
                <th width="30">Action</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td><input type="text" name="first_name[]" class="form-control" id="first_name"></td>
                <td><input type="text" name="last_name[]" class="form-control" id="last_name"></td>
                <td><button type="button" class="add btn btn-success" id="add">Add</button></td>
            </tr>

            </tbody>
        </table>
            <input type="submit" name="save" id="save" class="btn btn-primary" value="Save">
        </form>
    </div>
</div>

@endsection