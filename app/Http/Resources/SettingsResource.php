<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'Terms Of Use' => $this->terms_of_use,
            'Why Us' => $this->why_us,
            'About Us' => $this->about_us,
            'Contact Us' => $this->contact_us,
            // 'goal' => $this->goal,   // Error
        ];
    }
}
