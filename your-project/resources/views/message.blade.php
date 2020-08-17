@extends('layout')

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">SMS Spoofer</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('message.send') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="from">Sender</label>
                    <input type="text" class="form-control" id="from" name="from">
                </div>
                <div class="form-group">
                    <label for="to">Recipients (1 number per line)</label>
                    <textarea name="to" id="to" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="message">Message </label>
                    <textarea class="form-control" name="message" id="message" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary" type="submit">Send SMS</button>
                </div>
            </form>
        </div>
    </div>
@endsection
