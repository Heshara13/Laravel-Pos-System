@extends('layout')
@section('content')
<div class = "container">
    <h3 align="center" class="mt-5">Sales</h3>
    <div class="row">
  <div class="col-md-8">
    <form class = "form-horizontal" id="frmInvoice">

    <table class="table table-bordered">
        <caption>Add Products </caption>
        <tr>
            <td>Product Code</th>
            <td>Product Name</td>
            <td>Price</td>
            <td>Qty</td>
            <td>Amount</td>
            <td>Option</td>
        </tr>

        <tr>
            <td>
                <input type="text" class="form-control" placeholder="Product ID" id="barcode" name="barcode" size = "25px" required>

            </td>
            <td>
                <input type="text" class="form-control" placeholder="Product Name" id="pname" name="pname" size = "50px" disabled>

            </td>
            <td>
                <input type="text" class="form-control pro_price" id="pro_price" size = "25px" name="pro_price" placeholder="price" >

            </td>
            <td>
                <input type="number" class="form-control pro_price" id="qty" name="qty" placeholder="qty" min="1" value="1" size="10px" required >

            </td>
            <td>
                <input type="text" class="form-control" placeholder="total_cost" id="total_cost" size = "35px" name="total_cost" >

            </td>
            <td>
                <button class="btn btn-success" type="button" onclick="addproduct()">Add</button>
            </td>

        </tr>
    </table>
    </form>
     <table class="table table-bordered" id="product_list">
        <caption>Products</caption>
        <thead>
            <tr>
                <th style="width: 40px">Remove</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>


<div class="col-sm-4">
    <div class="col s12 m6 offset-m4">

        <div class="form-group" align="left">
            <label class="form label">Total</label>
            <input type="text" class="form-control" id="total" name="total" placeholder="Total" size="30px" required="">
        </div>

        <div class="form-group" align="left">
            <label class="form label">Pay</label>
            <input type="text" class="form-control" id="pay" name="pay" placeholder="Pay" size="30px" required="">
        </div>

        <div class="form-group" align="left">
            <label class="form label">Balance</label>
            <input type="text" class="form-control" id="balance" name="balance" placeholder="Balance" size="30px" required="">
        </div>

        <div class="form-group" align="left">
            <label class="col-sm-2 control-label">Status</label>
            <select class="form-control" id="payment" name="payment" placeholder="Project Status" required>
                <option value="">Please Select</option>
                <option value="1">Cash</option>
                <option value="2">Cheque</option>
            </select>
        </div>

        <div class="card" align="right">
            <button type="button" id="save" class="btn btn-info" onclick="addProject()">Update Invoice</button>
            <button type="button" id="clear" class="btn btn-warning" onclick="reset()">Reset</button>
            <button type="button" id="clear" class="btn btn-danger" onclick="addnew()">Save</button>
        </div>
       </div>
       </form>
   </div>
</div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-dqUxzaXrdwGqAJmRnDRY+upLjxwWtqS2JUNWqL9n7YVYf9YkLJwqLxJqkzFqGqXvq5WxXcK5XyQXqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var isNew = true;
    var version_id=null;
    var current_stock=0;
    var product_no=0;

    getProductcode();

    getcategory();

    function getProductcode(){
        $("#barcode").empty();
        $("#barcode").keyup(function(each){
            var q = $("#barcode").val();
            if($('#barcode').val() == ""){
                $.alert({
                    title: "Error",
                    content: "Please select customer",
                    type: 'red',
                    autoclose: 'ok/2000'
                });
                return false;
            }
            $.ajax({
                type: "POST",
                url: "{{ route('search') }}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    barcode: $('#barcode').val()._token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    $("#pname").val(data['productname']);
                    $("#pro_price").val(data['price']);
                    },
                error: function(xhr,status,error){

                } 
            });
        });
    }
    $(function(){
        $("#pro_price,#qty").on("keydown keyup click",qty);

        function qty(){
            var sum = (
                Number($("#pro_price").val()) * Number($("#qty").val())
            );
            $("#total").val(sum);
            console.log(sum);
        }
    });
    
    $(function(){
        $("#qty, #discount").on("keydown keyup click",discount);

        function discount(){
            var sum1 = (
                Number($("#qty").val()) * Number($("#discount").val())
            );
            console.log(sum1);
        }  
    });
    
    $(function(){
        $("#total, #pay").on("keydown keyup", per);

        function per(){
            var totalamount = (
                Number($("#pay").val()) - Number($("#total").val())
            );
            $("#balance").val(totalamount);
        }  
    });

    function getcategory(){
        $.ajax({
            type: "GET",
            url: "all_vendor.php",
            dataType: "json",
            success: function(data) {
                for(var i=0;i<data.length;i++){
                    $("#vendor").append($("<option/>",{
                        value: data[i].id,
                        text: data[i].vname,
                    }));
                }
    },
    error: function(xhr,status,error){
        alert(xhr.responseText);
    }
});
}

function addproduct(){
    var product = 
    {
        barcode: $("#barcode").val(),
        pname: $("#pname").val(),
        pro_price: $("#pro_price").val(),
        qty: $("#qty").val(),
        total_cost: $("#total_cost").val(),
        button: '<button type="button" class="btn btn-warning btn-xs")">Delete</button>'
    };
    addRow(product);
    $('#frmInvoice')[0].reset();
    
    }

            
    
    
    