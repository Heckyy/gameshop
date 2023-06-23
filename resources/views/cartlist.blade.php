@extends('master')
@section("content")
<div class="custom-product">
     <div class="col-sm-15">
        <div class="trending-wrapper">
            <h4>Result for Products</h4>
            <a class="btn btn-success" href="ordernow">Order Now</a> <br> <br>
            @foreach($products as $item)
            <div class="row searched-item cart-list-devider">
                <div class="col-sm-3">
                    <a href="detail/{{$item->id}}">
                        <img class="trending-image" src="{{ asset('storage/images/'.$item->gallery) }}">
                    </a>
                </div>
                <div class="col-sm-4">
                    <div class="">
                        <h2>{{$item->name}}</h2>
                        <h5>{{$item->description}}</h5>
                        <h5>Rp.{{$item->price}}</h5>
                    </div>
                </div>
                <div class="col-sm-3">
                    <form action="/removecart/{{$item->cart_id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning">Remove from Cart</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <a class="btn btn-success" href="ordernow">Order Now</a> <br> <br>
     </div>
</div>
@endsection
