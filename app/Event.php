<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $guarded = ['image','status'];

    public function getActiveEvents(){
        $events = Event::all();
        $active_events = [];
        foreach ($events as $event) {
            if(strtotime($event['date_time']) >= strtotime(Carbon::now()) && $event['status'] = 1){
                $active_events[] = $event;
            };
        }
        return $active_events;
    }

    public function getEventsDayNow()
    {
        
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_user');
    }
}