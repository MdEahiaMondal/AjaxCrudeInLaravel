@extends('layouts.master')

@section('page_title')
    Dynamic dependent select firld
@endsection


@section('contents')
    <div class="container">
        <h3 align="center">Create Dynamic Input field With input value</h3><br>
        <div class="card">
            <div class="card-body">

                <div id="divMain">
                    <div class="form-group">
                        <label for="">Create input field</label>
                        <input type="text" id="getTextRecode">
                        <input type="button" value="Cretae" id="btnNoOfRec">
                    </div>
                </div>
                <br>

                <div id="takeDynamic_Field">

                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            load();
        });

        function load() {
            $("#btnNoOfRec").click(function () {
                var getRecode = $("#getTextRecode").val();

                if(getRecode > 0){
                    createControll(getRecode)
                }
            });

            function createControll(getRecode) {
                var tbl = '<table class="table">\n' +
                    '        <thead>\n' +
                    '        <tr>\n' +
                    '            <th scope="col">Name</th>\n' +
                    '            <th scope="col">Email</th>\n' +
                    '            <th scope="col">Password</th>\n' +
                    '            <th scope="col">Age</th>\n' +
                    '        </tr>\n' +
                    '        </thead>';

                for (i = 1; i <=getRecode; i++){
                    tbl += '<tbody>\n' +
                        '        <tr>\n' +
                        '            <th scope="row"><input type="text" name="name[]" id="name"></th>\n' +
                        '            <td><input type="email" name="email" id="email[]"></td>\n' +
                        '            <td><input type="password" name="password[]" id="password"></td>\n' +
                        '            <td><input type="text" name="age[]" id="age"></td>\n' +
                        '        </tr>'
                }

                tbl += '</tbody>\n' +
                    '    </table>'

                $("#takeDynamic_Field").html(tbl);

            }


        }

    </script>


@endsection
