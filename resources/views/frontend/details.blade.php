@extends('layouts.app')
@section('content')
    <div id="all">
        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- breadcrumb-->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Ladies</a></li>
                                <li class="breadcrumb-item"><a href="#">Tops</a></li>
                                <li aria-current="page" class="breadcrumb-item active">White Blouse Armani</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-3 order-2 order-lg-1">
                        <!--
                                                                                                                                                                            *** MENUS AND FILTERS ***
                                                                                                                                                                            _________________________________________________________
                                                                                                                                                                            -->
                        <div class="card sidebar-menu mb-4">
                            <div class="card-header">
                                <h3 class="h4 card-title">Categories</h3>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills flex-column category-menu">
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('book.category', $category->name) }}"
                                                class="nav-link">{{ $category->name }} <span
                                                    class="badge badge-secondary">{{ $category->books->count() }}</span></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                        {{-- <div class="card sidebar-menu mb-4">
                            <div class="card-header">
                                <h3 class="h4 card-title">Brands <a href="#" class="btn btn-sm btn-danger pull-right"><i
                                            class="fa fa-times-circle"></i> Clear</a></h3>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Armani (10)
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Versace (12)
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Carlo Bruni (15)
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Jack Honey (14)
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i>
                                        Apply</button>
                                </form>
                            </div>
                        </div>
                        <div class="card sidebar-menu mb-4">
                            <div class="card-header">
                                <h3 class="h4 card-title">Colours <a href="#" class="btn btn-sm btn-danger pull-right"><i
                                            class="fa fa-times-circle"></i> Clear</a></h3>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"><span class="colour white"></span> White (14)
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"><span class="colour blue"></span> Blue (10)
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"><span class="colour green"></span> Green (20)
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"><span class="colour yellow"></span> Yellow (13)
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"><span class="colour red"></span> Red (10)
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i>
                                        Apply</button>
                                </form>
                            </div>
                        </div> --}}
                        <!-- *** MENUS AND FILTERS END ***-->
                        <div class="banner"><a href="#">
                                <img src="{{ URL::asset('storage/image/' . $book->image) }}" alt="" class="image-fluid"
                                    style="max-width: 100%">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 order-1 order-lg-2">
                        <div id="productMain" class="row">
                            <div class="col-md-6">
                                {{-- <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                                    <div class="item"> <img src="img/detailbig1.jpg" alt="" class="img-fluid"></div>
                                    <div class="item"> <img src="img/detailbig2.jpg" alt="" class="img-fluid"></div>
                                    <div class="item"> <img src="img/detailbig3.jpg" alt="" class="img-fluid"></div>
                                </div>
                                <div class="ribbon sale">
                                    <div class="theribbon">SALE</div>
                                    <div class="ribbon-background"></div>
                                </div>
                                <!-- /.ribbon-->
                                <div class="ribbon new">
                                    <div class="theribbon">NEW</div>
                                    <div class="ribbon-background"></div>
                                </div> --}}
                                <img src="{{ URL::asset('storage/image/' . $book->image) }}" alt="" class="image-fluid"
                                    style="max-width: 100%; height: 100%;">
                                <!-- /.ribbon-->
                            </div>
                            <div class="col-md-6">
                                <div class="box">
                                    <h3 class="text-center">{{ $book->title }}</h3>
                                    <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product
                                            details, material &amp; care and sizing</a></p>
                                    <p class="price">${{ $book->price }}</p>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="id" value="{{ $book->id }}">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="amount"
                                                placeholder="amount of book..">
                                            @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary btn-lg btn-block mt-4" type="submit">
                                            <i class="fa fa-shopping-cart"></i> Add to cart
                                        </button>
                                    </form>
                                    {{-- <p class="text-center buttons"><a href="basket.html" class="btn btn-primary"></a><a href="basket.html"
                                            class="btn btn-outline-primary"><i class="fa fa-heart"></i> Add to wishlist</a>
                                    </p> --}}
                                </div>
                                {{-- <div data-slider-id="1" class="owl-thumbs">
                                    <button class="owl-thumb-item"><img src="img/detailsquare.jpg" alt=""
                                            class="img-fluid"></button>
                                    <button class="owl-thumb-item"><img src="img/detailsquare2.jpg" alt=""
                                            class="img-fluid"></button>
                                    <button class="owl-thumb-item"><img src="img/detailsquare3.jpg" alt=""
                                            class="img-fluid"></button>
                                </div> --}}
                            </div>
                        </div>
                        <div id="details" class="box">
                            <p></p>
                            <h3>Book details</h3>
                            <h4>Writer</h4>
                            <p>{{ $book->writer }}</p>
                            <h4>Publication Year</h4>
                            <p>{{ $book->publication_year }}</p>
                            <h4>Publisher</h4>
                            <p>{{ $book->publisher }}</p>
                            <h4>Weight</h4>
                            <p>{{ $book->weight }} Kg</p>
                            <h4>Stock</h4>
                            <p>{{ $book->stock }} pcs</p>

                            <blockquote>
                                <p><em>{{ $book->description }}</em></p>
                            </blockquote>
                            <hr>

                        </div>
                        {{-- <div class="row same-height-row">
                            <div class="col-md-3 col-sm-6">
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
                        {{-- <div class="row same-height-row">
                            <div class="col-md-3 col-sm-6">
                                <div class="box same-height">
                                    <h3>Products viewed recently</h3>
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
                    <!-- /.col-md-9-->
                </div>
            </div>
        </div>
    </div>
@endsection
