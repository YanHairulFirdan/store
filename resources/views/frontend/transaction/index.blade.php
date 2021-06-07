@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col text-center">no</th>
                            <th scope="col text-center">invoice</th>
                            <th scope="col text-center">address</th>
                            <th scope="col text-center">total</th>
                            <th scope="col text-center">date of transaction</th>
                            <th scope="col text-center">status</th>
                            <th scope="col text-center">details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <th scope="row text-center">{{ $transaction->iteration }}</th>
                                <th scope="row text-center">{{ $transaction->invoice }}</th>
                                <th scope="row text-center">{{ $transaction->customer_address }}</th>
                                <th scope="row text-center">$ {{ $transaction->sub_total }}</th>
                                <th scope="row text-center">{{ $transaction->created_at }}</th>
                                <th scope="row text-center">{{ $transaction->status }}</th>
                                <th scope="row text-center">
                                    <a href="{{ url('transaction') . '/' . $transaction->id }}"
                                        class="btn btn-primary">details</a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
