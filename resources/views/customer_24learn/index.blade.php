@extends('layouts.master')
@section('page_title')
    All Customers
@endsection
@section('contents')
    <div class="container mt-5">
        <h2>Laravel 5.8 Jquery Ajax CRUD tutorial</h2>
        <br>
        <a onclick="create()"  class="btn btn-success pull-right"> Add New </a>
        <br><br>
        <table class="customerTable table table-bordered data-table text-center">
            <thead>
            <tr>
                <th>No</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            {{--data come by ajax jquery--}}
            </tbody>
        </table>
    </div>


    {{--// modal here--}}

    <div class="modal fade" id="CustomerModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitle"></h4>
                </div>
                <p id="result"></p>
                <div class="modal-body">
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="religion" class="col-sm-2 control-label">Avatar</label>
                            <div class="col-sm-6">
                                <input type="file" name="avatar" id="avatar" onchange="preview_image(event)" >
                            </div>

                            <div class="col-sm-6">
                                <img width="100" {{--src="{{base_path('public/Avatar/')}}"--}} id="output_image" class="studentImage" alt="image">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" data-dismiss="modal" id="cancleButton" value="create">Cancle</button>
                            <button type="submit" class="btn btn-primary" onclick="store()" id="createtButton">Create</button>
                            <button type="submit" class="btn btn-primary" onclick="update()" id="updatButton" >Update</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    {{--// modal here--}}




@endsection


