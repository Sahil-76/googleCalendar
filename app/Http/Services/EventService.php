<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;

class EventService
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($data)
    {
        $event = $this->user->events()->create($data);

        return $event;
    }


    public function update($id, $data)
    {
        $event = Event::find($id);
        $event->fill($data);
        $event->save();
        return event();
    }
    public function allEvents($filters)
    {
        $eventQuery = Event::query();
        $eventQuery->where('user_id', $this->user->id);

        if ($filters['start']) {
            $eventQuery->where('start', '>=', $filters['start']);
        }


        if ($filters['end']) {
            $eventQuery->where('end', '<=', $filters['end']);
        }
        $events = $eventQuery->get();
        $data = [];
        foreach ($events as $event) {
            if (!(int)$event['is_all_day']) {
                $event['allDay'] = false;
                $event['start'] = Carbon::createFromTimestamp(strtotime($event['start']))->toDateTimeString();
                $event['end'] = Carbon::createFromTimestamp(strtotime($event['end']))->toDateTimeString();
                $event['endDay'] = $event['end'];
                $event['startDay'] = $event['start'];
            } else {
                $event['allDay'] = true;

                $event['endDay'] = Carbon::createFromTimestamp(strtotime($event['end']))->toDateString();
                $event['end'] = Carbon::createFromTimestamp(strtotime($event['end']))->addDay()->toDateString();
                $event['startDay'] = $event['start'];
            }
            $event['eventid'] = $event['id'];
            $event['backgroundColor'] = '#' . sprintf('%02X%02X%02X', rand(0,255), rand(0,255), rand(0,255));
            $event['borderColor']     = '#' . sprintf('%02X%02X%02X', rand(0,255), rand(0,255), rand(0,255));
    
            array_push($data, $event);
        }
        return $data;
    }
}
