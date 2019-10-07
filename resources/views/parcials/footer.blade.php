
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>





{{--Preview Image Before Upload Using JavaScript--}}
<script type='text/javascript'>
    function preview_image(event)
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>


{{--  start dynamic fields--}}
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
                url: "{{ route('dynamic_field.insert') }}",
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


@yield('script')
</body>
</html>
