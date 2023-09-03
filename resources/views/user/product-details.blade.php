@extends('layouts.user')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-md-6">
                <img class="xzoom mb-3 product-details-image mx-auto" src="{{ asset($product->images[0]->image_path) }}" xoriginal="{{ asset($product->images[0]->image_path) }}"/>
                <div class="xzoom-thumbs">
                    @foreach( $product->images as $image )
                        <a href="{{ asset($image->image_path) }}">
                            <img class="xzoom-gallery d-inline-block" width="80" src="{{ asset($image->image_path) }}" >
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-md-6 py-5 px-5">
                <h1 style="font-size: 2.2rem; font-weight:700">{{ $product->name }}</h1>
                <span class="mb-4 d-block">
                    Category: <a href="#" style="line-height: 1;margin-bottom: 1em;text-decoration:none;color:var(--primary);" class="fw-bold">{{$product->categorie->name}}</a>
                </span>
                <div class="mb-2">
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
                        <i class="fa fa-star" style="font-size: 20px;color:var(--primary)"></i>
                    @endfor

                    @for ($i = 0; $i < $noStar ; $i++)
                        <i class="text-muted fa fa-star" style="font-size: 20px;"></i>
                    @endfor
                    <a href="#reviews" style="text-decoration:none;color:var(--primary);">({{count($product->comments)}} review{{(count($product->comments)>1) ? 's':''}})</a>
                </div>
                <div >
                    <div class="mb-2">
                        <span style="text-decoration:line-through;font-size: 1.5rem;" class="text-secondary font-semibold">${{ (int)$product->list_price }}</span>
                        <span style="font-weight: 700;font-size: 1.7rem;">${{ (int)$product->sale_price }}</span>
                        <span> + Free Shipping</span>
                    </div>
                    <p class="mb-5">{{$product->description}}</p>
                    <div>
                        <form action="{{route('cart.add',$product->id)}}" method="post" id="review-form">
                        @csrf
                            <button class="block justify-content-center d-flex mx-auto text-uppercase text-white  px-4 py-2 font-semibold text-lg" 
                                style="background-color: var(--primary);width:80%;" 
                                onmouseout="this.style.backgroundColor='#ff8f01'" 
                                onmouseover="this.style.backgroundColor='#d1790a'">ADD TO CART</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div id="reviews">
            <h3>Reviews ({{count($product->comments)}})</h3>
            @forelse($product->comments as $comment)
                <div class="flex ">
                    <div class="flex me-2 py-2" style="vertical-align:middle;">
                        <img class="h-12 w-12 rounded-full object-cover" src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}" />
                    </div>
                    <div>
                        <span class="text-capitalize fw-bold me-2">{{ $comment->user->first_name.' '.$comment->user->last_name }}</span>
                        <span>{{\Carbon\Carbon::parse($comment->created_at)->format('j F Y')}}</span>
                        <div class="mb-2">
                            @php
                                $emptyStars = 5-(int)$comment->rating;
                            @endphp

                            @for ($i = 0; $i < $comment->rating ; $i++)
                                <i class="fa fa-star" style="color:var(--primary)"></i>
                            @endfor
                            @for ($i = 0; $i < $emptyStars ; $i++)
                                <i class="text-muted fa fa-star"></i>
                            @endfor
                        </div>
                        <p>{{$comment->comment_body}}</p>
                    </div>
                </div>
            @empty
                <p>There are no reviews yet.</p>
            @endforelse
            
            @auth
                <div class="border border-secondary py-3 px-4">
                    <form action="{{ route('comment.store',$product->id) }}" method="post" id="review-form">
                        @csrf
                        <h4>Add a review</h4>
                        <div class="mb-3">
                            <span>Your rating *</span>
                            <i class="text-muted fa fa-star rating-star star-1" data-rating="1"></i>
                            <i class="text-muted fa fa-star rating-star star-2" data-rating="2"></i>
                            <i class="text-muted fa fa-star rating-star star-3" data-rating="3"></i>
                            <i class="text-muted fa fa-star rating-star star-4" data-rating="4"></i>
                            <i class="text-muted fa fa-star rating-star star-5" data-rating="5"></i>
                        </div>
                        <p>Your review *</p> 
                        <textarea name="comment_body" id="comment_body" class="w-100 mb-3" rows="5"></textarea>
                        <button type="submit" id="submit-btn" class="block text-uppercase text-white  px-4 py-2 font-semibold text-lg" 
                                style="background-color: var(--primary);" 
                                onmouseout="this.style.backgroundColor='#ff8f01'" 
                                onmouseover="this.style.backgroundColor='#d1790a'">SUBMIT</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('js/xzoom.min.js') }}"></script>
<script>
    $(function() {
        $(".xzoom, .xzoom-gallery").xzoom({tint: '#333', Xoffset: 15});
    
        var rating = 0;
        $(".rating-star").mouseover(function(){
            reset_stars();
            for (let index = 1; index < $(this).data("rating")+1; index++) {
                $(".star-"+index).removeClass("text-muted");
                $(".star-"+index).css({
                    "color":"#ff8f01",
                    "cursor":"pointer"
                });
            }
        })

        $(".rating-star").mouseout(function(){
            reset_stars();
            if(rating != 0){
                for (let index = 1; index < rating+1; index++) {
                    $(".star-"+index).removeClass("text-muted");
                    $(".star-"+index).css({
                        "color":"#ff8f01",
                        "cursor":"pointer"
                    });
                }
            }
        })

        $(".rating-star").on("click",function(){
            rating = parseInt($(this).data("rating"));
        })

        function reset_stars(){
            $(".rating-star").addClass("text-muted");
        }
    
        $("#submit-btn").on("click",function(e){
            const reviewBody = $("#comment_body").val();
            if(rating == 0 || reviewBody === ""){
                e.preventDefault();
                alert("Please select a rating and write a review");
            }else{
                $("form#review-form").append("<input type='hidden' name='rating' value='" + rating+ "'/>");
                form.get(0).submit();
            }
        })

    
    
    })
</script>
@endsection
