@extends('layouts.master')

@section('page_title')
    Dynamic dependent select firld
@endsection


@section('contents')
    <div class="container">
        <h3 align="center">Dynamic select field in laravel Using Ajax</h3><br>
        <div class="card">
            <div class="card-header">Dynamic select field </div>
            <div class="card-body">
               {{-- {{ Form::open() }}--}}

                @csrf
                    <div class="form-group">
                        <label>Your Country</label>
                        <select class="form-control dynamicField" name="countries" id="countries">
                            <option value="" disable="true" selected="true">=== Select Country ===</option>
                            @foreach($allCountry as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>


                <div class="form-group">
                    <label>Your Divisions</label>
                    <select class="form-control dynamicField" name="divisions" id="divisions">
                        <option value="" disable="true" selected="true">=== Select Division ===</option>
                    </select>
                </div>

                <div class="form-group">
                    <label> Your Districtes </label>
                    <select class="form-control dynamicField" name="districtes" id="districtes">
                        <option value="" disable="true" selected="true">=== Select District ===</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Your Upazilas</label>
                    <select class="form-control dynamicField" name="upazilas" id="upazilas">
                        <option value="" disable="true" selected="true">=== Select Upazila ===</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Your Union</label>
                    <select class="form-control dynamicField" name="unions" id="unions">
                        <option value="" disable="true" selected="true">=== Select Union ===</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Your Village</label>
                    <select class="form-control dynamicField" name="villages" id="villages">
                        <option value="" disable="true" selected="true">=== Select Village ===</option>
                    </select>
                </div>

                {{--{{ Form::close() }}--}}
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>

        $(document).ready(function () {
            $(".dynamicField").change(function () { // al select field name
                if($(this).val() != ''){// if there is value true or false
                   var options_id = $(this).val();// option value's id
                    var _token = $('input[name="_token"]').val();
                    var selectFieldNameOrId = $(this).attr('id');// select field name or id
                    $.ajax({
                       url: "{{ route('select.fieldItem') }}",
                        method: "POST",
                        data: {
                            options_id: options_id,
                            selectFieldNameOrId: selectFieldNameOrId,
                            _token: _token,
                        },
                        success: function (result) {

                           if(selectFieldNameOrId == 'countries'){ /*some condition*/
                               $("#divisions").append(result)
                           }

                           if(selectFieldNameOrId == 'divisions'){
                               $("#districtes").append(result)
                           }

                           if(selectFieldNameOrId == 'districtes'){
                               $("#upazilas").append(result)
                           }

                           if(selectFieldNameOrId == 'upazilas'){
                               $("#unions").append(result)
                           }

                           if(selectFieldNameOrId == 'unions'){
                               $("#villages").append(result)
                           }


                        }
                    });
                }
            })
        })

    </script>
@endsection
