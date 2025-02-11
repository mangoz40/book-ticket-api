<?php

namespace App\Repositories\Eloquent;

use App\Models\Event;
use App\Repositories\Interfaces\EventRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentEventRepository implements EventRepositoryInterface
{
    public function all(): Collection
    {
        return Event::all();
    }

    public function find(int $id): ?Event
    {
        return Event::find($id);
    }

    public function create(array $data): Event
    {
        return Event::create($data);
    }

    // ... implement other interface methods ...
}