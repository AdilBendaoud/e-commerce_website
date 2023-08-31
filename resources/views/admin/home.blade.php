@extends('layouts.admin')

@section('content')
    <div class="container px-3 pt-5">
        <h1 class="text-3xl" style="font-weight:bold;">Dashboard</h1>
        
        <div class="row g-2 mb-4">
            <div class="col-lg-3 col-6 pr-2">
                <div class="bg-info rounded shadow relative pt-3 pb-2 px-4">
                    <h3 class="f3 text-white">{{$monthOrders}}</h3>
                    <p class="text-white">new orders</p>
                    <i class="fa-solid fa-bag-shopping absolute" style="top: 23px;right: 24px;font-size: 3.8rem;color: #fff;opacity:0.6;"></i>
                </div>
            </div>

            <div class="col-lg-3 col-6 px-2">
                <div class="rounded shadow relative pt-3 pb-2 px-4" style="background-color:#00c565;">
                    <h3 class="f3 text-white">{{$newUsers}}</h3>
                    <p class="text-white">New users</p>
                    <i class="fa-solid fa-user-plus absolute" style="top: 23px;right: 24px;font-size: 3.8rem;color: #fff;opacity:0.4;"></i>
                </div>
            </div>

            <div class="col-lg-3 col-6 px-2">
                <div class="bg-danger rounded shadow relative pt-3 pb-2 px-4">
                    <h3 class="f3 text-white" style="letter-spacing: -0.02rem;">+ ${{$monthRevenue}}</h3>
                    <p class="text-white">Revenue</p>
                    <i class="fa-solid fa-dollar-sign absolute" style="top: 23px;right: 24px;font-size: 3.8rem;color: #fff;opacity:0.4;"></i>
                </div>
            </div>

            <div class="col-lg-3 col-6 pl-2">
                <div class="bg-warning rounded shadow relative pt-3 pb-2 px-4">
                    <h3 class="f3 text-white">{{$totalproduct}}</h3>
                    <p class="text-white">Products</p>
                    <i class="fa-solid fa-warehouse absolute" style="top: 23px;right: 24px;font-size: 3.5rem;color: #fff;opacity:0.4;"></i>
                </div>
            </div>
        </div>
        
        <div class="row ui-sortable">
            <div class="col-lg-7 connectedSortable">

                <div class="card shadow m-3">
                    <div class="card-header py-2 px-3" >
                        <div class="mr-3 d-inline-block pe-3 ps-2 py-2" style="border-right: 2px solid #dddddb;">
                            <i class="fa-solid fa-grip-vertical"></i>
                        </div>
                        <i class="fa-solid fa-chart-line text-dark mr-2" style="font-size: 22px;"></i>
                        <span class="fw-bold">Monthly Sales</span>
                    </div>
                    <div class="card-body relative bg-white w-100">
                        <canvas id="salesLineChart"></canvas>
                    </div>
                </div>
                
                <div class="card shadow m-3">
                    <div class="card-header py-2 px-3" >
                        <div class="mr-3 d-inline-block pe-3 ps-2 py-2" style="border-right: 2px solid #dddddb;">
                            <i class="fa-solid fa-grip-vertical"></i>
                        </div>
                        <i class="fa-solid fa-clock text-dark mr-2" style="font-size: 22px;"></i>
                        <span class="fw-bold">Last Orders</span>
                    </div>
                    <div class="card-body relative bg-white">
                        <table class="table table-striped text-center">
                            <tr>
                                <th class="px-2 py-3">Id</th>
                                <th class="px-2 py-3">Costumer</th>
                                <th class="px-2 py-3">Status</th>
                                <th class="px-2 py-3">Date</th>
                            </tr>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td class="px-2 py-3">{{$order->id}}</td>
                                    <td class="px-2 py-3">{{$order->user->first_name." ".$order->user->last_name}}</td>
                                    <td class="px-2 py-3">
                                        @if($order->status == 'on hold')
                                            <span class="text-capitalize p-2 rounded font-semibold onHold">{{ $order->status }}</span>
                                        @elseif($order->status == 'processing')
                                            <span class="text-capitalize p-2 rounded font-semibold processing">{{ $order->status }}</span>
                                        @else
                                            <span class="text-capitalize p-2 rounded font-semibold shipped">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-2 py-3">{{\Carbon\Carbon::parse($order->order_date)->format('j F Y')}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="card-footer flex justify-content-end py-2 ">
                        <a href="{{route('orders.index')}}" class="btn btn-primary">View All Orders</a>
                    </div>
                </div>

                <div class="card shadow m-3">
                    <div class="card-header py-2 px-3" >
                        <div class="mr-3 d-inline-block pe-3 ps-2 py-2" style="border-right: 2px solid #dddddb;">
                            <i class="fa-solid fa-grip-vertical"></i>
                        </div>
                        <i class="fa-solid fa-chart-column text-dark mr-2" style="font-size: 22px;"></i>
                        <span class="fw-bold">Monthly Sales By Category</span>
                    </div>
                    <div class="card-body relative bg-white w-100">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>

                <div class="card shadow m-3">
                    <div class="card-header">
                        <div class="mr-3 d-inline-block pe-3 ps-2 py-2" style="border-right: 2px solid #dddddb;">
                            <i class="fa-solid fa-grip-vertical"></i>
                        </div>
                        <i class="fa-solid fa-clock text-dark mr-2" style="font-size: 22px;"></i>
                        <span class="fw-bold">New Users</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped text-center">
                                <tr>
                                    <th class="px-2 py-3">First Name</th>
                                    <th class="px-2 py-3">Last Name</th>
                                    <th class="px-2 py-3">Email</th>
                                    <th class="px-2 py-3">Date</th>
                                </tr>
                                @foreach($newUsersData as $user)
                                    <tr>
                                        <td class="px-2 py-3">{{$user->first_name}}</td>
                                        <td class="px-2 py-3">{{$user->last_name}}</td>
                                        <td class="px-2 py-3">{{$user->email}}</td>
                                        <td class="px-2 py-3">{{\Carbon\Carbon::parse($user->created_at)->format('j F Y')}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="card-footer flex justify-content-end py-2 ">
                        <a href="{{route('admin.index')}}" class="btn btn-primary">View All Users</a>
                    </div>
                </div>

            </div>

            <div class="col-lg-5 connectedSortable">

                <div class="card shadow m-3">
                    <div class="card-header py-2 px-3" >
                        <div class="mr-3 d-inline-block pe-3 ps-2 py-2" style="border-right: 2px solid #dddddb;">
                            <i class="fa-solid fa-grip-vertical"></i>
                        </div>
                        <i class="fa-solid fa-chart-pie text-dark mr-2" style="font-size: 22px;"></i>
                        <span class="fw-bold">Order Status</span>
                    </div>
                    <div class="card-body relative bg-white w-100">
                        <canvas id="orderStatusChart" style="height:300px"></canvas>
                    </div>
                </div>

                <div class="card shadow m-3">
                    <div class="card-header py-2 px-3" >
                        <div class="mr-3 d-inline-block pe-3 ps-2 py-2" style="border-right: 2px solid #dddddb;">
                            <i class="fa-solid fa-grip-vertical"></i>
                        </div>
                        <i class="fa-solid fa-clock text-dark mr-2" style="font-size: 22px;"></i>
                        <span class="fw-bold">Recently Added Products</span>
                    </div>
                    <div class="card-body">
                        <ul class="product-list-in-card p-0 m-0">
                            @foreach($recentProducts as $product)
                                @php
                                    foreach($product->images as $image){
                                        if($image->cover){
                                            $image_to_display = $image;
                                        }
                                    }
                                @endphp
                                <li class="item py-2">
                                    <div style="float: left;">
                                    <a href="{{ route('products.show',$product->slug) }}">
                                        <img src="{{ asset($image_to_display->image_path) }}" alt="Product Image" style="height: 60px;width: 60px;">
                                    </a>
                                    </div>
                                    <div class="margin-left: 60px;">
                                        <a href="{{ route('products.show',$product->slug) }}" class="m-0 fw-bold text-decoration-none" style="color: var(--primary);">{{$product->name}}
                                            <span class="badge bg-success" style="line-height: 1.5;float:right;">${{$product->sale_price}}</span>
                                        </a>
                                        <p style="overflow: hidden;text-overflow: ellipsis;white-space:nowrap;">
                                            {{$product->description}}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class=" card-footer py-2 flex justify-content-center">
                        <a href="{{route('admin.products')}}" class=" btn btn-secondary">View all Products</a>
                    </div>
                </div>
                

                <div class="card shadow m-3">
                    <div class="card-header py-2 px-3">
                        <div class="mr-3 d-inline-block pe-3 ps-2 py-2" style="border-right: 2px solid #dddddb;">
                            <i class="fa-solid fa-grip-vertical"></i>
                        </div>
                        <i class="fa-solid fa-chart-pie text-dark mr-2" style="font-size: 22px;"></i>
                        <span class="fw-bold">To-do List</span>
                    </div>
                    <div class="card-body">
                        <ul class="todo-list" style="list-style: none;margin: 0;overflow: auto;padding: 0;">
                            @foreach($tasks as $task)
                                <li class="task-item flex align-items-center {{$task->completed ? 'completed':''}}">
                                    <i class="fa-solid fa-grip-vertical mr-3 handle"></i>
                                    <input type="checkbox" data-taskId="{{$task->id}}" class="mr-2 todo-item" style="cursor:pointer;width:22px;height:22px;"  {{ $task->completed ? 'checked':''}}>
                                    <p class="inline p-0 m-0">{{$task->title}}</p>
                                    <i class="fa-solid fa-trash-can text-danger trashIcone"></i>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer py-2 flex">
                        <input class="form-control me-2 taskInput" type="text" name="title" placeholder="Add a new todo">
                        <button type="button" class="btn btn-primary" id="addTaskBtn" style="width: 120px;">Add Task</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/chart.min.js') }}"></script>

<script>
    const ctx = document.getElementById('salesLineChart').getContext("2d");
    let gradiant = ctx.createLinearGradient(0,0,0,400);
    gradiant.addColorStop(0,"rgba(58,123,213,1)");
    gradiant.addColorStop(1,"rgba(0,210,255,0.3)");
    let delayed;
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
        labels: @json($monthOrdersLabels),
        datasets: [{
            label: 'Monthly Sales',
            data: @json($monthOrdersData),
            fill: true,
            backgroundColor:gradiant,
            hitRadius:30,
        }]
        },
        options: {
            tension:0.2,
            scales: {
                y: { beginAtZero: true }
            },
            responsive: true,
            animation: {
                onComplete: () => {
                    delayed = true;
                },
                delay: (context) => {
                    let delay = 0;
                    if (context.type === 'data' && context.mode === 'default' && !delayed) {
                        delay = context.dataIndex * 300 + context.datasetIndex * 100;
                    }
                    return delay;
                },
            }
        }
    });


    var ctx2 = document.getElementById('orderStatusChart').getContext('2d');
    var myDonutChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
        labels: ['On Hold', 'Shipped', 'Preparing'],
            datasets: [{
                data: @json($orderStatus),
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
            }],
        },
        options: {
            cutoutPercentage: 70,
            legend: {
                position: 'top',
            },
            responsive: true,
            animation: {
                onComplete: () => {
                    delayed = true;
                },
                delay: (context) => {
                    let delay = 0;
                    if (context.type === 'data' && context.mode === 'default' && !delayed) {
                        delay = context.dataIndex * 300 + context.datasetIndex * 100;
                    }
                    return delay;
                },
            }
        }
    });

    var ctx3 = document.getElementById('barChart').getContext('2d');
    var myDonutChart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: @json($salesByCategoryLabel),
            datasets: [{
                data: @json($salesByCategoryData),
                backgroundColor: gradiant,
            }],
        },
        options: {
            lmaintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            animation: {
                onComplete: () => {
                    delayed = true;
                },
                delay: (context) => {
                    let delay = 0;
                    if (context.type === 'data' && context.mode === 'default' && !delayed) {
                    delay = context.dataIndex * 300 + context.datasetIndex * 100;
                    }
                    return delay;
                },
            }
    }});

    const addTaskBtn = document.getElementById("addTaskBtn");
    var todoList = document.getElementsByClassName("todo-list")[0];

    function getTaskHighestId(){
        return $.ajax({
            url:'todos/id',
            type:"GET",
            data: {
                _token: '{{ csrf_token() }}',
            }
        })
    }
    addTaskBtn.addEventListener("click",(e)=>{
        const input = document.getElementsByClassName("taskInput")[0].value.trim();
        if(input !== ""){
            addTaskBtn.disabled=true;
            getTaskHighestId().then(function(res){
                $.ajax({
                url: '{{ route("todos.store") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    title: input,
                },
                success: function(response) {
                    var liElm = document.createElement("li");
                    liElm.classList.add("task-item","flex","align-items-center");
                    
                    var iElm = document.createElement("i");
                    iElm.classList.add("fa-solid","fa-grip-vertical","mr-3","handle");
                    iElm.style.cursor="move";
                    
                    var iElm2 = document.createElement("i");
                    iElm2.classList.add("fa-solid","fa-trash-can","text-danger","trashIcone");
                    iElm2.addEventListener("click",deleteTask);
                    
                    var inputElm = document.createElement("input");
                    inputElm.setAttribute("type","checkbox");
                    inputElm.setAttribute("class","mr-2 todo-item");
                    inputElm.setAttribute("data-taskId",(+res.id+1));
                    inputElm.setAttribute("style","cursor:pointer;width:22px;height:22px;");
                    inputElm.addEventListener("change",toggleTask);
                    
                    var pElm = document.createElement("p");
                    pElm.classList.add("inline","p-0","m-0");
                    pElm.textContent = input;
                    
                    liElm.append(iElm,inputElm,pElm,iElm2);
                    todoList.appendChild(liElm);
                    document.getElementsByClassName("taskInput")[0].value="";
                    addTaskBtn.disabled=false;
                    
                },
                error: function(error) {
                    console.error('Error deleting image:', error);
                }
            })})
        }
    })

    var todoItems = document.getElementsByClassName("todo-item");
    for (const item of todoItems) {
        item.addEventListener("change",toggleTask)
    }

    function toggleTask(e){
        const taskId = e.target.getAttribute("data-taskId");
        $.ajax({
            url: `todos/${taskId}/toggleCompleted`,
            type: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                console.log(response.message);
                e.target.parentElement.classList.toggle('completed');
            },
            error: function(error) {
                console.error('Error deleting image:', error);
            }
        });
    }
    
    var trashIcones = document.getElementsByClassName("trashIcone");
    for(const icone of trashIcones) {
        icone.addEventListener("click",deleteTask);
    }

    function deleteTask(e){
        const taskId = e.target.parentElement.children[1].getAttribute("data-taskId");
        $.ajax({
            url:`todos/${taskId}`,
            type:"DELETE",
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                e.target.parentElement.style.display="none";
            },
            error: function(error) {
                console.error('Error deleting image:', error);
            }
        })
    }

    $( function() {
        $('.connectedSortable').sortable({
            placeholder: 'sort-highlight',
            connectWith: '.connectedSortable',
            handle: '.card-header, .nav-tabs',
            forcePlaceholderSize: true,
            zIndex: 999999
        })
        $('.connectedSortable .card-header,.handle').css('cursor', 'move')
        
        $('.todo-list').sortable({
            placeholder: 'sort-highlight',
            handle: '.handle',
            forcePlaceholderSize: true,
            zIndex: 999999
        })
    });
</script>
@endsection