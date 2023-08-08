<aside class="col-2 py-2" style=" background-color:#333a41;">
    <div class="bg-white w-75 flex mx-auto hover:bg-indigo-600">
        <x-jet-application-mark class="mx-auto" />
    </div>
    <hr style="color:white;">
    <div class="flex align-items-center mx-auto w-75 align-content-start ">
        <img class=" h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        <a class="ml-3 text-capitalize text-gray-300" style="text-decoration: none;" href="{{ route('profile.show') }}"> {{ auth::user()->first_name }} {{ auth::user()->last_name }} </a>
    </div>

    <hr style="color:white;">
    <div style="display:flex;flex-direction:column; justify-content: space-between;height: calc(100vh - 180px);">
        <div>
            <x-sidebar-link :active="request()->routeIs('redirect')" :link="'redirect'" :icon="'fa-solid fa-gauge'">
                {{__( 'Dashboard' )}}
            </x-sidebar-link>
        
            <x-sidebar-link :active="request()->routeIs('admin.index')" :link="'admin.index'" :icon="'fa-solid fa-user-group'">
                {{__( 'Admins' )}}
            </x-sidebar-link>

            <x-sidebar-link :active="request()->routeIs('admin.products')" :link="'admin.products'" :icon="'fa-solid fa-box'">
                {{__( 'Products' )}}
            </x-sidebar-link>

            <x-sidebar-link :active="request()->routeIs('category.index')" :link="'category.index'" :icon="'fa-solid fa-tags'">
                {{__( 'Categories' )}}
            </x-sidebar-link>
        </div>
        <div class="mx-auto rounded-2" style="width:90%;background-color:#c0392b;">
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button  type='submit' style="padding:8px 16px;width:100%;"   href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    <i class="fa-solid fa-right-from-bracket" style="color:white;"></i>
                    <span class="text-white">{{ __('Log Out') }}</span>
                </button>
            </form>
        </div>
    </div>
</aside>