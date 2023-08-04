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
</style>