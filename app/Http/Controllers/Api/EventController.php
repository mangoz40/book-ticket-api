<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $eventRepository; // Inject repository

        public function __construct(EventRepositoryInterface $eventRepository) // Constructor injection
        {
            $this->eventRepository = $eventRepository;
        }

        public function index()
        {
            $events = $this->eventRepository->all(); // Use repository
            return EventResource::collection($events);
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required | string | max:255',
            'date' => 'required | date',
            'price' => 'required | numeric | min:0'
        ]);

        $event = Event::create($request->all());
        return new EventResource($event);
    }

    public function show($id) // Show takes ID now
    {
        $event = $this->eventRepository->find($id); // Use repository
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        return new EventResource($event);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
