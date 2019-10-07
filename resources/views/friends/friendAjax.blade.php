@extends('layouts.master')
@section('contents')
    <div class="container">
        <h1>Laravel 5.8 Ajax CRUD tutorial using Datatable</h1>
        <a class="btn btn-success pull-right mb-4" href="javascript:void(0)" id="createNewFriend"> Create New Product</a>
        <table class="table table-bordered data-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Details</th>
                <th width="100">Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="friendAjaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="friendForm" name="friendForm" class="form-horizontal">
                        <input type="hidden" name="friend_id" id="friend_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Details</label>
                            <div class="col-sm-12">
                                <textarea id="detail" name="detail" required="" placeholder="Enter Details" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                            <button type="submit" class="btn btn-primary" id="UpdateBtn"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {

            // it is only for ajax call for laravel {{--@csrf --}}token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // start data read
                var table = $(".data-table").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('friends.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'name', name: 'name'},
                        {data: 'detail', name: 'detail'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            // end data read


            // start create new friend
            $("#createNewFriend").click(function () {
                $("#saveBtn").text("create-Friend");
                $("#saveBtn").show();
                $("#UpdateBtn").hide();
                $('#friend_id').val('');
                $('#friendForm').trigger("reset");
                $('#modelHeading').html("Create New Friend");
                $('#friendAjaxModel').modal('show');
            })

            // now store the data from form
            $("#saveBtn").click(function (e) {
                e.preventDefault();
                $(this).text('sending...');

                $.ajax({
                    url: "{{ route('friends.store') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: $("#friendForm").serialize(),
                    success: function (data) {
                        $('#friendForm').trigger("reset");
                        $('#friendAjaxModel').modal('hide');
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                })

            })
            // end create new friend

            // start edit new friend

            $("table").on('click', '.editFriend', function () {

                $("#UpdateBtn").text("Update-Friend");
                $("#UpdateBtn").show();
                $("#saveBtn").hide();
                $('#modelHeading').html("Edit New Friend");
                $('#friendAjaxModel').modal('show');

                // data get from per row
                var friend_id = $(this).attr('data_id');
                var name =  $(this).parent().parent().find('td').eq(1).text();
                var detail =  $(this).parent().parent().find('td').eq(2).text();

                $('#friend_id').val(friend_id);
                $('input[name="name"]').val(name);
                $('textarea[name="detail"]').val(detail);
            });

            function getInputData(){
                var id = $('input[name="id"]').val();
                var name = $('input[name="name"]').val();
                var detail = $('textarea[name="detail"]').val();


                return {id: id, name: name, detail: detail}
            }



            // whene click the savebutton then update
            $("#UpdateBtn").click(function (e) {
                var id = $("#friend_id").val();
                var url = '{{ route("friends.update", ":id") }}';
                url = url.replace(':id',id);
                e.preventDefault();
                $(this).html('Sending...');


                $.ajax({
                    url: url,
                    type: "PUT",
                    dataType: "JSON",
                    data: getInputData(),
                    success: function (data) {
                        console.log(data);
                        $('#friendForm').trigger("reset");
                        $('#friendAjaxModel').modal('hide');
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#UpdateBtn').html('error');
                    }
                })

            })

            // end edit new friend



            // start delete friend
                $('table').on('click', '.deleteFriend', function () {
                   var delete_id = $(this).attr('data_id');
                   var url = "{{ route('friends.destroy', ':id') }}";
                   url = url.replace(':id',delete_id);

                   $.ajax({
                       url:url,
                       type: "DELETE",
                       data: {id: delete_id},
                       success: function (data) {
                           console.log(data);
                           table.draw();
                       }
                   })
                })
            // end delete  friend






        })
    </script>


@endsection
