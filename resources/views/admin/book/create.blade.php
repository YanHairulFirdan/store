@extends('admin.base')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create book
                    </div>
                    <div class="card-body">
                        {{-- @if ($errors->any())
                            {{ dd($errors->all()) }}
                        @endif --}}
                        <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title') ? old('title') : '' }}">
                                @error('title')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="writer">Writer</label>
                                <input type="text" name="writer" id="writer" class="form-control"
                                    value="{{ old('writer') ? old('writer') : '' }}">
                                @error('writer')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="publication_year">Publication year</label>
                                <input type="text" name="publication_year" id="publication_year" class="form-control"
                                    value="{{ old('publication_year') ? old('publication_year') : '' }}">
                                @error('publication_year')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="publisher">Publisher</label>
                                <input type="text" name="publisher" id="publisher" class="form-control"
                                    value="{{ old('publisher') ? old('publisher') : '' }}">
                                @error('publisher')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">price</label>
                                <input type="number" name="price" id="price" class="form-control"
                                    value="{{ old('price') ? old('price') : '' }}">
                                @error('price')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="weight">weight</label>
                                <input type="number" name="weight" id="weight" class="form-control"
                                    value="{{ old('weight') ? old('weight') : '' }}">
                                @error('weight')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="stock">stock</label>
                                <input type="number" name="stock" id="stock" class="form-control"
                                    value="{{ old('stock') ? old('stock') : '' }}">
                                @error('stock')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" name="description" id="description" rows="4" cols="10"
                                    class="form-control">{{ old('description') ? old('description') : '' }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Book image</label>
                                <div class="fallback dropzone" id="mydropzone">
                                    <input name="image" type="file" class="form-control" />
                                </div>
                                <div>
                                    <small>You can drag and drop your image for upload directly here</small>
                                </div>
                                @error('image')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
