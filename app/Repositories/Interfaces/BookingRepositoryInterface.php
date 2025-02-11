<?php

namespace App\Repositories\Interfaces;

use App\Models\Booking;

interface BookingRepositoryInterface
{
    public function create(array $data): Booking;
    public function find(int $id): ?Booking;
    // ... more methods as needed ...
}