@extends('layouts.admin_main')
@section('main_content')
<div class="w-full mx-auto">

<div class="bg-gray-200 p-2 shadow text-xl text-gray-800 tex-gray">
    <h3 class="font-bold pl-2 text-gray-700">Add Event</h3>
</div>
    <!--Template Card-->
    @if($message = Session::get('success'))
        <h2 class="inline-block p-2 bg-green-400 w-full mb-2">{{ $message }}</h2>
    @endif
    <div class="bg-white border-transparent rounded-lg shadow-lg m-4">
        <div class="bg-gray-400 border-b-2 border-gray-500 rounded-tl-lg rounded-tr-lg p-2">
            <h5 class="font-bold uppercase text-gray-600">Form Add Event</h5>
        </div>
        <div class="p-5">
        @if ($errors->any())
        <div class="bg-red-400">
            <ul>
                @foreach ($errors->all() as $error)
                <li class="p-2">{{ $error }}</li>
                @endforeach
            </ul>
        </div><br/>
        @endif
        <form action="{{ route('events.store') }}" method="post" class="" enctype="multipart/form-data">
            @CSRF
            <div class="mb-4">
                <label class="block mb-2 text-gray-700 font-bold" for="event_name">event name</label>
                <input type="text" name="event_name" id="event_name" class="border-2 border-gray-400 p-2 w-full rounded focus:outline-none focus:border-gray-600">    
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700 font-bold" for="description">Description</label>
                <textarea name="description" id="description" rows="5" class="border-2 border-gray-400 p-2 w-full rounded focus:outline-none focus:border-gray-600"></textarea>
            </div>
            <div class="md:flex justify-between">
                <div class="mb-4 flex-1 md:mr-2">
                    <label class="block mb-2 text-gray-700 font-bold" for="location">Location</label>
                    <input type="text" name="location" id="location" class="border-2 border-gray-400 p-2 w-full rounded focus:outline-none focus:border-gray-600">
                </div>
                <div class="mb-4 md:w-56">
                    <label class="block mb-2 text-gray-700 font-bold" for="date_time">Date time</label>
                    <input type="datetime-local" name="date_time" id="date_time" class="border-2 border-gray-400 p-2 w-full rounded focus:outline-none focus:border-gray-600">
                </div>
            </div>
            <div class="md:flex justify-between">
                <div class="mb-4 flex-1 md:mr-2">
                    <label class="block mb-2 text-gray-700 font-bold" for="price">Price</label>
                    <input type="number" name="price" id="price" class="border-2 border-gray-400 p-2 w-full rounded focus:outline-none focus:border-gray-600">
                </div>
                <div class="mb-4 flex-1 md:mr-2">
                    <label class="block mb-2 text-gray-700 font-bold" for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="border-2 border-gray-400 p-2 w-full rounded focus:outline-none focus:border-gray-600">
                </div>
                <div class="mb-4 md:w-56">
                    <label class="block mb-2 text-gray-700 font-bold" for="image">Image</label>
                    <input type="file" name="image" id="image" class="border-2 border-gray-400 p-2 w-full rounded focus:outline-none focus:border-gray-600">
                </div>
            </div>
            <button class="p-4 mt-2 ml-auto border-2 border-gray-700 w-24" type="submit"> Submit </button>
        </form>
        </div>
    </div>
    <!--/Template Card-->
</div>
@endsection
