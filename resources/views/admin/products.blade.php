@extends('layouts.admin')

@section('content')
    <!-- if(Auth::user()->email != $admin->email)
        endif -->
  
    <!-- Modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-jet-validation-errors class="mb-3" />
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
        
                        <div class="px-2 mb-3">
                            <x-jet-label for="name" value="{{ __('Product Name') }}" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" 
                                name="name" :value="old('name')" required autofocus />
                        </div>
                        <div class="px-2 mb-3">
                            <x-jet-label for="cover_image" value="{{ __('Cover Image') }}" />
                            <input id="cover_image" class="block mt-1 w-full" type="file" 
                                name="cover_image" :value="old('cover_image')" accept="image/*" required />
                        </div>
                        
                        <div id="imagePreview"></div>

                        <div class="px-2 mb-3">
                            <x-jet-label for="additional_images" value="{{ __('Additional Images (optional)') }}" />
                            <input id="additional_images" class="block mt-1 w-full" type="file" 
                                name="additional_images[]" :value="old('additional_images')" accept="image/*" multiple/>
                        </div>
                        
                        <div id="additional_images_Preview"></div>

                        <div class="px-2 mb-3">
                            <x-jet-label for="description" value="{{ __('Description') }}" />
                            <textarea id="description" class="block mt-1 w-full" 
                                name="description" :value="old('description')"
                                required autofocus rows="5">
                            </textarea>
                        </div>
                        
                        <div class="px-2 mb-3">
                            <x-jet-label for="sale_price" value="{{ __('Category') }}" />
                            <select class="block mt-1 w-full" required autofocus name="category">
                                @forelse($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                    <option value="">no category</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="px-2 mb-3">
                            <x-jet-label for="list_price" value="{{ __('List price') }}" />
                            <x-jet-input id="list_price" min="1" class="block mt-1 w-full hideSpin" type="number" 
                                name="list_price" :value="old('list_price')" required autofocus/>
                        </div>
                        
                        <div class="px-2 mb-3">
                            <x-jet-label for="sale_price" value="{{ __('Sale price') }}" />
                            <x-jet-input id="sale_price" min="1" class="block mt-1 w-full hideSpin" type="number" 
                                name="sale_price" :value="old('sale_price')" required autofocus/>
                        </div>
                        
                        <div class="px-2 mb-3">
                            <x-jet-label for="quantity" value="{{ __('Quantity') }}" />
                            <x-jet-input id="quantity" min="1" class="block mt-1 w-full hideSpin" type="number" 
                                name="quantity" :value="old('quantity')" required autofocus/>
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
            <h1 class="text-2xl" style="font-weight:bold;">All Products</h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"> <i class="fa-solid fa-plus" style="color: #ffffff;">
                </i> {{ __('Add Product') }} 
            </button>
        </div>
        <div class="bg-white">
            <table id="myTable" class="table table-bordered text-center" style="vertical-align: middle;">
                <thead>
                    <tr>
                        <th class=" text-center" scope="col">Image</th>
                        <th scope="col" class=" text-center">Name</th>
                        <th scope="col" class=" text-center">Quantity</th>
                        <th scope="col" class=" text-center">Liste Price</th>
                        <th scope="col" class=" text-center">Sale Price</th>
                        <th scope="col" class=" text-center">Category</th>
                        <th scope="col" class=" text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="flex  justify-content-center">
                                <img class=" h-10 w-10 rounded-full object-cover" src="{{ $product->images->first()->image_path}}" alt="{{ $product->name }}" />
                            </td>
                            <td class=" text-capitalize">{{ $product->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->list_price }}</td>
                            <td>{{ $product->sale_price }}</td>
                            <td>{{ $product->categorie->name }}</td>
                            <td>
                                <button class="btn btn-secondary" data-toggle="modal" data-target="#productModal{{ $product->id }}">
                                    <i class="fa-solid fa-eye" style="color: #ffffff;"></i>
                                </button>
                                
                                <button data-toggle="modal" data-target="#confirmDeleteModal{{ $product->id }}" class="btn btn-danger">
                                    <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                </button>
                                
                                {{-- update product Modal
                                <div class="modal fade" id="adminModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="adminModalLabel{{ $admin->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="adminModalLabel{{ $admin->id }}">Admin Information</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="flex  justify-content-center mb-3">
                                                    <img class="h-25 w-25 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                                </div>
                                                <p class=" text-capitalize"><strong>First Name:</strong> {{ $admin->first_name }}</p>
                                                <p class="text-capitalize"><strong>Last Name:</strong> {{ $admin->last_name }}</p>
                                                <p><strong>Email:</strong> {{ $admin->email }}</p>
                                                <p><strong>Phone Number:</strong> {{ $admin->phone_number }}</p>
                                                <p><strong>Address:</strong> {{ $admin->address}}</p>
                                                <p><strong>Created At:</strong> {{ \Carbon\Carbon::parse($admin->created_at)->format('j F Y') }} </p>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>--}}
                                <!-- Delete product Modal -->
                                <div class="modal fade" id="confirmDeleteModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete {{ $product->name }} ??
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
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