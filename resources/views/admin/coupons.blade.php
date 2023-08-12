@extends('layouts.admin')

@section('content')
    <!-- add coupon modal -->
    <div class="modal" id="addCouponModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-jet-validation-errors class="mb-3" />
                    <form method="POST" action="{{ route('coupons.store') }}">
                        @csrf
                        
                        <div class=" px-2 mb-3">
                            <x-jet-label for="code" value="{{ __('Coupon Code') }}" />
                            <x-jet-input id="code" class="block mt-1 mb-2 w-full" type="text" 
                                name="code" :value="old('code')" required autofocus/>
                            <button id="generate_coupon_btn">Generate random code</button>
                        </div>

                        <div class=" px-2 mb-3">
                            <x-jet-label for="type" value="{{ __('Coupon Type') }}" />
                            <select class="border-gray-300 block mt-1 w-full focus:border-indigo-300 
                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 
                                    rounded-md shadow-sm" name="type" id="type">
                                <option value="percentage">Percentage discount</option>
                                <option value="fixed">Fixed value discount</option>
                            </select>
                        </div>

                        <div class=" px-2 mb-3">
                            <x-jet-label for="value" value="{{ __('Coupon value') }}" />
                            <x-jet-input id="value" class="block mt-1 w-full hideSpin" min="1" type="number" 
                                name="value" :value="old('value')" required autofocus/>
                        </div>

                        <div class=" px-2 mb-3">
                            <x-jet-label for="expiry_date" value="{{ __('Coupon expiry date') }}" />
                            <x-jet-input id="expiry_date" class="block mt-1 w-full" type="date" 
                                name="expiry_date" :value="old('expiry_date')" required autofocus/>
                        </div>
                       
                        <div class=" px-2 mb-3">
                            <x-jet-label for="usage_limite" value="{{ __('Coupon usage limite') }}" />
                            <x-jet-input id="usage_limite" class="block mt-1 w-full hideSpin" min="1" type="number" 
                                name="usage_limite" :value="old('usage_limite')" required autofocus/>
                        </div>

                        <div class="modal-footer">
                            <x-jet-secondary-button data-dismiss="modal">Close</x-jet-secondary-button>
                            <x-jet-button class="ml-4">
                                {{ __('Add') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-auto mt-5" style="width: 80%;">
        <div class="flex justify-between align-items-center px-2 mb-3">
            <h1 class="text-2xl" style="font-weight:bold;">All Coupons</h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addCouponModal"> 
                <i class="fa-solid fa-plus" style="color: #ffffff;"></i> {{ __('Add Coupon') }} 
            </button>
        </div>
        <div class="bg-white">
            <table id="myTable" class="table table-bordered text-center" style="vertical-align: middle;">
                <thead>
                    <tr>
                        <th class=" text-center" scope="col">Code</th>
                        <th class=" text-center" scope="col">Coupon Type</th>
                        <th class=" text-center" scope="col">Value</th>
                        <th class=" text-center" scope="col">Expiry Date</th>
                        <th scope="col" class=" text-center">Usage Limite</th>
                        <th scope="col" class=" text-center">Created By</th>
                        <th scope="col" class=" text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->type }}</td>
                            <td>{{ $coupon->value }}</td>
                            <td>{{ $coupon->expiry_date }}</td>
                            <td>{{ $coupon->usage_limite }}</td>
                            <td class=" text-capitalize">{{ $coupon->user->first_name }} {{ $coupon->user->last_name }}</td>
                            <td>
                                <button class="btn btn-secondary open-update-coupon-modal" data-coupon-id="{{ $coupon->id }}">
                                    <i class="fa-solid fa-pen" style="color: #ffffff;"></i>
                                </button>
                                
                                <button data-toggle="modal" data-target="#confirmDeleteModal{{ $coupon->id }}" class="btn btn-danger">
                                    <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                </button>
                                

                                <div class="modal fade" id="updateCouponModal{{$coupon->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="couponModalLabel">Edite coupon</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mt-2 px-2 mb-3">
                                                        <x-jet-label class="text-left" for="code" value="{{ __('Coupon Code') }}" />
                                                        <x-jet-input id="update_code{{$coupon->id}}" class="block mt-1 mb-2 w-full" type="text" 
                                                            name="code" :value="old('code')" required autofocus/>
                                                        <button id="generate_coupon_btn" class="block">Generate random code</button>
                                                    </div>

                                                    <div class=" px-2 mb-3">
                                                        <x-jet-label class="text-left" for="type" value="{{ __('Coupon Type') }}" />
                                                        <select class="border-gray-300 block mt-1 w-full focus:border-indigo-300 
                                                                focus:ring focus:ring-indigo-200 focus:ring-opacity-50 
                                                                rounded-md shadow-sm" name="type" id="type">
                                                            <option value="percentage" {{ ($coupon->type === 'percentage') ? 'selected' : ' '}} >Percentage discount</option>
                                                            <option value="fixed" {{ ($coupon->type === 'fixed') ? 'selected' : ' '}}>Fixed value discount</option>
                                                        </select>
                                                    </div>

                                                    <div class=" px-2 mb-3">
                                                        <x-jet-label class="text-left" for="value" value="{{ __('Coupon value') }}" />
                                                        <x-jet-input id="update_value{{$coupon->id}}" class="block mt-1 w-full hideSpin" min="1" type="number" 
                                                            name="value" :value="old('value')" required autofocus/>
                                                    </div>

                                                    <div class=" px-2 mb-3">
                                                        <x-jet-label class="text-left" for="expiry_date" value="{{ __('Coupon expiry date') }}" />
                                                        <x-jet-input id="update_expiry_date{{$coupon->id}}" class="block mt-1 w-full" type="date" 
                                                            name="expiry_date" :value="old('expiry_date')" required autofocus/>
                                                    </div>
                                                
                                                    <div class=" px-2 mb-3">
                                                        <x-jet-label class="text-left" for="usage_limite" value="{{ __('Coupon usage limite') }}" />
                                                        <x-jet-input id="update_usage_limite{{$coupon->id}}" class="block mt-1 w-full hideSpin" min="1" type="number" 
                                                            name="usage_limite" :value="old('usage_limite')" required autofocus/>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete coupon Modal -->
                                <div class="modal fade" id="confirmDeleteModal{{ $coupon->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this coupon?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
<script>
    const generateCouponBtn = document.getElementById('generate_coupon_btn');
    generateCouponBtn.addEventListener('click',function(e){
        e.preventDefault();
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let couponCode = '';

        for (let i = 0; i < 8; i++) {
            const randomIndex = Math.floor(Math.random() * characters.length);
            couponCode += characters.charAt(randomIndex);
        }
        const input = e.target.previousElementSibling;
        input.value = couponCode;
    })

    $('.open-update-coupon-modal').on('click', function() {
        const couponId = $(this).data('coupon-id'); 
        $.ajax({
            url: `coupons/${couponId}`,
            method: 'GET',
            success: function(response) {
                const coupon = response.coupon;
                populateUpdateModal(coupon);
            },
            error: function(error) {
                console.error('Error fetching old data:', error);
            }
        });
    });

    function populateUpdateModal(coupon){
        $(`#update_code${coupon.id}`).val(coupon.code);
        $(`#update_value${coupon.id}`).val(coupon.value);
        $(`#update_expiry_date${coupon.id}`).val(coupon.expiry_date);
        $(`#update_usage_limite${coupon.id}`).val(coupon.usage_limite);
        $(`#updateCouponModal${coupon.id}`).modal('show');
    }
</script>
@endsection