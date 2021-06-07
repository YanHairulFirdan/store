@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col text-center">no</th>
                            <th scope="col text-center">Book Name</th>
                            <th scope="col text-center">Quantity</th>
                            <th scope="col text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <th scope="row text-center">{{ $transaction->iteration }}</th>
                                <th scope="row text-center">{{ $transaction->book->title }}</th>
                                <th scope="row text-center">{{ $transaction->quantity }}</th>
                                <th scope="row text-center">{{ $transaction->price }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
