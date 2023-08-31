<div class="shadow rounded col-12 col-md-4" style="width: 270px;height:435px;background-color:white;">
    <div style="height: 270px;">
        <a href="{{ route('products.show',$product->slug) }}">
            <img src="{{$product->images[0]->image_path}}" style="height: 100%;width: 100%;" class="block" alt="mok">
        </a>
    </div>
    <div class="p-2">
        <span style="font-size:15px;color:rgb(98, 97, 92);">{{ $product->categorie->name }}</span>
        <a href="{{ route('products.show',$product->slug) }}" class="text-decoration-none">
            <h5 style="margin: 0;" class="text-dark">{{$product->name}}</h5>
        </a>
        <p style="margin-bottom: 2px;">
            <span class="text-muted" style="text-decoration:line-through;font-size:16px;margin-right:5px;">${{$product->list_price}}</span>
            <span style="font-size:16px;font-weight:bold;color:rgb(98, 97, 92);">${{$product->sale_price}}</span>
        </p>
        <div>
            @php
                $allRating = 0;
                foreach($product->comments as $comment){
                    $allRating+=(int)$comment->rating;
                }
                if(count($product->comments) != 0){
                $stars = $allRating/count($product->comments);
                $noStar = 5-$stars;                    
                }
                else {
                    $stars = 0;
                    $noStar = 0;
                }
            @endphp

            @for ($i = 0; $i < $stars ; $i++)
                <i class="fa fa-star" style="color:var(--primary)"></i>
            @endfor

            @for ($i = 0; $i < $noStar ; $i++)
                <i class="text-muted fa fa-star"></i>
            @endfor
        </div>
        <div style="float: right;">
            <form action="{{route('cart.add',$product->id)}}" method="post">
                @csrf
                <x-jet-button class="btn btn-secondary" title="Add to cart">
                    <i class="fa-solid fa-cart-plus"></i>
                </x-jet-button>
            </form>
        </div>    
    </div>
</div>