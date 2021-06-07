@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            @foreach ($books as $book)
                <div class="col-md-4 col-lg-4 col-xl-3 my-1">
                    <div class="card">
                        <img src="{{ URL::asset('storage/image/' . $book->image) }}" alt="" class="card-img-top"
                            style="max-width: 100%">
                        <div class="card-body">

                            @if (file_exists('storage/image/' . $book->image))
                            @endif
                            <span class="text-center">
                                {{ $book->title }}
                            </span>
                            <br>
                            <a href="{{ route('book.details', $book->id) }}"
                                class="btn btn-primary btn-lg btn-block mt-4">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="container">{{ $books->onEachSide(2)->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
