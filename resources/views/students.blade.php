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

@section('script')
<script>
    /*
    // this script take data from database
    var table1 = $("#laravel_table").DataTable({
    processing: true,
    serverSide:true,
    ajax: "",
    columns: [
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'description', name: 'description'},
    {data: 'status', "render" : function ( status, type, data, id) {
    if (status == 1){
    return '<p class="label label-success">' + 'Active' + '</p>';
    }else{
    return '<p class="label label-info">' + 'Unctive' + '</p>';
    }

    }},
    {data: 'action', name: 'action', orderable: false, searchacle:true},
    ],
    order: [[0, 'desc']]
    });*/


    // this script take data from database
    var studentTable = $("#laravel_table").DataTable({
    processing: true,
    serverSide:true,
    ajax: "{{url('all/student')}}",
    columns: [
    {data: 'id', name: 'id'},
    {data: 'avatar', "render" : function ( avatar, type, full) {
    return '<img height="50%" width="95%" src="{{ asset('Avatar') }}/'+avatar+'"/>';
    }},
    {data: 'name', name: 'name'},
    {data: 'email', name: 'email'},
    {data: 'phone', name: 'phone'},
    {data: 'religion', name: 'religion'},
    {data: 'action', name: 'action', orderable: false, searchacle:true},
    {data: 'checkbox', name: 'action', orderable: false, searchacle:true},

    ],
    order: [[0, 'desc']]
    });

    // show  form model
    function showForm() {
    save_method = 'add'; // this line for condition to update bellow
    $('input[name=_method]').val('POST'); // this line all input method POST
    $('#DataForm').modal('show'); // data form modal show
    $("#DataForm form")[0].reset();
    $("#modelTitle").text('Add User');// added new title
    $("#submitButton").text('Add User');// add new title
    $('.studentImage').attr('src','');// when i will add new item then dont need any old value in image field
    }

    var formValidation =  $("#studentForm").validate({

    rules: {
    name: {
    required: true,
    maxlength: 50
    },

    phone: {
    required: true,
    digits:true,
    minlength: 6,
    maxlength:12,
    },
    email: {
    required: true,
    maxlength: 50,
    email: true,
    },
    religion: {
    required: true,
    },

    },
    messages: {

    name: {
    required: "Please enter name",
    maxlength: "Your last name maxlength should be 50 characters long.",

    },
    phone: {
    required: "Please enter contact number",
    minlength: "The contact number should be 10 digits",
    digits: "Please enter only numbers",
    maxlength: "The contact number should be 10 digits",
    },
    email: {
    required: "Please enter valid email",
    email: "Please enter valid email",
    maxlength: "The email name should less than or equal to 50 characters",
    },

    },

    });

    // insert data with ajax
    $(function () {
    $("#DataForm form").on('submit', function (e) { // if click the submitt button action bellow
    if (!e.isDefaultPrevented()){// this line only for condition
    if(save_method == 'add'){ // if true this condition will go to insert otherwise go to update
    url= "{{ url('student') }}"
    }else{
    var id= $("#id").val();
    url = "{{url('student')}}"+ '/' + id ;
    }
    $.ajax({// start ajax action
    url: url,
    type: "POST",
    data: new FormData($("#DataForm form")[0]),// send all form data
    contentType: false,
    processData: false,
    success:function (data) {
    studentTable.ajax.reload();
    $("#DataForm").modal('hide');
    Swal.fire(
    'Good job!',
    'New Studen Added Successfully !',
    'success'
    );
    },
    error: function (data) {
    Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Something went wrong!',
    });
    }
    });
    }
    return false;
    });
    });


    // edit form show with value
    function editStudent(id) {
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $("#DataForm form")[0].reset();


    $.ajax({
    url: "{{url('student')}}"+ '/' + id + "/edit",
    type: "GET",
    dataType:"JSON",
    success: function (data) {
    $('#DataForm').modal('show');
    $("#modelTitle").text('Update User');// added new title
    $("#submitButton").text('Update');// add new title
    $("#id").val(data.id);
    $("#name").val(data.name);
    $("#phone").val(data.phone);
    $("#email").val(data.email);
    $("#religion").val(data.religion);
    $('.studentImage').attr('src',"{{asset('Avatar')}}/"+data.avatar+"");

    },
    error: function (data) {
    Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Something went wrong!',
    })
    }
    }); // end ajax
    }// end of edit section


    // now finali delete
    function deleteStudent(id) {
    save_method = "delete";
    var csrf_token = $("meta[name=csrf-token]").attr('content')// must be need for delete and use in hedear section in meta tag
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
    if (result.value) {
    $.ajax({
    url: "{{url('student')}}" + '/' +id,
    type: "POST",
    data: {
    '_method' : 'DELETE',
    '_token' : csrf_token,
    },
    success: function (data) {
    studentTable.ajax.reload();
    $("#DataForm").modal('hide');
    Swal.fire({
    position: 'top-middle',
    type: 'success',
    title: 'Item is deleted!',
    showConfirmButton: false,
    timer: 1500
    })
    },
    error: function (data) {
    Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Something went wrong!',
    })
    }

    }); // end ajax

    }
    })

    }




    $(document).ready(function () {
    // first whene the page loade then it will be hide
    $("#multiDelete").hide();

    // all item will be checked
    $(function () {
    $(".allChecked").click(function () {
    if ($(".allChecked").is(':checked')) {
    $("input[type=checkbox]").each(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
    $("#multiDelete").show('slow');
    } else {
    $("input[type=checkbox]").each(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
    $("#multiDelete").hide('slow');
    }
    });
    });

    // whene click checkBox thene show
    $(document).on('click', '#checkBox', function () {

    if ($(".student_checkbox:checked").length > 0)
    {
    $("#multiDelete").show('slow');
    }
    else
    {
    $("#multiDelete").hide('slow');
    }

    });
    });



    $(document).on('click', '#multiDelete', function (e) {
    var id = [];
    if (confirm('Are you want to delete this data?!')){
    $(".student_checkbox:checked").each(function () {
    id.push($(this).val());
    });

    if(id.length > 0){
    $.ajax({
    url: "{{route('checkbox.ItemDelete')}}",
    method: "get",
    data: {id: id},
    success: function (data) {
    $("#laravel_table").DataTable().ajax.reload();
    Swal.fire(
    'Good job!',
    'Student Deleted Successfully !',
    'success'
    );
    }
    })
    }else{
    Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Please Checked minimum one item!',
    })
    }

    }


    })

</script>
@endsection

