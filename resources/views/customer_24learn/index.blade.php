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

@section('script')
    {{--statrt  customer table--}}
    <script>
        var getDataUrl = "{{ route('get.customer.data') }}";
        var modal = $("#CustomerModal");
        var createtButton = $("#createtButton");
        var updatButton = $("#updatButton");
        var modelTitle = $("#modelTitle");

        $.ajaxSetup({
            headers: {'X-CSRF-Token': '{{ csrf_token() }}'}
        });

        /*start get data from database by jquery*/
        function getRecords() {
            $.get(getDataUrl)
                .success(function (data) {
                    var html = "";
                    data.forEach(function (row) {
                        html += "<tr>";
                        html += "<td>" + row.id + "</td>";
                        html += "<td> <img src='{{asset('images/customer/'."row.avatar")}}' alt='no pic'> </td>";
                        html += "<td>" + row.name + "</td>";
                        html += "<td>" + row.email +  "</td>";
                        html += "<td>" + row.phone + "</td>";
                        html += "<td>";
                        html += "<button type='button' class='btn btn-xs btn-warning btnEdit' title='Edit Recode'>Edit</button>";
                        html += "<button type='button' class='btn btn-xs btn-danger btnDelete' data-id='" + row.id + "' title='Delete Recode'>Delete</button>";
                        html += "</td> </tr>";

                    });
                    $('tbody').html(html)
                })
        }

        getRecords(); // for view the records

        /*end get data from database by jquery*/


        /*start  for create*/
        function reset() {
            modal.find('input').each(function () {
                $(this).val(null);
            })
        }
        function getInputs() {
            var id = $('input[name="id"]').val();
            var name = $('input[name="name"]').val();
            var email = $('input[name="email"]').val();
            var phone = $('input[name="phone"]').val();
            var avatar = $('input[name="avatar"]').val();

            return {id: id, name: name, email: email, phone: phone, avatar: avatar};
        }

        function create() {
            modal.find(modelTitle).text('New Customer');
            reset();
            modal.modal('show');
            createtButton.show();
            updatButton.hide();
        }

        function store() {
            if (!confirm('Are you sure?')) return;
            $.ajax({
                method: "POST",
                url: "{{ route('customer.store') }}",
                dataType: "JSON",
                data: getInputs(),// our created
                success: function (data) {
                    console.log(data);
                    if(data.success){
                        toastr.success(data.message);
                    }
                    reset();// our created
                    modal.modal('hide');
                    getRecords();// our created

                },
                error:function (data) {
                    if (data.error){
                        var error = JSON.parse(data.responseText);
                        var error_lop  = error.errors;

                        for (let elemete in error_lop) {
                            var itemError =  error_lop[elemete][0];
                            toastr.error(itemError);
                        }

                    }
                }
            });
        }
        /*end  for create*/


        /* start for edit*/
        $('table').on('click', '.btnEdit', function () {
            modal.find(modelTitle).text('Edit Customer');
            modal.modal('show');
            createtButton.hide();
            updatButton.show();

            var id = $(this).parent().parent().find('td').eq(0).text();
            var avatar = $(this).parent().parent().find('td').eq(1).text();
            var name = $(this).parent().parent().find('td').eq(2).text();
            var email = $(this).parent().parent().find('td').eq(3).text();
            var phone = $(this).parent().parent().find('td').eq(4).text();

            $('input[name="id"]').val(id);
            $('input[name="name"]').val(name);
            $('input[name="email"]').val(email);
            $('input[name="phone"]').val(phone);

        });

        function update(){
            if(!confirm('Are you sure?')) return;
            $.ajax({
                url: "{{route('customer.update')}}",
                method: "post",
                dataType: "JSON",
                data: getInputs(),
                success: function (data) {
                    toastr.success(data.message);
                    reset();// our created
                    modal.modal('hide');
                    getRecords();// our created
                }
            })
        }

        /* end for edit*/



        /* start for delete*/
        $('table').on('click', '.btnDelete', function () {
            if (!confirm('Are your sure ?')) return;
            var id  = $(this).parent().parent().find('td').eq(0).text();
            $.ajax({
                url: "{{route('customer.delete')}}",
                method: "POST",
                data:{id: id},
                success: function (data) {
                    toastr.warning(data.message);
                    getRecords();// our created
                }
            });
        })
        /* end for delete*/

    </script>
@endsection
