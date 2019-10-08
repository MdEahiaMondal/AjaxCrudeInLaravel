@extends('layouts.master')


@section('contents')

@endsection
<br>
<br>
<div class="container">
    <h3 align="center">Live Search in laravel Using Ajax</h3><br>
    <div class="card">
        <div class="card-header">Search Content Data </div>
        <div class="card-body">
            <input type="text" name="search" id="search" class="form-control" placeholder="Serach Data">
        </div>

        <div class="table table-responsive">
            <h3 align="center"> Total Data: <span id="total_records"></span> </h3>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Customer Phone</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </div>
</div>


@section('script')
    <script>

        $(document).ready(function () {

            // create a function to colect data and at the same time search query send
            function fetch_customer_data(query = '') {
                $.ajax({
                   url: "{{ route('live_search.action') }}",
                    method: "GET",
                    data: {query: query},
                    dataType: "JSON",
                    success: function (data) {
                        $("tbody").html(data.table_data);
                        $("#total_records").text(data.total_data);
                    }
                });
            }

            fetch_customer_data();



            // now we can search
            $(document).on('keyup', '#search', function () {
                var query = $(this).val();
                fetch_customer_data(query);
            })


        });


    </script>
@endsection
