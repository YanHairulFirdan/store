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
                        <th class="">
                            no
                        </th>
                        <th class="">
                            invoice
                        </th>
                        <th class="">
                            customer name
                        </th>
                        <th class="">
                            customer phone
                        </th>
                        <th class="">
                            customer address
                        </th>
                        <th class="">
                            total
                        </th>
                        <th class="">
                            status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>

                            <th>
                                {{ $loop->iteration }}
                            </th>
                            <th>
                                {{ $transaction->invoice }}
                            </th>
                            <th>
                                {{ $transaction->customer_name }}
                            </th>
                            <th>
                                {{ $transaction->customer_phone }}
                            </th>
                            <th>
                                {{ $transaction->customer_address }}
                            </th>
                            <th>
                                {{ $transaction->sub_total }}
                            </th>
                            <th>
                                <form action="{{ route('transaction.update', ['transaction' => $transaction->id]) }}"
                                    method="post">
                                    @method('PUT')
                                    @csrf
                                    <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                                        @foreach ($status as $key => $item)
                                            <option value="{{ $item }}" class="bg-{{ $key }}"
                                                {{ $transaction->status == $item ? 'selected' : '' }}>{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
