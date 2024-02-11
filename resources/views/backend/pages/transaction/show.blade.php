@extends('backend.layouts.app')
@section('title', 'Invoice Page')
@section('content')

    <div class="row">


        <div class="col-md-12">


            <div class="card">

                <!-- /.card-header -->
                <div class="card-body">


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-globe"></i> Brainbean Technolabs Private Limited.

                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    From
                    <address>
                      <strong>Brainbean Technolabs Private Limited.</strong><br>
                      Anand, Gujarat<br>
                      Phone: (555) 539-1037

                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    To
                    <address>
                      <strong>{{$transaction->customer_name}}</strong><br>
                      Sample, Suite 600<br>
                      Phone: (555) 539-1037<br>
                      Email: demo@example.com
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">


                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                          <th>Product Name</th>
                          <th>Qty</th>
                        <th>Subtotal</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($transaction->transactionProducts as $product)
                            <tr>
                                <td>{{ $product->product->name}}</td>
                                <td>{{$product->qty}}</td>
                                <td>{{$product->sell_price}}</td>
                            </tr>

                        @endforeach



                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-6">

                  </div>
                  <!-- /.col -->
                  <div class="col-6">


                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:35%">Discount:</th>
                          <td>{{$transaction->discount}}</td>
                        </tr>

                        <tr>
                          <th>Total:</th>
                          <td>{{$transaction->total_price}}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">
                    <a href="#" rel="noopener" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Pay

                    </button>
                    <a href="{{route('transaction.index')}}" rel="noopener" target="_self" class="btn btn-primary float-right" style="margin-right: 5px;">
                      <i class="fas fa-download"></i> Back Transaction
                    </a>

                  </div>
                </div>
              </div>
              <!-- /.invoice -->




                    </table>


                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->


        </div>
        <!-- /.row -->
    @endsection
