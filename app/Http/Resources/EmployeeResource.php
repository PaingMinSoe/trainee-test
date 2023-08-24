<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone_no' => $this->phone_no,
            'address' => $this->address,
            'date_of_birth' => Carbon::parse($this->date_of_birth)->format('d-M-Y'),
            'gender' => $this->gender,
            'job' => $this->job,
        ];
    }
}
