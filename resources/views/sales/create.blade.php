@extends('layout')
@section('content')
<div class = "container">
    <h3 align="center" class="mt-5">Sales</h3>
    <div class="row">
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
                <input type="text" class="form-control" placeholder="productname" id="pname" name="pname" size = "50px" disabled>

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
    

            
    
    
    