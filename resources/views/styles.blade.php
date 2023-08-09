<link rel="icon" type="image/png" href="/images/favicon.png" sizes="16x16">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('css/toastr.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
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
</style>