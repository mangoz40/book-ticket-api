<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 
use Illuminate\Http\Request;
use App\Http\Resources\BookingResource;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    protected $bookingRepository; // Inject booking repo

    public function __construct(BookingRepositoryInterface $bookingRepository) // Constructor injection
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'eventId' => 'required',
            'fullName' => 'required|string|max:255',
            'email' => 'required|email',
            'numberOfTickets' => 'required|integer|min:1',
        ]);

        $event = Event::findOrFail($request->eventId);

        if ($event->available_tickets < $request->numberOfTickets && false) { //dont check for now
            return response()->json(['message' => 'Not enough tickets available'], 400);
        }

        $uniqueId = Str::uuid();

        /*$qrCode = QrCode::format('svg')  HOPEFULLY this might be implemented to generate code in backend
                ->size(200)  // Size in pixels
                ->errorCorrection('H')  // High error correction level
                ->generate($uniqueId);
            
            // Convert SVG to base64 for easy transmission
            $base64QrCode = base64_encode($qrCode);*/

       

         $bookingData = $request->only(['eventId', 'fullName', 'email', 'numberOfTickets']);

         //short cut, time is out
         $bookingData2 = ["event_id" => $bookingData["eventId"], "customer_name" => $bookingData["fullName"], "customer_email" => $bookingData["email"], "quantity" => $bookingData["numberOfTickets"]];
         $bookingData2['qr_code'] = $uniqueId . '-' . $bookingData2['event_id'];

         $booking = $this->bookingRepository->create($bookingData2); // Use booking repository to create

         $event->decrement('available_tickets', $request->numberOfTickets);

         //TODOOO return new BookingResource($booking);
         return response()->json(['qrcode' => $bookingData2['qr_code']]);
    }

    /**
     * Display the specified booking. (For viewing purchased tickets, maybe by booking ID)
     */
    public function show($id) // Show takes ID now
    {
        $booking = $this->bookingRepository->find($id); // Use booking repo
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }
        return new BookingResource($booking);
    }

    // List bookings (for user view later - could be filtered by user if you add auth)
    // public function index() { ... }
    

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
