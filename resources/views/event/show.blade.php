@extends('layouts.app')
@section('content')
<div class="mt-20 bg-white m-4 rounded-lg overflow-hidden">
    <div class="w-full md:w-full bg-center bg-cover" style="height:500px;background-image:url('{{ asset('images/'.$event->image.'') }}')"></div>
    <div class="flex flex-wrap overflow-hidden mx-5 justify-between">
        <div>
            <h1 class="text-2xl md:text-4xl mb-4 font-semibold">{{$event->event_name}}</h1>
            <h2 class="text-orange-600 font-semibold mb-4"><i class="far fa-calendar-alt mr-4"></i>{{$event->date_time}}</h2>
            <!-- <h2 class="text-orange-600 font-semibold mb-4"><i class="fas fa-clock mr-4"></i>{{$event->date_time}}</h2> -->
            <h2 class="text-orange-600 font-semibold"><i class="fas fa-map-marked-alt mr-4"></i>{{$event->location}}</h2>

        </div>
        <div class="font-semibold">
            <h1 class="text-2xl md:text-4xl md:pt-16 md:mr-16 mb-3">Rp. {{$event->price}},~</h1>
        </div>
    </div>
    <div class="mt-8 m-5">
        <h1 class="font-semibold text-2xl mb-4">Decription</h1>
        <p>{{ $event->description }}</p>
    </div>
    <div class="flex justify-end">
        <form action="/events/book/{{$event->id}}" method="POST">
            @csrf
            @method('post')
            <button type="submit" class="p-2 h-16 w-40 bg-green-500 text-white m-10">Booking Event</button>
        </form>
    </div>
</div>
@endsection