@extends('layout')

@section('content')
    <form action="{{ route('settings.change') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" name="password" placeholder="New password">
        </div>
        <button class="btn btn-block btn-outline-primary" type="submit">Change password</button>
    </form>
@endsection
