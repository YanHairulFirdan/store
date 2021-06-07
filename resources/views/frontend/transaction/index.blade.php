@extends('layouts.app')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col text-center">no</th>
                <th scope="col text-center">invoice</th>
                <th scope="col text-center">address</th>
                <th scope="col text-center">total</th>
                <th scope="col text-center">date of transaction</th>
                <th scope="col text-center">status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <th scope="row text-center">{{ $transaction->iteration }}</th>
                    <th scope="row text-center">{{ $transaction->invoice }}</th>
                    <th scope="row text-center">{{ $transaction->customer_address }}</th>
                    <th scope="row text-center">{{ $transaction->sub_total }}</th>
                    <th scope="row text-center">{{ $transaction->created_at }}</th>
                    <th scope="row text-center">{{ $transaction->status }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
