@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- breadcrumb-->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li aria-current="page" class="breadcrumb-item active">Checkout - Order review</li>
                    </ol>
                </nav>
            </div>
            <div id="checkout" class="col-lg-9">
                <div class="box">
                    <form method="get" action="{{ route('checkout') }}">
                        <h1>Checkout - Order review</h1>
                        <div class="nav flex-column flex-sm-row nav-pills"><a href="checkout1.html"
                                class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-map-marker"> </i>Address</a><a
                                href="checkout2.html" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-truck">
                                </i>Delivery Method</a><a href="checkout3.html"
                                class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-money"> </i>Payment
                                Method</a><a href="#" class="nav-link flex-sm-fill text-sm-center active"> <i
                                    class="fa fa-eye"> </i>Order Review</a></div>
                        <div class="content">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($selectedItems as $item)
                                            <tr>
                                                <td class="text-center" colspan="2">
                                                    <img width="120px" height="120px"
                                                        src="{{ URL::asset('storage/image/' . $item->book->image) }}" />
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->amount }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->price }}
                                                </td>
                                                <td class="text-center" id="total_{{ $item->id }}">
                                                    {{ $item->price * $item->amount }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th>${{ $total }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.table-responsive-->
                        </div>
                        <!-- /.content-->
                        <div class="box-footer d-flex justify-content-between"><a href="{{ route('checkout') }}"
                                class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Back to payment
                                method</a>
                            <button type="submit" class="btn btn-primary">Place an order<i
                                    class="fa fa-chevron-right"></i></button>
                        </div>
                    </form>
                </div>
                <!-- /.box-->
            </div>
            <!-- /.col-lg-9-->
            <div class="col-lg-3">
                <div id="order-summary" class="card">
                    <div class="card-header">
                        <h3 class="mt-4 mb-4">Order summary</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Shipping and additional costs are calculated based on the values you have
                            entered.</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Order subtotal</td>
                                        <th>$446.00</th>
                                    </tr>
                                    <tr>
                                        <td>Shipping and handling</td>
                                        <th>$10.00</th>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <th>$0.00</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th>$456.00</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-3-->
        </div>
    </div>
@endsection
