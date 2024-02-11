@extends('backend.layouts.app')
@section('title', 'Point of Sale (POS) | Home')
@section('content')
    <div class="row">
        <div class="col-lg-6">


            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Products List</h3>

                </div>
                <div class="card-body table-responsive p-0">

                    <table id="DataAllList" class="display table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:10px">#</th>
                                <th>Name</th>
                                <th>Brand Name</th>
                                <th>Cost price</th>
                                <th>Sell Price</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr data-id="{{ $product->id }}">
                                    <td>{{ $loop->iteration }}</td>


                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->brand_name }}</td>
                                    <td>{{ $product->cost_price }}</td>
                                    <td>{{ $product->sell_price }}</td>
                                    <td><button class="btn btn-success ml-2 mr-2"
                                            onclick="addToSelected('{{ $product->id }}','{{ $product->name }}', {{ $product->sell_price }})">Add</button>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">

            <div class="card" style="min-height: 400px">
                <div class="card-header border-0">
                    <h3 class="card-title">Point of Sale (POS) </h3>

                </div>
                <div class="card-body" id="selectedProductsCard">
                    <div class="form-group">
                        <label for="CustomerName">Customer Name</label>
                        <select id="CustomerName" class="form-control select2" style="width: 100%;" required>
                            <option value="" disabled selected>Please Select</option>
                            <option value="John Doe">John Doe</option>
                            <option value="Jane Smith">Jane Smith</option>
                            <option value="Michael Johnson">Michael Johnson</option>
                            <option value="Emily Davis">Emily Davis</option>
                            <option value="William Brown">William Brown</option>
                            <option value="Olivia Wilson">Olivia Wilson</option>
                            <option value="James Taylor">James Taylor</option>
                        </select>
                    </div>


                    <!-- Table to display selected products -->
                    <table id="selectedProductsTable" class="display table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th style="width:10px">Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="selectedProducts"></tbody>
                    </table>

                    <div class="form-group mt-2">
                        <div class="row align-items-center">
                            <div class="col-lg-7"> </div>

                            <div class="col-lg-1 ">
                                <label  for="discountInput">Discount</label>
                            </div>

                            <div class="col-lg-4">

                                <input type="number" class="form-control" id="discountInput" placeholder="Flat Discount"
                                    value="0">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-warning text-xl">
                            <i class="ion ion-ios-cart-outline"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                            <span class="font-weight-bold">
                                <i class="ion ion-android-arrow-up text-warning"></i> Total Price: $<span
                                    id="totalPrice">0.00</span>
                            </span>
                        </p>
                    </div>
                    <!-- Sell button -->
                    <button class="btn btn-primary" id="sellButton" onclick="sellProducts()"> Make Sell</button>
                </div>







            </div>
        </div>
    </div>
    <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->

    <script src="{{asset('assets/backend/js/pos_sale.js')}}"></script>

@endsection
