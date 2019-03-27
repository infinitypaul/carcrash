<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = collect($this['Results']);
        return [
            'Count' => count($result),
            'Results' => VehicleResultResources::collection($result)
        ];
    }
}
