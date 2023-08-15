@extends('layouts.user')

@section('content')
    <div class="mx-auto" style="font-size: 17px;width:80%;">
        <h2 class="pt-5 fw-bold" style="font-size: 30px;">Cart</h2>
        <table id="desktop-table" class="table border-2" style="border-color:#dddddb;">
            <tr class=" bg-white">
                <th></th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            @foreach($cart as $item)
                <tr>
                    <td class=" d-flex align-items-center justify-content-around">
                        <form action="{{ route('cart.destroy', $item['product']->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                            <button type="submit">
                                <i class="fa-regular fa-circle-xmark" style="color: #dddddb; font-size:24px;"></i>
                            </button>
                        </form>
                        <img class="object-cover" style="height: 70px; width:70px;" src="{{ $item['product']->images[0]->image_path }}" alt="{{ $item['product']->name}}" />
                    </td>
                    <td style="vertical-align:middle;color:var(--primary);">{{ $item['product']->name }}</td>
                    <td style="vertical-align:middle;">${{ $item['product']->sale_price }}</td>
                    <td style="vertical-align:middle;">
                        <input type="number" class="quantityInput" data-id="{{ $item['product']->id }}" name="quantity{{ $item['product']->id }}" value="{{ $item['quantity'] }}" min="1" style="width:65px" />
                    </td>
                    <td style="vertical-align:middle;">${{ $item['quantity'] * $item['product']->sale_price }}</td>
                </tr>
            @endforeach 
            <tr>
                <td colspan="2" class=" px-4 py-3 {{ session()->has('coupon') ? 'd-none':'d-block'}}">
                    <form action="{{ route('coupon.apply') }}" method="post">
                        @csrf    
                            <x-jet-input type="text" name="coupon_code" class="px-2 py-1 text-uppercase" style="height:40px;font-size:14px;width:200px" placeholder="Coupon Code" />
                            <x-jet-button style="height:42px;background-color:var(--primary);">APPLY COUPON</x-jet-button>
                    </form>
                </td>
                <td class=" px-5 text-right" colspan="3" style="vertical-align:middle;font-size:20px">
                    <span class="fw-bold">Total</span>
                    @php
                        $total = 0 ;
                        $newTotal = 0;
                        
                        foreach($cart as $item){
                            $total+=  $item['quantity'] * $item['product']->sale_price;
                        }
                        
                        if(session()->has('coupon')){
                            if(session('coupon')->type === 'percentage'){
                                $newTotal = (1-(session('coupon')->value/100))*$total;
                            }else{
                                $newTotal = $total-session('coupon')->value;
                            }
                        }
                    @endphp
                        <span id="total" class="ml-4 {{ session()->has('coupon') ? 'gray-strikethrough' : 'primary-color' }}">${{ $total }}</span>
                    @if(session()->has('coupon'))
                        <span id="newTotal" class="ml-2" style="color: var(--primary);">${{ $newTotal }}</span>
                    @endif
                </td>
            </tr>
        </table>

        <table id="mobile-table" class="table border-2" style="border-color:#dddddb;">
            @foreach($cart as $item)
                <tr>
                    <td>
                        <form action="{{ route('cart.destroy', $item['product']->id) }}" method="post" class="d-flex justify-content-center">
                            @csrf
                            @method('DELETE')
                                <button type="submit">
                                    <i class="fa-regular fa-circle-xmark" style="color: #dddddb; font-size:24px;"></i>
                                </button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td class=" d-flex align-items-center justify-content-center">
                         <img class="object-cover" style="height: 70px; width:70px;" src="{{ $item['product']->images[0]->image_path }}" alt="{{ $item['product']->name}}" />
                    </td>
                </tr>
                <tr>
                    <td class="d-flex justify-content-between" style="vertical-align:middle;"><span>Product:</span> <span style="color:var(--primary);">{{ $item['product']->name }}</span></td>
                </tr>
                <tr>
                    <td class="d-flex justify-content-between" style="vertical-align:middle;"><span>Price:</span> <span>${{ $item['product']->sale_price }}</span></td>
                </tr>
                <tr>
                    <td class="d-flex justify-content-between" style="vertical-align:middle;">
                        <span>Quantity:</span>
                        <input type="number" class="quantityInput float-right" data-id="{{ $item['product']->id }}" name="quantity{{ $item['product']->id }}" value="{{ $item['quantity'] }}" min="1" style="width:65px" />
                    </td>
                </tr>
                <tr>
                    <td class="d-flex justify-content-between" style="vertical-align:middle;"><span>Subtotal:</span> <span>${{ $item['quantity'] * $item['product']->sale_price }}</span></td>
                </tr>
                
            @endforeach 
            <tr>
                <td colspan="2" class=" px-4 py-3 {{ session()->has('coupon') ? 'd-none':'d-block'}}">
                    <form class="d-flex justify-content-center" action="{{ route('coupon.apply') }}" method="post">
                        @csrf    
                            <x-jet-input type="text" name="coupon_code" class="px-2 py-1 text-uppercase" style="height:40px;font-size:14px;width:200px" placeholder="Coupon Code" />
                            <x-jet-button style="height:42px;background-color:var(--primary);">APPLY COUPON</x-jet-button>
                    </form>
                </td>
            </tr>
            <tr>
                <td class="d-flex justify-content-center px-5 text-right" colspan="3" style="vertical-align:middle;font-size:20px">
                    <span class="fw-bold">Total</span>
                    @php
                        $total = 0 ;
                        $newTotal = 0;
                        
                        foreach($cart as $item){
                            $total+=  $item['quantity'] * $item['product']->sale_price;
                        }
                        
                        if(session()->has('coupon')){
                            if(session('coupon')->type === 'percentage'){
                                $newTotal = (1-(session('coupon')->value/100))*$total;
                            }else{
                                $newTotal = $total-session('coupon')->value;
                            }
                        }
                    @endphp
                        <span id="totalMobile" class="ml-4 {{ session()->has('coupon') ? 'gray-strikethrough' : 'primary-color' }}">${{ $total }}</span>
                    @if(session()->has('coupon'))
                        <span id="newTotalMobile" class="ml-2" style="color: var(--primary);">${{ $newTotal }}</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>
@endsection

@section('script')
<script>
    const screenWidth = window.innerWidth;
    let totalSpan = document.getElementById('total');
    let newTotalSpan = document.getElementById('newTotal');
    let totalSpanMobile = document.getElementById('totalMobile');
    let newTotalSpanMobile = document.getElementById('newTotalMobile');
    const allQuantityInput = document.getElementsByClassName('quantityInput');
    for (let index = 0; index < allQuantityInput.length; index++) {
        allQuantityInput[index].addEventListener('input',(e)=>{
            productId = e.target.getAttribute('data-id');
            quantity = e.target.value;
            if(screenWidth>768){
                subTotal = e.target.parentElement.nextElementSibling;
            }else{
                subTotal = e.target.parentElement.parentElement.nextElementSibling.firstElementChild.getElementsByTagName('span')[1];
            }
            $.ajax({
                url: `cart/updateQuantity/${productId}`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity,
                },
                success: function(response) {
                    console.log(response.message);
                    subTotal.textContent = `$${response.subTotal}`;
                    totalSpan.textContent = `$${response.total}`;
                    newTotalSpanMobile.textContent=`$${response.total}`;
                    newTotalSpan.textContent = `$${response.newTotal}`;
                    newTotalSpanMobile.textContent=`$${response.newTotal}`;
                },
                error: function(error) {
                    console.error('Error fetching old data:', error);
                }
            });
        });
    }
</script>
@endsection