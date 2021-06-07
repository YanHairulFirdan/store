@extends('admin.base')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-statistic-2">
                    <div class="card-stats p-4">
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    {{ $bookCount }}
                                </div>
                                <div class="card-stats-item-label">
                                    <h5>Books</h5>
                                </div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    {{ $userCount }}
                                </div>
                                <div class="card-stats-item-label">
                                    <h5>Users</h5>
                                </div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">
                                    {{ $transactionCount }}
                                </div>
                                <div class="card-stats-item-label">
                                    <h5>Transactions</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
