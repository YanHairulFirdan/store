@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            @foreach ($books as $book)
                <div class="col-md-6 col-lg-4 col-xl-3 my-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-image">
                                <img src="{{ URL::asset('storage/image/' . $book->image) }}" alt="" class="image-fluid"
                                    style="max-width: 100%">
                                @if (file_exists('storage/image/' . $book->image))
                                @endif
                            </div>
                            <span class="text-center">
                                {{ $book->title }}
                            </span>
                            <br>
                            <a href="{{ route('book.details', $book->id) }}" class="btn btn-primary btn-md">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- <div class="m-auto p-1"> --}}
        <br><br>
        {{ $books->onEachSide(2)->links() }}
        {{-- </div> --}}
    </div>
@endsection