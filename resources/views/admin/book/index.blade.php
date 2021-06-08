@extends('admin.base')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>
                Books
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th class="col">
                            no
                        </th>
                        <th class="col">
                            title
                        </th>
                        <th class="col">
                            category
                        </th>
                        <th class="col">
                            writer
                        </th>
                        <th class="col">
                            publication year
                        </th>
                        <th class="col">
                            publisher
                        </th>
                        <th class="col">
                            price
                        </th>
                        <th class="col">
                            weight
                        </th>
                        <th class="col">
                            stock
                        </th>
                        <th class="col">
                            image
                        </th>
                        <th class="col">
                            action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>

                            <th>
                                {{ $loop->iteration }}
                            </th>
                            <th>
                                {{ $book->title }}
                            </th>
                            <th>
                                {{ $book->category->name }}
                            </th>
                            <th>
                                {{ $book->writer }}
                            </th>
                            <th>
                                {{ $book->publication_year }}
                            </th>
                            <th>
                                {{ $book->publisher }}
                            </th>
                            <th>
                                {{ $book->price }}
                            </th>
                            <th>
                                {{ $book->weight }}
                            </th>
                            <th>
                                {{ $book->stock }}
                            </th>
                            <th>
                                @if (file_exists(public_path('storage/image/' . $book->image)))
                                    <img width="40px" height="40px" src="{{ asset('storage/image/' . $book->image) }}"
                                        alt="" class="card-img-top">
                                @endif
                            </th>
                            <td>
                                <form action="{{ route('book.destroy', ['book' => $book->id]) }}" class="d-inline"
                                    method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="alert('delete this book?')">delete</button>
                                </form>

                                <a href="{{ route('book.edit', ['book' => $book->id]) }}"
                                    class="btn btn-sm btn-success">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
