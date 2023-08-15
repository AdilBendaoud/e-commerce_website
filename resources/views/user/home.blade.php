@extends('layouts.user')

@section('content')
    <h1>i am a user !!</h1>
    <a href="{{ route('cart.index') }}">Cart</a>

    <form action="{{ route('cart.add', 2) }}" method="post">
    @csrf
        <button class="btn btn-primary" type="submit">Add to Cart</button>
    </form>

@endsection

@section('script')
@endsection