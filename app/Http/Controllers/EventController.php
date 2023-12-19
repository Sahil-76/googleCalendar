<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Services\EventService;
use App\Http\Requests\createEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Requests\CreateEventRequest as RequestsCreateEventRequest;
use App\Http\Services\GoogleService;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('events.list');
    }


    public function refetchEvents(Request $request)
    {
        if (auth()->check()) {

            $eventService = new EventService(auth()->user());
            $eventsData = $eventService->allEvents($request->all());

            return response()->json($eventsData);
        } else {

            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateEventRequest $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $eventService = new EventService(auth()->user());
        $event = $eventService->create($data);

        if ($event) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(UpdateEventRequest $request, $id)
    {
        $data = $request->all();
        $eventService = new EventService(auth()->user());
        $event = $eventService->update($id, $data);

        if ($event) {
            return response()->json([
                'success' => true,
                //'data' => $event,
            ]);
        } else {
            return response()->json([
                'success' => false,

            ]);
        }
    }
    public function destroy($id)
    {
        // Use findOrFail to get a single model instance
        $event = Event::findOrFail($id);

        // Perform the delete on the individual model instance
        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully.',
        ]);
    }


    public function resizeEvent(Request $request, $id)
    {
        // dd($request->all());
        $data = $request->all();
        if (isset($data['is_all_day']) && $data['is_all_day'] == 1) {
            $data['end'] = Carbon::createFromTimestamp(strtotime($data['end']))
                ->subDays(1)
                ->toDateString();
        }
        $eventService = new EventService(auth()->user());

        $event = $eventService->update($id, $data);

        if ($event) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
