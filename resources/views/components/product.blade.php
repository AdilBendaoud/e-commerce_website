<div class="col-12 col-md-4" style="width: 270px;height:430px;background-color:white;">
    <div style="height: 270px;">
        <img src="{{$product->images[0]->image_path}}" style="height: 100%;width: 100%;" class="block" alt="mok">
    </div>
    <div class="p-2">
        <span style="font-size:15px;color:rgb(98, 97, 92);">{{ $product->categorie->name }}</span>
        <h5 style="margin: 0;">{{$product->name}}</h5>
        <p style="margin-bottom: 2px;">
            <span class="text-muted" style="text-decoration:line-through;font-size:16px;margin-right:5px;">${{$product->list_price}}</span>
            <span style="font-size:16px;font-weight:bold;color:rgb(98, 97, 92);">${{$product->sale_price}}</span>
        </p>
        <div>
            <i class="text-warning fa fa-star" style="font-size: 18px;"></i>
            <i class="text-warning fa fa-star"></i>
            <i class="text-warning fa fa-star"></i>
            <i class="text-muted fa fa-star"></i>
            <i class="text-muted fa fa-star"></i>
        </div>
        <div class="pr-2" style="float: right;">
            <form action="{{route('cart.add',$product->id)}}" method="post">
                @csrf
                <x-jet-button class="btn btn-secondary" title="Add to cart">
                    <i class="fa-solid fa-cart-plus"></i>
                </x-jet-button>
            </form>
        </div>    
    </div>
</div>