@extends('backend.layouts.app')
@section('title', 'Transaction List')
@section('content')

    <div class="row">
        @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-right',
                iconColor: 'green',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                titleColor: 'blue' // Change this to the desired title color
            });

            (async () => {
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}",
                });
            })();
        </script>

        @endif

        <div class="col-md-12">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body">
                    <h2>Transaction List</h2>


                    <table id="DataAllList" class="display table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:10px">#</th>
                                <th>Customer Name</th>
                                <th>Discount</th>
                                <th>Total price</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>


                                    <td>{{ $transaction->customer_name }}</td>
                                    <td>{{ $transaction->discount }}</td>
                                    <td>{{ $transaction->total_price }}</td>

                                     <!-- Add button for Product 2 -->
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('transaction.show', $transaction->id) }}"
                                                class="btn btn-success ml-2 mr-2">View</a>

                                        </div>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>


                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->


        </div>
        <!-- /.row -->
    @endsection
