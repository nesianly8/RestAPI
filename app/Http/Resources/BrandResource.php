<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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

            // 'test' => $test,
            // 'test2' => 'Hallo Test Tambah Collect Langsung'
        ];
    }
}
