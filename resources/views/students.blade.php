<!DOCTYPE html>
<html>
<head>
    <title>Laravel 5.8 Ajax CRUD tutorial using Datatable - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1>Laravel 5.8 Ajax CRUD tutorial using Datatable</h1>
    <br>
    <a onclick="showForm()"  class="btn btn-success pull-right"> Create New Product</a>
    <br><br>
    <table class="studentTable table table-bordered data-table" id="laravel_table">
        <thead>
        <tr>
            <th>No</th>
            <th>Avatar</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Religion</th>>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@include('form')




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>

    // this script take data from database
    var studentTable = $("#laravel_table").DataTable({
        processing: true,
        serverSide:true,
        ajax: "{{url('all/student')}}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'avatar', name: 'avatar'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'religion', name: 'religion'},
            {data: 'action', name: 'action', orderable: false, searchacle:true},
        ],
        order: [[0, 'desc']]
    });

    // create  form

    function showForm() {
        save_method = 'add';
        $('input[name=_method]').val('POST');
        $('#DataForm').modal('show');
        $("#DataForm form")[0].reset();
        $("#modelTitle").text('Add User');
        $("#submitButton").text('Add User');
    }

    // insert data with ajax
    $(function () {
        $("#DataForm form").on('submit', function (e) {
            if (!e.isDefaultPrevented()){
                if(save_method == 'add'){
                    url= "{{ url('student') }}"
                }else{
                    var id= $("#id").val();
                    url = "{{url('student')}}"+ '/' + id ;
                }
                $.ajax({
                    url :url,
                    type: "POST",
                    data: new FormData($("#DataForm form")[0]),
                    contentType: false,
                    processData: false,
                    success:function (data) {
                        studentTable.ajax.reload();
                        $("#DataForm").modal('hide');
                        Swal.fire(
                            'Good job!',
                            'You clicked the button!',
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


</script>

</body>
</html>