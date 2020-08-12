@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive.dataTables.min.css') }}">
<style>
    #event-list{
        width: auto !important;
    }
</style>
@section('content')
@if($message = Session::get('success'))
    <h2 class="inline-block p-2 bg-green-400 w-full mb-2">{{ $message }}</h2>
@endif
<div class="bg-white border-transparent rounded-lg shadow-lg overflow-hidden mx-8 mt-24">
        <div class="bg-gray-200 border-b-2 rounded-tl-lg rounded-tr-lg p-2">
            <h5 class="font-semibold bg-gray-200 text-gray-700 uppercase ">Event Has Been Booked</h5>
        </div>
        <div class="p-5">
            <table class="p-5 text-gray-700 w-full" id="event-list">
                <thead>
                    <tr>
                        <th class="text-left text-blue-900">No.</th>
                        <th class="text-left text-blue-900">Event Name</th>
                        <th class="text-left text-blue-900">Location</th>
                        <th class="text-left text-blue-900">Date time</th>
                        <th class="text-left text-blue-900">Description</th>
                        <th class="text-left text-blue-900">Image</th>
                        <th class="text-left text-blue-900">Cancel</th>
                    </tr>
                </thead>

                <tbody>
                    @php $i = 1; @endphp
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $event['event_name'] }}</td>
                            <td>{{ $event['location'] }}</td>
                            <td>{{ $event['date_time'] }}</td>
                            <td>{{ $event['description'] }}</td>
                            <td><img src="{{ asset('images/'.$event['image'].'') }}" alt="" srcset=""></td>
                            <td class="text-center">
                                <form action="/events/booked/{{$event->id}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="p-2 text-red-500"><i class="text-lg fas fa-trash"></i></button>
                                </form>             
                            </td>
                        </tr>
                        @php $i++ @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/table Card-->
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