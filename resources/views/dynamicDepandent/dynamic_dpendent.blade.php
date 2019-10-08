@extends('layouts.master')

@section('page_title')
   Dynamic dependent select firld
@endsection


@section('contents')
    <div class="container">
        <h3 align="center">Live Search in laravel Using Ajax</h3><br>
        <div class="card">
            <div class="card-header">Search Content Data </div>
            <div class="card-body">


                <div class="form-group">
                    <select name="country" id="country" class="form-control dynamic" data-dependent="state">
                        <option value="">Select Country</option>
                        @foreach($allCountry as $country)
                            <option value="{{ $country->country }}"> {{ $country->country }} </option>
                        @endforeach
                    </select>
                </div>
                <br>
                <br>


                <div class="form-group">
                    <select name="state" id="state" class="form-control dynamic" data-dependent="city">
                        <option value="">Select State</option>
                    </select>
                </div>
                @csrf
                <br>
                <br>
                <div class="form-group">
                    <select name="city" id="city" class="form-control dynamic">
                        <option value="">Select City</option>
                    </select>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(".dynamic").change(function () { // if you change select fiend in  option value it will run (dynamic class only per select field)
                if ($(this).val() !=''){
                   var selectFieldNameOrId = $(this).attr('id'); // this line take select field's name or id
                   var OpValue = $(this).val();// this line take select field's option value
                   var dependent = $(this).data('dependent');// this line take next field name that dependent in this select (data-dependent)
                    var _token = $('input[name="_token"]').val();

                    // now call ajax method
                    $.ajax({
                        url: "{{ route('dynamicdependent.fetch') }}",
                        method: "POST",
                        data: {
                            selectFieldNameOrId: selectFieldNameOrId,
                            OpValue: OpValue,
                            dependent: dependent,
                            _token: _token,
                        },
                        success: function (result) {
                            $("#"+dependent).html(result);// this line only for use stape by stape dynamic field automatic fetch data only dependent (data-dependent)
                        }
                    })

                }
            })
        })
    </script>
@endsection
