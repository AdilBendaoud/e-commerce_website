@extends('layouts.admin')

@section('content')
    <!-- add category modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-jet-validation-errors class="mb-3" />
                    <form method="POST" action="{{ route('category.store') }}">
                        @csrf
                        
                        <div class=" px-2 mb-3">
                            <x-jet-label for="category_name" value="{{ __('Category Name') }}" />
                            <x-jet-input id="category_name" class="block mt-1 w-full" type="text" 
                                name="category_name" :value="old('category_name')" required autofocus/>
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
            <h1 class="text-2xl" style="font-weight:bold;">All Categories</h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"> 
                <i class="fa-solid fa-plus" style="color: #ffffff;"></i> {{ __('Add Category') }} 
            </button>
        </div>
        <div class="bg-white">
            <table id="myTable" class="table table-bordered text-center" style="vertical-align: middle;">
                <thead>
                    <tr>
                        <th class=" text-center" scope="col">id</th>
                        <th scope="col" class=" text-center">Category Name</th>
                        <th scope="col" class=" text-center">Products</th>
                        <th scope="col" class=" text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td class=" text-capitalize">{{ $category->name }}</td>
                            <td>{{ $category->products_count }}</td>
                            <td>
                                <button class="btn btn-secondary" data-toggle="modal" data-target="#categoryModal{{ $category->id }}">
                                    <i class="fa-solid fa-pen" style="color: #ffffff;"></i>
                                </button>
                                
                                <button data-toggle="modal" data-target="#confirmDeleteModal{{ $category->id }}" class="btn btn-danger">
                                    <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                </button>
                                
                                 <!-- Edite category Modal -->
                                <div class="modal fade" id="categoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="categoryModalLabel">Edite Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('category.update', $category->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <x-jet-input class="block mt-1 w-full" type="text" name="category_name" value="{{ $category->name }}" />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Edite</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>       

                                <!-- Delete category Modal -->
                                <div class="modal fade" id="confirmDeleteModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this category?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
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

@endsection