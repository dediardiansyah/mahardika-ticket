@extends('layouts.admin_main')

@section('main_content')
<div class="bg-gray-200 p-2 shadow text-xl text-gray-800 tex-gray">
    <h3 class="font-bold pl-2 text-gray-700">Event List</h3>
</div>

<div class="flex flex-wrap">
    <div class="w-full md:w-1/2 p-3">
        <!--Metric Card-->
        <div class="bg-green-100 border-b-4 border-green-600 rounded-lg shadow-lg p-5">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-5 bg-green-600"><i class="fa fa-ticket-alt fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-gray-800">Sold Tickets</h5>
                    <h3 class="font-bold text-3xl">3249 <span class="text-green-500"><i class="fas fa-caret-up"></i></span></h3>
                </div>
            </div>
        </div>
        <!--/Metric Card-->
    </div>
    <div class="w-full md:w-1/2 p-3">
        <!--Metric Card-->
        <div class="bg-orange-100 border-b-4 border-orange-500 rounded-lg shadow-lg p-5">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-5 bg-orange-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-gray-800">Total Users</h5>
                    <h3 class="font-bold text-3xl">249 <span class="text-orange-500"><i class="fas fa-exchange-alt"></i></span></h3>
                </div>
            </div>
        </div>
        <!--/Metric Card-->
    </div>
</div>
<div class="w-full p-3">
    <!--Table Card-->
    @if($message = Session::get('success'))
        <h2 class="inline-block p-2 bg-green-400 w-full mb-2">{{ $message }}</h2>
    @endif
    <div class="bg-white border-transparent rounded-lg shadow-lg overflow-hidden ">
        <div class="bg-gray-200 border-b-2 rounded-tl-lg rounded-tr-lg p-2">
            <h5 class="font-semibold bg-gray-200 text-gray-700 uppercase ">Table Event List</h5>
        </div>
        <div class="p-5">
            <table class="p-5 text-gray-700 w-full" id="event-list">
                <thead>
                    <tr>
                        <th class="text-left text-blue-900">No.</th>
                        <th class="text-left text-blue-900">Event Name</th>
                        <th class="text-left text-blue-900">Location</th>
                        <th class="text-left text-blue-900">Date time</th>
                        <th class="text-left text-blue-900">Price</th>
                        <th class="text-left text-blue-900">Stock</th>
                        <th class="text-left text-blue-900">Description</th>
                        <th class="text-left text-blue-900">Image</th>
                        <th class="text-left text-blue-900">Status</th>
                        <th class="text-left text-blue-900">Action</th>
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
                            <td>{{ $event['price'] }}</td>
                            <td>{{ $event['stock'] }}</td>
                            <td>{{ $event['description'] }}</td>
                            <td><img src="{{ asset('images/'.$event['image'].'') }}" alt="" srcset=""></td>
                            <td>{!! $event['status'] == 1 ? '<span class="text-green-500 font-semibold">active<span>' : '<span class="text-red-500 font-semibold">deadactive<span>' !!}</td>
                            <td>
                                <div class="flex">
                                    <a href="{{ route('events.edit',$event['id']) }}" class="text-lg p-2 mr-2 text-orange-500"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('events.destroy',$event->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="p-2 text-red-500"><i class="text-lg fas fa-trash"></i></button>
                                    </form>             
                                </div>
                            </td>
                        </tr>
                        @php $i++ @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/table Card-->
</div>
@endsection


