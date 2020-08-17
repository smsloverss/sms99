@extends('layout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Balance</h6>
        </div>
        <div class="card-body">
            *The minimum deposit is 5 &euro;
            <form action="{{ route('payment.create') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="amount" placeholder="Amount" />
                </div>
                <button class="btn btn-info">Pay</button>
            </form>
        </div>
    </div>
@endsection
