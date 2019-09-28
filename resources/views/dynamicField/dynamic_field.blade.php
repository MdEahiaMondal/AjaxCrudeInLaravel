<!DOCTYPE html>
<html>
<head>
    <title>Laravel 5.8 Ajax CRUD tutorial using Datatable - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
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

<script>
    $(document).ready(function () {
        var count = 1;

        // add row that you want to
        $("#add").click(function () {
            count ++;
            $("tbody").append('<tr id="row'+count+'" class="dynamic_added">'+
                '<td><input type="text" name="first_name[]" class="form-control" id="first_name"></td>'+
                '<td><input type="text" name="last_name[]" class="form-control" id="last_name"></td>'+
                '<td><button type="button" name="remove" id="'+count+'" class="btn btn-danger remove">Remove</button></td>'+
                '</tr>')
        });

        // remove by id whene yoy click the remove button
        $(document).on('click', '.remove', function () {
            var remove_id = $(this).attr('id');
            $("#row"+remove_id+"").remove();
        });

        $("#dynamicForm").on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{route('dynamic_field.insert')}}",
                method: "POST",
                data: $("#dynamicForm").serialize(),
                dataType: "json",
                success: function (data) {
                        console.log(data);
                    if(data.error){
                        var error_html = '';
                        for (var count = 0; count < data.error.length; count++ ){
                            error_html += "<p>"+data.error[count]+"</p>";
                        }
                        $("#result").html('<div class="alert alert-danger">'+error_html+'</div>')
                    }else{
                        $(".dynamic_added").remove();
                        $("#dynamicForm")[0].reset();
                        $("#result").html('<div class="alert alert-success"> '+data.success+'</div>')
                    }
                    $("#save").attr('disabled', false)
                }

            });
        });


    });
</script>


{{--<script>
    $(document).ready(function () {
        var count = 1;
        dynamic_field(count);
        function dynamic_field(number) {
            var html = "<tr>";
            html += "<td><input type='text' name='first_name[]' class='form-control'></td>";
            html += "<td><input type='text' name='last_name[]' class='form-control'></td>";
            if (number > 1){
                html += "<td><button type='button' name='remove' id='remove' class='btn btn-danger'>Remove</button></td> </tr>";
                $('tbody').append(html);
            } else{
                html += "<td><button type='button' name='add' id='add' class='btn btn-info'>Add</button></td><tr>";
                $('tbody').html(html)
            }
        }

        $("#add").click(function () {
            count++;
           dynamic_field(count)
        });

       $(document).on('click', '#remove', function () {
            count--;
            dynamic_field(count)
        });
        
        $("#dynamicForm").on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{route('dynamic-field.insert')}}",
                method: "post",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function () {
                    $("#save").attr('disabled', 'disabled')
                },
                success: function (data) {
                    if(data.error){
                        var error_html = '';
                        for (var count = 0; count < data.error.length; count++ ){
                            error_html += "<p>"+data.error[count]+"</p>";
                        }
                        $("#result").html('<div class="alert alert-danger">'+error_html+'</div>')
                    }else{
                        dynamic_field(1);
                        $("#result").html('<div class="alert alert-success"> '+data.success+'</div>')
                    }
                    $("#save").attr('disabled', false)
                }
            });
        })



    });
</script><div class="table-responsive">
        <form action="" method="post" id="dynamicForm">
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

            </tbody>
        </table>
            <input type="submit" name="save" id="save" class="btn btn-primary" value="Save">
        </form>
    </div>--}}


</body>
</html>