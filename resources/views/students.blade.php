@extends('layouts.master')
@section('page_title')
    All Student
@endsection
    @section('contents')
        <div class="container">
            <h2>Laravel 5.8 Ajax CRUD tutorial using Datatable by <h1>Md.Eahia Khan</h1></h2>
            <br>
            <a onclick="showForm()"  class="btn btn-success pull-right"> Create New Product</a>
            <br><br>
            <table class="studentTable table table-bordered data-table text-center"  id="laravel_table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Religion</th>
                    <th width="100">Action</th>
                    <th width="100"><button type="button" name="multiDelete" id="multiDelete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                        <label for="allChecked" class="control-label"> All </label> <input type="checkbox" name="allSelect" class="allChecked"> </th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        @include('form')
    @endsection


