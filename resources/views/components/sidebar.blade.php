<aside class="col-2 py-2" style=" background-color:#333a41;">
    <div class="bg-white w-75 flex mx-auto hover:bg-indigo-600">
        <x-jet-application-mark class="mx-auto" />
    </div>

    <x-jet-section-border class="mx-auto py-3 " />

    <div class="flex mx-auto w-75 align-content-start ">
        <img class=" h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        <a class=" ml-3 text-capitalize text-gray-300" href="{{ route('profile.show') }}"> {{ auth::user()->first_name }} {{ auth::user()->last_name }} </a>
    </div>

    <x-jet-section-border class="mx-auto py-3 " />

    <x-sidebar-link :active="request()->routeIs('redirect')" :link="'redirect'">
        {{__( 'Dashboard' )}}
    </x-sidebar-link>

    <x-sidebar-link :active="request()->routeIs('admin.index')" :link="'admin.index'">
        {{__( 'Users' )}}
    </x-sidebar-link>



    <i class="bi bi-arrow-down-right-circle-fill"></i>
</aside>