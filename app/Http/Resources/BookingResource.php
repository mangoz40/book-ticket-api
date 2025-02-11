<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'event_id' => $this->event_id,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'quantity' => $this->quantity,
            'qr_code_url' => asset($this->qr_code), // Create URL to access QR code
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}