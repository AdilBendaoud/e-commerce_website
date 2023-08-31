<link rel="icon" type="image/png" href="/images/favicon.png" sizes="16x16">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('css/toastr.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

<!--Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<!-- Load fonts style after rendering the layout styles -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
<link rel="stylesheet" href="{{asset('css/templatemo.css')}}">
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
<link rel="stylesheet" href="{{ asset('css/xzoom.min.css') }}">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<style>
    #myTable_length select{
        padding: 0 !important;
        width: 55px;
        height: 30px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button{
        padding: 2px !important;
        margin: 0 !important;
    }
    #myTable_filter,#myTable_length {
        padding: 5px;
        padding-top: 12px;
    }
    #myTable_paginate{
        padding: 0 5px;
    }
    .admin-nav-link:hover div{
        background-color:rgba(255, 255, 255,0.1);
    }
    .admin-nav-link:hover div span{
        color:white;
    }
    .admin-nav-link:hover div i{
        color:white !important;
    }
    
    .hideSpin::-webkit-inner-spin-button,
    .hideSpin::-webkit-outer-spin-button{
        -webkit-appearance: none;
        margin: 0;
    }
    .closeBtn{
        background-color: red;
        color: white;
        position: absolute;
        top:-10px;
        right: -10px;;
        width: 22px;
        height: 23px;
        border-radius: 100%;
        border: none; /* Remove default button border */
        cursor: pointer;
    }
    .mydiv{
        position: relative;
        display: inline-block;
    }
    .x{
        position: relative;
        top: -10px;
        right: 0px;
        font-size: 24px;
    }
    .order_details p{
        font-size: 14px;
        padding: 0 15px;
    }

    .table-container {
        display: flex;
        flex-direction: column;
        border: 1px solid #ccc;
        padding: 10px;
    }

    .table-row {
        display: flex;
        border-bottom: 1px solid #ccc;
        padding: 5px 0;
    }

    .table-cell {
        flex: 1;
        padding: 5px;
    }
    .onHold{
        background-color: #f9dd9f;
        color: rgb(216, 139, 0);
    }

    .processing{
        background-color: #b5e1c9;
        color: #358422;
    }

    .shipped{
        background-color: #c3d7e2;
        color: #274457;
    }

    .switch-order-status{
        border: 1px solid #ccc;
        border-radius: 3px;
        padding: 5px 10px;
    }

    .switch-order-status:hover{
        border-color: gray;
    }

    #generate_coupon_btn{
        padding: 5px 7px;
        background-color: white;
        color: #0064ff;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    #generate_coupon_btn:hover{
        background-color: #e0e0e0;
    }
    .fa-circle-xmark:hover{
        color:red !important;
    }
    .gray-strikethrough {
        color: gray;
        align-self: center;
        text-decoration: line-through;
        font-size: 16px;
    }
    .primary-color {
        color: var(--primary);
    }

    @media (min-width: 769px) {
        #desktop-table {
            display: table;
        }
        #mobile-table {
            display: none;
        }
    }
    @media (max-width: 768px) {
        #desktop-table {
            display: none;
        }
        #mobile-table {
            display: table;
        }
    }
    #payment-form label::after{
        content: "*";
        color: red;
        font-weight: bold;
    }
    .product-details-image{
        transition: all 1s ease-in-out;
    }
    @media (min-width:1200px) {
        .product-details-image{
            max-height: 500px;
        }
    }

</style>