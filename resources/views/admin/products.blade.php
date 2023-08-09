@extends('layouts.admin')

@section('content')
    <!-- if(Auth::user()->email != $admin->email)
        endif -->
  
    <!-- Modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
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
                            <input id="cover_image" class="block mt-1 w-full cover_image" type="file" 
                                name="cover_image" :value="old('cover_image')" accept="image/*" required />
                        </div>
                        
                        <div id="imagePreview"></div>

                        <div class="px-2 mb-3">
                            <x-jet-label for="additional_images" value="{{ __('Additional Images (optional)') }}" />
                            <input id="additional_images" class="block mt-1 w-full" type="file" 
                                name="additional_images[]" :value="old('additional_images')" accept="image/*" multiple/>
                        </div>
                        
                        <div class="my-4 flex flex-wrap gap-2" id="additional_images_Preview"></div>

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
                                @php
                                    foreach($product->images as $image){
                                        if($image->cover){
                                            $image_to_display = $image;
                                        }
                                    }    
                                @endphp
                                <img class=" h-10 w-10 rounded-full object-cover" src="{{ $image_to_display->image_path}}" alt="{{ $product->name }}" />
                            </td>
                            <td class=" text-capitalize">{{ $product->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->list_price }}</td>
                            <td>{{ $product->sale_price }}</td>
                            <td class=" text-capitalize">{{ $product->categorie->name ?? 'no category' }}</td>
                            <td>
                                <button class="btn btn-secondary open-update-product-modal" data-product-id="{{ $product->id }}" data-target="#productEditeModal{{ $product->id }}">
                                    <i class="fa-solid fa-pen" style="color: #ffffff;"></i>
                                </button>
                                
                                <button data-toggle="modal" data-target="#confirmDeleteModal{{ $product->id }}" class="btn btn-danger">
                                    <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                </button>
                                
                                <!-- update product Modal -->
                                <div class="modal fade" id="productEditeModal{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="productEditeLabel{{ $product->id }}">Update Product</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <x-jet-validation-errors class="mb-3" />
                                                <form method="POST" action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="px-2 mb-3">
                                                        <x-jet-label for="name{{ $product->id }}" style="text-align:left;" value="{{ __('Product Name') }}" />
                                                        <x-jet-input id="name{{ $product->id }}" class="block mt-1 w-full" type="text"
                                                            name="name" :value="old('update_name')" required autofocus />
                                                    </div>
                                                    <div class="px-2 mb-3">
                                                        <x-jet-label style="text-align:left;" for="cover_image" value="{{ __('Cover Image') }}" />
                                                        <input id="cover_image" class="block mt-1 w-full cover_image" type="file" 
                                                            name="cover_image" :value="old('cover_image')" accept="image/*" />
                                                    </div>
                                                    
                                                    <div id="imagePreview"></div>

                                                    <div class="my-3">
                                                        <img class="mx-auto" src="{{ $image_to_display->image_path }}" style="height: 150px;">
                                                    </div>

                                                    <div class="px-2 mb-3">
                                                        <x-jet-label style="text-align:left;" for="additional_images" value="{{ __('Additional Images (optional)') }}" />
                                                        <input id="additional_images" class="block mt-1 w-full additional_images" type="file" 
                                                            name="additional_images[]" :value="old('additional_images')" accept="image/*" multiple/>
                                                    </div>
                                                    
                                                    <div id="additional_images_Preview"></div>

                                                    <div class="my-4 flex flex-wrap gap-3">
                                                        @foreach($product->images as $myImage)
                                                            @if(! $myImage->cover)
                                                                <div class="mydiv">
                                                                    <button class="closeBtn">
                                                                        <span class="x">x</span>
                                                                    </button>
                                                                    <img src="{{ $myImage->image_path }}" style="height:150px;width:150px;aspect-ratio: 1/1;">
                                                                </div>
                                                            @endif                                                            
                                                        @endforeach
                                                    </div>

                                                    <div class="px-2 mb-3">
                                                        <x-jet-label style="text-align:left;" for="description{{ $product->id }}" value="{{ __('Description') }}" />
                                                        <textarea id="description{{ $product->id }}" class="block mt-1 w-full" 
                                                            name="description" :value="old('description')"
                                                            required autofocus rows="5">
                                                        </textarea>
                                                    </div>
                                                    
                                                    <div class="px-2 mb-3">
                                                        <x-jet-label style="text-align:left;" for="sale_price" value="{{ __('Category') }}" />
                                                        <select class="block mt-1 w-full" required autofocus name="category">
                                                            @forelse($categories as $category)
                                                                @if($category->name == $product->categorie->name)
                                                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                                @else
                                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                @endif                                                           
                                                            @empty
                                                                <option value="">no category</option>
                                                            @endforelse
                                                        </select>
                                                    </div>

                                                    <div class="px-2 mb-3">
                                                        <x-jet-label style="text-align:left;" for="list_price{{ $product->id }}" value="{{ __('List price') }}" />
                                                        <x-jet-input id="list_price{{ $product->id }}" min="1" class="block mt-1 w-full hideSpin" type="number" 
                                                            name="list_price" :value="old('list_price')" required autofocus/>
                                                    </div>
                                                    
                                                    <div class="px-2 mb-3">
                                                        <x-jet-label style="text-align:left;" for="sale_price{{ $product->id }}" value="{{ __('Sale price') }}" />
                                                        <x-jet-input id="sale_price{{ $product->id }}" min="1" class="block mt-1 w-full hideSpin" type="number" 
                                                            name="sale_price" :value="old('sale_price')" required autofocus/>
                                                    </div>
                                                    
                                                    <div class="px-2 mb-3">
                                                        <x-jet-label style="text-align:left;" for="quantity{{ $product->id }}" value="{{ __('Quantity') }}" />
                                                        <x-jet-input id="quantity{{ $product->id }}" min="1" class="block mt-1 w-full hideSpin" type="number" 
                                                            name="quantity" :value="old('quantity')" required autofocus/>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <x-jet-secondary-button data-dismiss="modal">Close</x-jet-secondary-button>
                                                        <button type="submit" class=" btn btn-success ml-4">
                                                            {{ __('Update') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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