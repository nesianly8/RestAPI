<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // NAMBAH DATA COLLECT
        // $test = 'Hallo Test Collect';

        return [
            'brand' => $this->brand,
            'description' => $this->description,
            'author' => $this->author,
            'writer' => $this->whenLoaded('writer'),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d')

            // 'test' => $test,
            // 'test2' => 'Hallo Test Tambah Collect Langsung'
        ];
    }
}
