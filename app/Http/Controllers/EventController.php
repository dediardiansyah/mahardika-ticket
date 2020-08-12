<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    //otomatis ubah status ke deadactive ketika tanggal event sudah terlewat
    public function __construct()
    {
        //ambil semua data event
        $events = Event::all();
        //kemudian cek satu persatu apakah ada tanggal dan waktu yg dibawah dari waktu sekarang
        foreach ($events as $event) {
            if(strtotime($event['date_time']) < strtotime(Carbon::now()) && $event['status'] = 1){
                //cari event yg ingin di update sesuai id yg didapatkan pada event yg sudah dicek
                $event_update = Event::findOrFail($event['id']);
                //kemudian ubah status
                $event_update->update([
                    'status' => 0,
                ]);
            };
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('event.index',compact('events'));
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required',
            'description' => 'required',
            'location'  => 'required',
            'date_time' => 'required',
            'image' => 'required|image',
          ]);

        $event = Event::create($request->all());
        $imageName = $event->id.'-'.$event->event_name.'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        $event->image = $imageName;
        $event->status = 1;
        $event->save();


        return redirect()->route('events.create')
            ->with('success','Event created successfully');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event.show',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'event_name' => 'required',
            'description' => 'required',
            'location'  => 'required',
            'date_time' => 'required',
          ]);
        
        $event = Event::findOrFail($id);
        $event->update([
            'event_name' => $request->event_name,
            'description' => $request->description,
            'location' => $request->location,
            'date_time' => $request->date_time,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        if($request->hasFile('image')){
            if(\File::exists(public_path('images/'.$event->image))){

                \File::delete(public_path('images/'.$event->image));
                $imageName = $event->id.'-'.$event->event_name.'.'.$request->image->extension();  
                $request->image->move(public_path('images'), $imageName);
                $event->image = $imageName;
                $event->save();
            
              }else{

                $imageName = $event->id.'-'.$event->event_name.'.'.$request->image->extension();  
                $request->image->move(public_path('images'), $imageName);
                $event->image = $imageName;
                $event->save();

            }
        }

        return redirect()->route('events.index')
            ->with('success','Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
  
        return redirect()->route('events.index')
                        ->with('success','Event deleted successfully');
    }
    
    public function eventList()
    {
        $event = new Event;
        $events = $event->getActiveEvents();
        return view('event',compact('events'));
    }

    public function bookEvent($id){
        $userId = Auth::user()->id;
        $user = User::find($userId); 
        $events = [$id];
        $user->events()->attach($events);
        return redirect('/events')
            ->with('success','Event booked successfully');
    }
    public function bookedEvent(){
        $userId = Auth::user()->id;
        $user = User::find($userId); 	
        $events = $user->events;
        return view('event.booked',compact('events'));
    }

    public function cancelBookedEvent($id)
    {
        if(DB::table('event_user')->where('id', '=', $id)->delete()){
            return redirect('/events/booked')
            ->with('success','canceled event booked successfully'); 
        }
            return redirect('/events/booked'); 
    }
}
