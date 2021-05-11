@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- breadcrumb-->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li aria-current="page" class="breadcrumb-item active">Shopping cart</li>
                        </ol>
                    </nav>
                </div>
                <div id="basket" class="col-lg-12">
                    <div class="box">
                        <form method="post" action="{{ route('input.order') }}">
                            <h1>Shopping cart</h1>
                            <p class="text-muted">You currently have {{ $carts->count() }} item(s) in your cart.</p>
                            <div class="table-responsive">
                                <form action="{{ route('order') }}" method="post">
                                    @method('POST')
                                    @csrf
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="select-all" id="select-all"
                                                        onchange="selectAll(this)">
                                                </td>
                                                <th class="text-center" colspan="2">Product</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Unit price</th>
                                                <th class="text-center" colspan="1">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($carts as $cart)
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <input class="checkbox" name="selected[]" type="checkbox"
                                                                class="" value="{{ $cart->id }}"
                                                                onchange="selectItem(this)">
                                                        </div>
                                                    </td>
                                                    <td class="text-center" colspan="2">
                                                        <img width="120px" height="120px"
                                                            src="{{ URL::asset('storage/image/' . $cart->book->image) }}" />
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $cart->amount }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $cart->price }}
                                                    </td>
                                                    <td class="text-center" id="total_{{ $cart->id }}">
                                                        {{ $cart->price * $cart->amount }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">Total</th>
                                                <th colspan="2">$<span id="total"></span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <button type="submit" class="btn btn-primary">Proceed to checkout <i
                                            class="fa fa-chevron-right"></i></button>
                                </form>
                            </div>
                            <!-- /.table-responsive-->
                            <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                                <div class="left"><a href="category.html" class="btn btn-outline-secondary"><i
                                            class="fa fa-chevron-left"></i> Continue shopping</a></div>
                                <div class="right">
                                    <button class="btn btn-outline-secondary"><i class="fa fa-refresh"></i> Update
                                        cart</button>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-->
                    {{-- <div class="row same-height-row">
                        <div class="col-lg-3 col-md-6">
                            <div class="box same-height">
                                <h3>You may also like these products</h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img src="img/product2.jpg" alt=""
                                                    class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img src="img/product2_2.jpg" alt=""
                                                    class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img src="img/product2.jpg" alt=""
                                        class="img-fluid"></a>
                                <div class="text">
                                    <h3>Fur coat</h3>
                                    <p class="price">$143</p>
                                </div>
                            </div>
                            <!-- /.product-->
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img src="img/product1.jpg" alt=""
                                                    class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img src="img/product1_2.jpg" alt=""
                                                    class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img src="img/product1.jpg" alt=""
                                        class="img-fluid"></a>
                                <div class="text">
                                    <h3>Fur coat</h3>
                                    <p class="price">$143</p>
                                </div>
                            </div>
                            <!-- /.product-->
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img src="img/product3.jpg" alt=""
                                                    class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img src="img/product3_2.jpg" alt=""
                                                    class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img src="img/product3.jpg" alt=""
                                        class="img-fluid"></a>
                                <div class="text">
                                    <h3>Fur coat</h3>
                                    <p class="price">$143</p>
                                </div>
                            </div>
                            <!-- /.product-->
                        </div>
                    </div> --}}
                </div>
                <!-- /.col-lg-9-->
                {{-- <div class="col-lg-3">
                    <div id="order-summary" class="box">
                        <div class="box-header">
                            <h3 class="mb-0">Order summary</h3>
                        </div>
                        <p class="text-muted">Shipping and additional costs are calculated based on the values you have
                            entered.</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="text-center">Order subtotal</td>
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
                    <div class="box">
                        <div class="box-header">
                            <h4 class="mb-0">Coupon code</h4>
                        </div>
                        <p class="text-muted">If you have a coupon code, please enter it in the box below.</p>
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control"><span class="input-group-append">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-gift"></i></button></span>
                            </div>
                            <!-- /input-group-->
                        </form>
                    </div>
                </div> --}}
                <!-- /.col-md-3-->
            </div>
        </div>
    </div>
@endsection

@push('custom')
    <script>
        let totalPrice = 0;
        toggelSubmitButton();

        function selectItem(event) {
            let eventValue = event.value;
            let totalElement = document.getElementById('total');
            let totalColumn = document.getElementById(`total_${eventValue}`);
            print_total_value(event.checked, totalColumn.innerText)
            toggelSubmitButton();
            // totalElement.innerText = totalPrice;
        }


        function toggelSubmitButton() {
            var checkboxes = Array.from(document.getElementsByClassName("checkbox"));
            var submitButton = document.querySelector("button[type=submit]");

            let checked = checkboxes.filter(checkbox => {
                return checkbox.checked
            })

            if (checked.length == 0) {
                submitButton.disabled = true;
            } else {
                if (checked.length === checkboxes.length) {
                    document.getElementById('select-all').checked = true;
                }
                submitButton.disabled = false;
            }

        }

        function selectAll(event) {
            var checkboxes = Array.from(document.getElementsByClassName("checkbox"));
            let selectedCheckbox = checkboxes.filter(checkbox => checkbox.checked == true);

            if (selectedCheckbox.length >= 0 && selectedCheckbox.length < checkboxes.length) {
                checkboxes.forEach(checkbox => {
                    if (!checkbox.checked) {
                        let totalColumn = document.getElementById(`total_${checkbox.value}`).innerText;
                        checkbox.checked = true;
                        print_total_value(checkbox.checked, parseInt(totalColumn));
                    }
                });
            } else if (selectedCheckbox.length == checkboxes.length) {
                checkboxes.forEach(checkbox => {
                    let totalColumn = document.getElementById(`total_${checkbox.value}`).innerText;
                    checkbox.checked = false
                    print_total_value(checkbox.checked, parseInt(totalColumn));
                });
            }
            toggelSubmitButton();
        }

        function print_total_value(status, value) {
            console.log(value);
            let totalElement = document.getElementById('total');
            if (status) {
                totalElement.innerText = (totalElement.innerText) ? totalElement.innerText : 0;
                console.log(totalElement.innerText);
                totalElement.innerText = parseInt(totalElement.innerText) + parseInt(value);
                console.log(totalElement.innerText);
            } else {
                if (parseInt(totalElement.innerText) > 0) {
                    totalElement.innerText = parseInt(totalElement.innerText) - parseInt(value);
                    console.log(totalElement.innerText);
                }
            }
        }

    </script>
@endpush
