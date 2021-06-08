@extends('admin.base')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('/admin/book/' . $book->id) }}" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ old('title') ? old('title') : $book->title }}">
                        @error('title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="writer">Writer</label>
                        <input type="text" name="writer" id="writer" class="form-control"
                            value="{{ old('writer') ? old('writer') : $book->writer }}">
                        @error('writer')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="publication_year">Publication year</label>
                        <input type="text" name="publication_year" id="publication_year" class="form-control"
                            value="{{ old('publication_year') ? old('publication_year') : $book->publication_year }}">
                        @error('publication_year')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" name="publisher" id="publisher" class="form-control"
                            value="{{ old('publisher') ? old('publisher') : $book->publisher }}">
                        @error('publisher')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control"
                            value="{{ old('description') ? old('description') : $book->description }}">
                        @error('description')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">price</label>
                        <input type="number" name="price" id="price" class="form-control"
                            value="{{ old('price') ? old('price') : $book->price }}">
                        @error('price')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="weight">weight</label>
                        <input type="number" name="weight" id="weight" class="form-control"
                            value="{{ old('weight') ? old('weight') : $book->weight }}">
                        @error('weight')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stock">stock</label>
                        <input type="number" name="stock" id="stock" class="form-control"
                            value="{{ old('stock') ? old('stock') : $book->stock }}">
                        @error('stock')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
