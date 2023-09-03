@extends('layouts.user')

@section('content')
    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <
        </div>
    </div>

    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3">
                <form action="{{ route('/shop',$category) }}" method="GET">
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" name="query" placeholder="Search ..." value="{{ $query }}">
                        <button type="submit" class="input-group-text text-light" style="background-color: var(--primary);">
                            <i class="fa fa-fw fa-search text-white"></i>
                        </button>
                    </div>
                </form>
                <h2 class="h3 pb-4">Categories</h2>
                <ul class="list-unstyled">
                    @foreach($categories as $category)
                        <li class="pb-3 pl-3">
                            <a class="h3 text-decoration-none text-black" href="{{ route('/shop',$category->id) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-6 col-md-4">
                            <x-product :product="$product"/>
                        </div>
                    @endforeach                
                <div div="row">
                    {{$products->links()}}
                </div>
            </div>

        </div>
    </div>
    <!-- End Content -->
@endsection

@section('script')
@endsection