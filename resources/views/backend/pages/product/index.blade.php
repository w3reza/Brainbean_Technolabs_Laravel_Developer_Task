@extends('backend.layouts.app')
@section('title', 'Product List')
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
                    <a href="{{ route('product.create') }}">
                        <button type="button" class="btn btn-outline-primary mb-2"><i class="fa fa-edit"></i> Add
                            Product</button>
                    </a>

                    <h2>Product List</h2>


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
                                <tr>
                                    <td>{{ $loop->iteration }}</td>


                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->brand_name }}</td>
                                    <td>{{ $product->cost_price }}</td>
                                    <td>{{$product->sell_price}}</td>
                                     <!-- Add button for Product 2 -->
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('product.edit', $product->id) }}"
                                                class="btn btn-success ml-2 mr-2">Edit</a>
                                            <form id="delete-form" action="{{ route('product.destroy', $product->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger ml-auto"
                                                    onclick="confirmation(event)">Delete</button>
                                            </form>
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
