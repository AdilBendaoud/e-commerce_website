@extends('layouts.user')

@section('content')
<div class="container py-5">
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
    <form 
        role="form" 
        action="{{ route('stripe.post') }}" 
        method="post" 
        class="require-validation"
        data-cc-on-file="false"
        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
        id="payment-form">
    @csrf
    <div class="row gx-5 justify-content-between">
        <div class="col-12 col-md-7 order-2 order-md-1">
            <div>
                <div class=" mb-4">
                        <h3>Shipping Address</h3>
                </div>
                <div>
                    <div class="mb-3">
                        <x-jet-label class="mb-1" value="{{__('Country')}}"/>
                        <select id="country" name="country" required class="border-gray-300 rounded-md shadow-sm form-control" style="height: 41px;">
                            <option value="">Select a country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country }}">{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <x-jet-label class="mb-1" value="{{__('City')}}"/>
                        <select required id="city" name="city" disabled class="border-gray-300 rounded-md shadow-sm form-control mb-3" style="height: 41px">
                            <option value="">Select a city</option>
                        </select>
                    </div>
                    <div class="mb-3 required">
                        <x-jet-label class="mb-1" value="{{__('Street')}}"/>
                        <x-jet-input id='street' name='street' type='text' class="form-control" required />
                    </div>
                    <div class="mb-3 required">
                        <x-jet-label class="mb-1" value="{{__('Postecode')}}"/>
                        <x-jet-input id='postCode' name='postCode' type='number' class="form-control hideSpin" min="0" required />
                    </div>
                </div>
            </div>

            <div class="mx-auto">
                <div class="credit-card-box">
                    <div>
                            <h3>Payment Details</h3>
                    </div>
                    <div>    
                        <div class='row px-2 mb-3'>
                            <div class='col-xs-12 required'>
                                <x-jet-label class="mb-1" value="{{__('Name on Card')}}"/>
                                <x-jet-input type='text' class="form-control" required />
                            </div>
                        </div>

                        <div class='row px-2 mb-3'>
                            <div class='col-xs-12 required'>
                                <x-jet-label class="mb-1" value="{{__('Card Number')}}"/>
                                <x-jet-input autocomplete='off' class='form-control card-number' size='20' type='text' required />
                            </div>
                        </div>

                        <div class='row px-2 mb-3'>
                            <div class='col-xs-12 col-md-4 cvc required'>
                                <x-jet-label class="mb-1" value="{{__('CVC')}}"/>
                                <x-jet-input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' required size='4' type='text'/>
                            </div>

                            <div class='col-xs-12 col-md-4 expiration required'>
                                <x-jet-label class="mb-1" value="{{__('Expiration Month')}}"/>
                                <x-jet-input class='form-control card-expiry-month' placeholder='MM' size='2' required type='text'/>
                            </div>
                            <div class='col-xs-12 col-md-4 expiration required'>
                                <x-jet-label class="mb-1" value="{{__('Expiration Year')}}"/>
                                <x-jet-input class='form-control card-expiry-year' placeholder='YYYY' size='4' required type='text'/>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-md-12 error hidden'>
                                <div class='alert-danger alert'>Please correct the errors and try again.</div>
                            </div>
                        </div>

                        <div class="row pt-3 pb-2 mb-2">
                            <div class="col-xs-12 flex justify-content-center">
                                <x-jet-button class="py-3 px-4 w-75 justify-content-center">Pay Now</x-jet-button>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
        <div class="col-12 col-md-4 order-1 mb-3 mb-md-0 order-md-2">
            <div class="sticky-md-top">
                <table class="table shadow-md rounded bg-white">
                    <tr>
                        <th scope="col" class="p-3">Product</th>
                        <th scope="col" class="p-3">Total</th>
                    </tr>
                    @foreach($cart as $item)
                        <tr>
                            <td class="py-2 px-3">{{$item['product']->name}} x {{ $item['quantity'] }}</td>
                            <td class="py-2 px-3">${{$item['quantity'] * $item['product']->sale_price}}</td>
                        </tr>
                    @endforeach
                    @if(session()->has('coupon'))
                        <tr>
                            <td class="py-2 px-3" style="font-style: italic;">Coupon</td>
                            <td class="py-2 px-3" style="font-style: italic;">-{{ session('coupon')->value }} {{ (session('coupon')->type == 'percentage') ? '%' : ''}}</td>
                        </tr>
                    @endif
                    <tr>
                        <th class="p-3">Total</th>
                        <th class="p-3">
                            <span id="totalMobile" class="{{ session()->has('coupon') ? 'gray-strikethrough ml-4' : 'primary-color' }}">${{ $total }}</span>
                            @if(session()->has('coupon'))
                            <span id="newTotalMobile" class="ml-2" style="color: var(--primary);">${{ $newTotal }}</span>
                            @endif
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
<script type="text/javascript">
    const countryInput = document.getElementById('country');
    let cityInput = document.getElementById('city');
    
    countryInput.addEventListener("change",(e)=>{
        const country = e.target.value;
        $.ajax({
            url: `/${country}/cities`,
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                cityInput.disabled =false;
                var option = document.createElement('option');
                cityInput.innerHTML = '';
                option.text = 'Select a city';
                cityInput.add(option);
                response.cities.forEach(city => {
                    const option = document.createElement('option');
                    city=city.replace(/_/g, ' ');
                    const formatedCity = city[0].toUpperCase() + city.slice(1);
                    option.value = formatedCity;
                    option.textContent = formatedCity;
                    cityInput.appendChild(option);
                });
            },
            error: function(error) {
                cityInput.disabled =true;
                var option = document.createElement('option');
                cityInput.innerHTML = '';
                option.text = 'Select a city';
                cityInput.add(option);
                console.error('Error deleting image:', error);
            }
        });
    })
  
$(function() {
  
    var $form = $(".require-validation");
     
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=number]','input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hidden');
    
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hidden');
            e.preventDefault();
          }
        });
     
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
    
    });
      
    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hidden')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
            
            $form.find(['input[type=text]','input[type=number]']).empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.append("<input type='hidden' name='total' value=\"{{ (session()->has('coupon')) ? $newTotal : $total }}\"/>");
            $form.get(0).submit();
        }
    }
     
});
</script>
@endsection