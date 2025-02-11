<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 
use Illuminate\Http\Request;

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
            'event_id' => 'required|exists:events,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'quantity' => 'required|integer|min:1',
        ]);

        $event = Event::findOrFail($request->event_id);

        if ($event->available_tickets < $request->quantity) {
            return response()->json(['message' => 'Not enough tickets available'], 400);
        }

         // Generate QR code (install package later)
         $qrCodeData = Str::uuid(); // Generate a unique identifier for the QR code
         $qrCodePath = 'qrcodes/booking-' . $qrCodeData . '.svg'; // Path to store QR code
         QrCode::size(200)->format('svg')->generate($qrCodeData, public_path($qrCodePath));

       

         $bookingData = $request->only(['event_id', 'customer_name', 'customer_email', 'quantity']);
         $bookingData['qr_code'] = $qrCodePath;

         $booking = $this->bookingRepository->create($bookingData); // Use booking repository to create

         $event->decrement('available_tickets', $request->quantity);

         return new BookingResource($booking);
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
