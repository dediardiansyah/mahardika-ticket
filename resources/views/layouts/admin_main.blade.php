@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive.dataTables.min.css') }}">
<style>
    #event-list{
        width: auto !important;
    }
</style>
@endsection
@section('content')
<div class="flex flex-col md:flex-row">
    <div class="bg-white shadow-lg fixed bottom-0 md:relative md:min-h-screen z-10 w-full md:w-48 border-t-2">

        <div class="md:mt-12 md:w-48 md:left-0 md:top-0 content-center md:content-start text-left justify-between">
            <ul class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left">
                <li class="mr-3 flex-1">
                    <a href="/admin/events" class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline border-b-2 border-gray-800 hover:border-blue-600">
                        <i class="fas fa-tasks pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-800 block md:inline-block">Event List</span>
                    </a>
                </li>
                <li class="mr-3 flex-1">
                    <a href="/admin/events/create" class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline border-b-2 border-gray-800 hover:border-blue-600">
                        <i class="fa fa-envelope pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-800 block md:inline-block">Add Event</span>
                    </a>
                </li>
                <li class="mr-3 flex-1">
                    <a href="#" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-gray-800 no-underline border-b-2 border-gray-800 hover:border-blue-600">
                        <i class="fa fa-wallet pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-800 block md:inline-block">Recycle Bin</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
        @yield('main_content')
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script>
    $(document).ready(function() {
    $('#event-list').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll()
            }
        }
    } );
} );
</script>
@endsection