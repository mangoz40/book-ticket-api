<?php

namespace App\Repositories\Eloquent;

use App\Models\Booking;
use App\Repositories\Interfaces\BookingRepositoryInterface;

class EloquentBookingRepository implements BookingRepositoryInterface
{
    public function create(array $data): Booking
    {
        return Booking::create($data);
    }

    public function find(int $id): ?Booking
    {
        return Booking::find($id);
    }
    // ... implement other interface methods ...
}