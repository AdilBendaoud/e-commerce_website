@extends('layouts.admin')

@section('content')

<div class="mx-auto mt-5" style="width: 80%;">
        <div class="flex justify-between align-items-center px-2 mb-3">
            <h1 class="text-2xl" style="font-weight:bold;">Orders</h1>
        </div>
        <div class="bg-white">
            <table id="myTable" class="table table-bordered text-center" style="vertical-align: middle;">
                <thead>
                    <tr>
                        <th class=" text-center" scope="col">Id</th>
                        <th scope="col" class=" text-center">Customer Name</th>
                        <th scope="col" class=" text-center">Date</th>
                        <th scope="col" class=" text-center">Status</th>
                        <th scope="col" class=" text-center">Total</th>
                        <th scope="col" class=" text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td class=" text-capitalize">{{ $order->user->first_name }} {{$order->user->last_name}}</td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('j F Y') }}</td>
                            <td>
                                @if($order->status == 'on hold')
                                    <span class="text-capitalize p-2 rounded font-semibold onHold">{{ $order->status }}</span>
                                @elseif($order->status == 'processing')
                                    <span class="text-capitalize p-2 rounded font-semibold processing">{{ $order->status }}</span>
                                @else
                                    <span class="text-capitalize p-2 rounded font-semibold shipped">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>${{ $order->total }}</td>
                            <td>
                                <button class="btn btn-dark" data-toggle="modal" data-target="#orderDetailsModal{{ $order->id }}">
                                    <i class="fa-solid fa-eye" style="color: #ffffff;"></i>
                                </button>
                            </td>
                            <!-- order deitails modal -->
                            <div class="modal fade" id="orderDetailsModal{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel">Order #{{$order->id}}</h5>
                                            <div>
                                                @if($order->status == 'on hold')
                                                    <span class="text-capitalize p-2 rounded font-semibold onHold">{{ $order->status }}</span>
                                                @elseif($order->status == 'processing')
                                                    <span class="text-capitalize p-2 rounded font-semibold processing">{{ $order->status }}</span>
                                                @else
                                                    <span class="text-capitalize p-2 rounded font-semibold shipped">{{ $order->status }}</span>
                                                @endif
                                                <button type="button" class="close ml-4" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div> 
                                        <div class="modal-body">
                                            <div class="order_details flex justify-content-around mb-4">
                                                <div>
                                                    <h5>Shipping Address</h5>
                                                    <p><strong>Country: </strong> {{ $order->shipping_addresses->country}}</p>
                                                    <p><strong>City: </strong> {{ $order->shipping_addresses->city}}</p>
                                                    <p><strong>Street: </strong> {{ $order->shipping_addresses->street}}</p>
                                                    <p><strong>Poste Code: </strong> {{ $order->shipping_addresses->post_code}}</p>
                                                </div>
                                                <div>
                                                    <h5>Costumer</h5>
                                                    <p><strong>Name: </strong> {{ $order->user->first_name}} {{ $order->user->last_name }}</p>
                                                    <p><strong>Email: </strong> {{ $order->user->email}}</p>
                                                    <p><strong>Phone: </strong> {{ $order->user->phone_number}}</p>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="table-container">
                                                    <div class="table-row">
                                                        <div class="table-cell fw-bold text-center">Product</div>
                                                        <div class="table-cell fw-bold text-center">Quantity</div>
                                                        <div class="table-cell fw-bold text-center">Total</div>
                                                    </div>
                                                    @foreach($order->products as $product)
                                                        <div class="table-row">
                                                            <div class="table-cell text-center text-capitalize">{{ $product->name }}</div>
                                                            <div class="table-cell text-center">{{ $product->pivot->quantity }}</div>
                                                            <div class="table-cell text-center">${{ $product->pivot->quantity * $product->sale_price }}</div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="justify-content: space-between !important;">
                                            <div>
                                                @if($order->status == 'on hold')
                                                    <form action="{{route('orders.processing',$order->id)}}" method="post">
                                                        @csrf
                                                        <button class="text-primary switch-order-status">Processing</button>
                                                    </form>
                                                @endif
                                                @if($order->status != 'shipped')
                                                    <form class="inline" action="{{route('orders.shipped',$order->id)}}" method="post">
                                                        @csrf
                                                        <button class="text-primary switch-order-status">Shipped</button>
                                                    </form>
                                                @endif
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection