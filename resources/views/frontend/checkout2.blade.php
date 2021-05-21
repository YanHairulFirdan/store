@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- breadcrumb-->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li aria-current="page" class="breadcrumb-item active">Checkout - Address</li>
                    </ol>
                </nav>
            </div>
            <div id="checkout" class="col-lg-9">
                <div class="box">
                    <form method="POST" action="{{ route('profile.checkout') }}">
                        @method('POST')
                        @csrf
                        <h1>Checkout - Address</h1>
                        <div class="nav flex-column flex-md-row nav-pills text-center"><a href="checkout1.html"
                                class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-map-marker">
                                </i>Address</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i
                                    class="fa fa-truck"> </i>Delivery Method</a><a href="#"
                                class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-money"> </i>Payment
                                Method</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i
                                    class="fa fa-eye"> </i>Order Review</a></div>
                        <div class="content py-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input id="name" type="text" class="form-control" name="name">
                                    </div>
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone number</label>
                                        <input id="phone" type="text" class="form-control" name="phone">
                                    </div>
                                    @error('phone')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="regency">Province</label>
                                        <select class="form-control" name="regency" id="">
                                            <option value="">Select province here</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}">{{ $province->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district">District</label>
                                        <select class="form-control" onchange="change_district()" name="dsitrict" id="">
                                            <option value="">Select district here</option>
                                        </select>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address" cols="30" rows="10" name="address"
                                            class="form-control"></textarea>
                                    </div>
                                    @error('address')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.row-->
                            <!-- /.row-->
                            {{-- <div class="row">
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="city">Company</label>
                                        <input id="city" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="zip">ZIP</label>
                                        <input id="zip" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <select id="state" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <select id="country" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Telephone</label>
                                        <input id="phone" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="text" class="form-control">
                                    </div>
                                </div>
                            </div> --}}
                            <!-- /.row-->
                        </div>
                        <div class="box-footer d-flex justify-content-between"><a href="basket.html"
                                class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Back to Basket</a>
                            <button type="submit" class="btn btn-primary">Continue to Delivery Method<i
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
                                        <th>${{ $orderSubtotal }}</th>
                                    </tr>
                                    <tr>
                                        <td>Shipping and handling</td>
                                        <th>${{ $shippingAndHandling }}</th>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <th>$0.00</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th>${{ $total }}</th>
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
