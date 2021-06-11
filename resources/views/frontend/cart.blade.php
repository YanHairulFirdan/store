@extends('layouts.app')
@section('custom_style')
    <style>
        .increase,
        .decrease,
        .save,
        .hide {
            display: none !important;
        }

        .hide {
            animation: hide 1s;
        }

        .show {
            display: block !important;
            animation: show 1s;
        }

        input {
            display: inline-block;
            width: 3em;
            text-align: center;
        }

        @keyframes show {
            from {
                opacity: 0;
                transform: scale(0);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes hide {

            from {
                opacity: 1;
                transform: scale(1);
            }

            to {
                opacity: 0;
                transform: scale(0);
            }
        }

    </style>
@endsection
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
                                                <th class="text-center" colspan="1">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($carts as $cart)
                                                <tr class="my-2 p-1">
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
                                                        <div class="row my-1 justify-content-center">
                                                            <div class="">
                                                                <span class="btn btn-sm rounded-circle btn-warning decrease"
                                                                    id="decrease_{{ $cart->id }}"
                                                                    onclick="update_item_amount(false, {{ $cart->id }})">
                                                                    -
                                                                </span>
                                                            </div>
                                                            <div class="mx-1">
                                                                <input type="text" name="amount"
                                                                    id="amount_{{ $cart->id }}"
                                                                    value="{{ $cart->amount }}"
                                                                    onclick="toggleShow({{ $cart->id }})">
                                                            </div>
                                                            <div class="">
                                                                <span class="btn btn-sm rounded-circle btn-primary increase"
                                                                    id="increase_{{ $cart->id }}"
                                                                    onclick="update_item_amount(true, {{ $cart->id }})">
                                                                    +
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <span class="btn btn-lg btn-success save"
                                                            id="save_{{ $cart->id }}"
                                                            onclick="save({{ $cart->id }})">
                                                            save
                                                        </span>
                                                    </td>
                                                    <td class="text-center" id="price">
                                                        {{ $cart->price }}
                                                    </td>
                                                    <td class="text-center" id="unit_total_price">
                                                        {{ $cart->price * $cart->amount }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('cart.destroy', ['cart' => $cart->id]) }}"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="alert('delete this book?')">delete</a>

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
        let buttons = [
            'increase_',
            'decrease_',
            'save_'
        ];
        buttons.forEach(button => {
            document.getElementById(buttons + id).display = 'none';
        });

        function toggleShow(id) {

            let buttons = [
                'increase_',
                'decrease_',
                'save_'
            ];

            buttons.forEach(button => {
                processButton = document.getElementById(button + id);
                processButton.classList.toggle('show');
                processButton.classList.toggle('hide');
            });
        }

        function save(id) {

            let eventCapture = null;
            let amount = document.getElementById('amount_' + id).value;
            let csrf = document.querySelector('meta[name="csrf-token"]').content;
            let url = 'http://127.0.0.1:8000/api/cart/update/' + id;

            fetch(url, {
                    headers: {
                        "Content-type": "application/json",
                        "Accept": "application/json, text-plain",
                        "X-Requested-With": "XLMHttpRequest",
                        'X-CSRF-TOKEN': csrf
                    },
                    method: "PUT",
                    credentials: "same-origin",
                    body: JSON.stringify({
                        amount
                    })
                })
                .then((response) => {
                    response.json();
                })
                .then(message => console.log(message))
                .catch(error => {
                    console.error(error);
                });

            toggleShow(id);
        }

        function update_item_amount(status, id) {
            let amount = document.getElementById('amount_' + id);
            let unitPrice = document.getElementById('price').innerText;
            let total = document.getElementById('unit_total_price');

            if (amount.value == 1) {
                amount.value = 1;
            }
            status ? amount.value++ : amount.value--;

            total.innerText = amount.value * unitPrice;
        }
        // un used functions
        const update_amount = debounce(() => {
            update(event)
        }, 250)

        function debounce_leading(func, timeout = 300) {
            let timer;

            return (...args) => {
                if (!timer) {
                    func.apply(this, args);
                }

                clearTimeout(timer);

                timer = setTimeout(() => {
                    timer = undefined;
                }, timeout);
            }
        }

        function debounce(func, wait, immadiate) {
            let timeout;
            let called = 0;

            return function() {
                let context = this;
                console.log(called++);
                let args = arguments;

                let later = function() {
                    timeout = null;
                    if (!immadiate) {
                        func.apply(context);
                    }
                }

                let callNow = immadiate && !timeout;

                clearTimeout(timeout)

                timeout = setTimeout(later, wait)

                if (callNow) {
                    func.apply(context)
                }
            }
        }
        // end of un used function

        let totalPrice = 0;
        toggelSubmitButton();

        function selectItem(event) {
            let eventValue = event.value;
            let totalElement = document.getElementById('total');
            let totalColumn = document.getElementById(`total_${eventValue}`);
            print_total_value(event.checked, totalColumn.innerText)
            toggelSubmitButton();
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
