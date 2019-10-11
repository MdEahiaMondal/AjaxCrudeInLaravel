@extends('layouts.master')
@section('contents')
    <div class="container">
        <h1>Laravel 5.8 Ajax CRUD tutorial using Datatable For Profiles</h1>
        <a class="btn btn-success pull-right mb-4"  id="createProfile"> Create New</a>
        <table class="table table-bordered data-table text-center" id="profileTable">
            <thead>
                <tr>
                    <th>SI</th>
                    <th>Image</th>
                    <th>first_name</th>
                    <th>last_name</th>
                    <th width="100">action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    @include('profileAjaxCrude.modal')

@endsection

@section('script')
   <script>

       $.ajaxSetup({
           headers: {'X-CSRF-Token': '{{ csrf_token() }}'}
       });

        var sliderUrl = "{{ route('profile.index') }}";
        var profileTable = $("#profileTable").DataTable({
            processing: true,
            serverSide: true,
            ajax:sliderUrl,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {
                    data: 'image',
                    name: 'image',
                    render: function (data, type, full, meta) {
                        return '<img class="img-thumbnail" width="80" src="{{ asset('images/profiles/') }}/'+data+'"/>';
                    },
                    orderable: false
                },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]

        });

        $("#createProfile").click(function () {
            $("#imageAjaxModel").modal('show')
        });

        $("#ProfileForm").on('submit', function (e) {
            e.preventDefault();

            if($("#action_button").val() == 'Add'){
                $.ajax({
                   url: "{{ route('profile_ajax_crude.store') }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: "JSON",
                    contentType: false, // it has been use one data send to server
                    cache: false, // it will unable to cache requested pages
                    processData: false, //
                    success: function (data) {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++){
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }

                        if (data.success){
                            html += '<div class="alert alert-success">'+ data.success +'</div>';
                            $("#ProfileForm")[0].reset();
                            $('#profileTable').DataTable().ajax.reload();
                            $("#imageAjaxModel").modal('hide');
                        }
                        $("#form_result").html(html);
                    }

                });
            }
        });


       // start edit the profile


       // whene click the edit button show modal with each data of row
       $(document).on('click','.edit', function () { // if click the edit (class of edit button)
           var id = $(this).attr('id');// take this id
           $("#form_result").html(''); // and empty the result message

           $.ajax({
               url: "profile/"+id+"/edit",// go to this url
               dataType: "JSON",
               success: function (result) {// come to result (you cane choose any type of character)

                   // and append the data in input field
                  $("#first_name").val(result.data.first_name);
                   $("#last_name").val(result.data.last_name);
                   $("#store_image").html('<img class="img-thumbnail" width="80" src="{{ asset('images/profiles/') }}/'+result.data.image+'"/>');
                   $("#store_image").append('<input type="hidden" name="profile_image" value="'+result.data.image+'" />');
                   $("#row_id").val(result.data.id);
                   $("#modelHeading").text('Edit Profile');
                   $("#action_button").text('Update Profile');
                   $("#action_button").val('edit');
                   $("#imageAjaxModel").modal('show');
               }
           })

       })



    </script>

@endsection
