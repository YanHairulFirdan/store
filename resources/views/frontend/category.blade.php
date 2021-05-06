@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center my-5 py-3">
            @foreach ($books as $book)
                <div class="col-md-3 col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-image">
                                <img src="{{ URL::asset('storage/image/' . $book->image) }}" alt="" class="image-fluid"
                                    style="max-width: 100%">
                            </div>
                            <span class="text-center">
                                {{ $book->title }}
                            </span>
                            <br>
                            <a href="{{ route('book.details', $book->id) }}" class="btn btn-primary btn-md">Details</a>
                        </div>
                    </div>
                    @if ($loop->iteration > 4 && $loop->iteration % 4 == 0)
                        {!! $closingTag !!}
                        <br>
                        {!! $openingTag !!}
                    @endif
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{-- {{ $books->links() }} --}}
        </div>
    </div>
@endsection
