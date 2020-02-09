@extends('layouts.master')
@section('page_title')
    Dynamic Fields
@endsection
@section('contents')

    <div class="container">
        <div class="row clearfix mt-5">
            <div class="col-md-12">
                <table class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                    <tr>
                        <th class="text-center"> # </th>
                        <th class="text-center"> Product </th>
                        <th class="text-center"> Qty </th>
                        <th class="text-center"> Price </th>
                        <th class="text-center"> Total </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr id='addr0'>
                        <td>1</td>
                        <td>
                            <select class="form-control product" name='product[]' onChange="option_checker(this);">
                                @foreach($invoices as $inv)
                                    <option value="{{ $inv->id }}">{{ $inv->product_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                        <td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
                        <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
                    </tr>
                    <tr id='addr1'></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <button id="add_row" class="btn btn-default pull-left">Add Row</button>
                <button id='delete_row' class="pull-right btn btn-default">Delete Row</button>
            </div>
        </div>
        <div class="row clearfix" style="margin-top:20px">
            <div class="pull-right col-md-4">
                <table class="table table-bordered table-hover" id="tab_logic_total">
                    <tbody>
                    <tr>
                        <th class="text-center">Sub Total</th>
                        <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
                    </tr>
                    <tr>
                        <th class="text-center">Tax</th>
                        <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                                <input type="number" class="form-control" id="tax" placeholder="0">
                                <div class="input-group-addon">%</div>
                            </div></td>
                    </tr>
                    <tr>
                        <th class="text-center">Tax Amount</th>
                        <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
                    </tr>
                    <tr>
                        <th class="text-center">Grand Total</th>
                        <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>


        $(document).ready(function () {
            var i = 1;
          $("#add_row").click(function () {
              b = i -1;
            $("#addr" + i).html($("#addr" + b).html());
            $("#tab_logic").append('<tr id="addr'+(i+1)+'"></tr>');
              i++;
          });

          $("#delete_row").click(function () {
                if (i > 1)
                {
                    $("#addr" + (i-1)).html('');
                    i--;
                }
              calc()
          });

            $('#tax').on('keyup change',function(){
                calc_total();
            });

          $('.product').on('change', function () {
              option_checker(this)
          });

            $("#tab_logic tbody").on('keyup change', function () {
                calc()
            })

        });



        function calc()
        {
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();

                var qty = $(this).find('.qty').val();
                var price = $(this).find('.price').val();
                $(this).find('.total').val(qty*price);

                calc_total();
            });
        }



        function calc_total()
        {
            total=0;
            $('.total').each(function() {
                total += parseInt($(this).val());
            });
            $('#sub_total').val(total.toFixed(2));
            tax_sum=total/100*$('#tax').val();
            $('#tax_amount').val(tax_sum.toFixed(2));
            $('#total_amount').val((tax_sum+total).toFixed(2));
        }

        // check duplicated item not aalow
        function option_checker(element) {
            var nowOptionId = $(element).val();
            var s = 0;
            $("#tab_logic tbody tr select").each(function (index, element) {
                var oldselected = $(this).val();
                if (nowOptionId == oldselected)
                {
                    s +=1;
                }
            });
            if (s > 1)
            {
                alert(nowOptionId+' as been added already try new..')
            }
        }




    </script>

@endsection
