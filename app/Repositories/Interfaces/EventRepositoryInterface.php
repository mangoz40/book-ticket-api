<?php

namespace App\Repositories\Interfaces;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

interface EventRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Event;
    public function create(array $data): Event;
    // ... more methods as needed (update, delete, etc.) ...
}