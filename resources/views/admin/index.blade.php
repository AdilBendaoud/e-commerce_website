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
                    <form method="POST" action="{{ route('admin.add') }}">
                        @csrf
                        <div class="flex flex-wrap mb-2">
                            <div class="w-50 px-2 sm:w-full">
                                <x-jet-label for="first_name" value="{{ __('First Name') }}" />
                                <x-jet-input id="first_name" class="block mt-1 w-full" type="text" 
                                    name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                            </div>

                            <div class="w-50 px-2 sm:w-full">
                                <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                                <x-jet-input id="last_name" class="block mt-1 w-full" type="text" 
                                    name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
                            </div>
                        </div>

                        <div class=" px-2 mb-2">
                            <x-jet-label for="phone_number" value="{{ __('Phone Number') }}" />
                            <x-jet-input id="phone_number"
                                        class="block mt-1 w-full" type="number" min="0" 
                                        name="phone_number"  required autofocus autocomplete="phone_number" />
                        </div>

                        <div class=" px-2 mb-3">
                            <x-jet-label for="address" value="{{ __('Address') }}" />
                            <x-jet-input id="address" class="block mt-1 w-full" type="text" 
                                name="address" :value="old('address')" required autofocus autocomplete="address" />
                        </div>

                        <div class=" px-2 mb-2 flex justify-content-around">
                            <div>
                                <x-jet-label for="M" value="{{__('Male')}}" class=" inline" />
                                <input type="radio" name="gender" {{ old('gender') === 'M' ? 'checked' : '' }} id="M" value="M" />
                            </div>
                            <div>
                                <x-jet-label for="F" value="{{__('Female')}}" class=" inline" />
                                <input class=" bg-accent" type="radio" name="gender" {{ old("gender") === "F" ? "checked" : "" }} id="F" value="F" />
                        
                            </div>
                        </div>

                        <div class="px-2 mb-2">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" 
                                        name="email" :value="old('email')" required placeholder="email@example.com" />
                        </div>

                        <div class="px-2 mb-2">
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input id="password" class="block mt-1 w-full" type="password" 
                                        name="password" required autocomplete="new-password" />
                        </div>

                        <div class="px-2 mb-4">
                            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" 
                                        name="password_confirmation" required autocomplete="new-password" />
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
            <h1 class="text-2xl" style="font-weight:bold;">All Administrators</h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"> <i class="fa-solid fa-plus" style="color: #ffffff;"></i> {{ __('Add Admin') }} </button>
        </div>
        <div class="bg-white">
            <table id="myTable" class="table table-bordered text-center" style="vertical-align: middle;">
                <thead>
                    <tr>
                        <th class=" text-center" scope="col">Image</th>
                        <th scope="col" class=" text-center">First Name</th>
                        <th scope="col" class=" text-center">Last Name</th>
                        <th scope="col" class=" text-center">Email</th>
                        <th scope="col" class=" text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                        <tr>
                            <td class="flex  justify-content-center">
                                <img class=" h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </td>
                            <td class=" text-capitalize">{{ $admin->first_name }}</td>
                            <td class=" text-capitalize">{{ $admin->last_name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <button class="btn btn-secondary" data-toggle="modal" data-target="#adminModal{{ $admin->id }}">
                                    <i class="fa-solid fa-eye" style="color: #ffffff;"></i>
                                </button>
                                
                                <button data-toggle="modal" data-target="#confirmDeleteModal{{ $admin->id }}" class="btn btn-danger">
                                    <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                </button>
                                
                                <!-- User Information Modal -->
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
                                </div>

                                <!-- Delete admin Modal -->
                                <div class="modal fade" id="confirmDeleteModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this admin?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.destroy', $admin->id) }}" method="POST">
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