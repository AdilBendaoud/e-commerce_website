<div class="card mb-4 product-wap rounded-0">
    <div class="card rounded-0">
        @php
            foreach($product->images as $image){
                if($image->cover){
                    $image_to_display = $image;
                }
            }    
        @endphp
        <a href="{{ route('products.show',$product->slug) }}">
            <img class="card-img rounded-0 img-fluid" src="{{asset($image_to_display->image_path)}}">
        </a>
    </div>
    <div class="card-body">
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
                    $noStar = 5;
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
                <x-jet-button class="btn" title="Add to cart">
                    <i class="fa-solid fa-cart-plus"></i>
                </x-jet-button>
            </form>
        </div>    
    </div>
</div>