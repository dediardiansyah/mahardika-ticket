@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}">
@endsection
@section('content')
    <div class=" px-12 pt-12 bg-cover bg-center bg-no-repeat"style="background-image:url({{asset('images/head1.png')}}); height:424px;">
        <h1 class="text-center font-bold text-4xl mb-10 md:mb-24">Best Seller</h1>
        <div class="flex justify-between best-seller">
            <div><img src="{{asset('images/Rectangle 2item.png')}}"  class="w-full" alt="" srcset=""></div>
            <div><img src="{{asset('images/Rectangle 2item.png')}}"  class="w-full" alt="" srcset=""></div>
            <div><img src="{{asset('images/Rectangle 2item.png')}}"  class="w-full" alt="" srcset=""></div>
        </div>
    </div>
    @if($message = Session::get('success'))
        <h2 class="inline-block p-2 bg-green-400 w-full mb-2">{{ $message }}</h2>
    @endif
    @foreach($events as $event)
    <a href="/events/show/{{$event->id}}">
        <div class="md:flex justify-between md:h-48 m-8 shadow-lg bg-white">
            <div class="w-full md:w-1/3 bg-center bg-cover h-48" style="background-image:url('{{ asset('images/'.$event->image.'') }}')"></div>
            <div class="flex-1 p-5">
                <h1 class="mb-5 text-2xl md:text-3xl font-semibold">{{$event->event_name}}</h1>
                <h1 class="text-orange-500 font-semibold mb-3">{{$event->date_time}}</h1>
                <h1 class="text-orange-500 font-semibold">{{$event->date_time}}</h1>
            </div>
            <div class="p-5">
                <h1 class="text-2xl mr-5 font-semibold">Rp. {{$event->price}},~</h1>
            </div>     
        </div>
    </a>
    @endforeach
@endsection
@section('script')
<script src="{{ asset('slick/slick.min.js') }}"></script>
<script>
    $('.best-seller').slick({
     slidesToShow: 1,
     slidesToScroll: 3,
     autoplay: false,
     mobileFirst: true,
     responsive: [
        {
           breakpoint: 768,
           settings: "unslick"
        }
     ]
  });
</script>
@endsection