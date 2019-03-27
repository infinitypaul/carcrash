<?php

namespace App\Http\Controllers;

use App\Http\Resources\CrashRatingResources;
use App\Http\Resources\VehicleResources;
use App\Services\nhtsaApiRequest;
use Illuminate\Http\Request;

class VehicleControllers extends Controller
{


    /**
     * Check Car Base on Request From The USer
     * @return \App\Http\Resources\CrashRatingResources|\App\Http\Resources\VehicleResources
     */
    public function checkCar(){
        $resource =config('services.nhtsa.base_url').'modelyear/'.request('modelYear').'/make/'.request('manufacturer').'/model/'.request('model').'?format=json';
        $vehicles = (new nhtsaApiRequest($resource))
            ->makeRequest()
            ->getResponseData();
        if (request('withRating') && request('withRating') == 'true'  && !empty($vehicles['Results'])) {
            $collection = collect($vehicles['Results'])->chunk(3);
           return $this->CrashRating($collection);
        } else {
            return new VehicleResources($vehicles);
        }

    }

    /**
     * @param $vehicles
     *
     * Get Car Rating
     *
     * @return \App\Http\Resources\CrashRatingResources
     */
    private function CrashRating($vehicles){
        $data = [];
        foreach($vehicles as $vehicle) {
            foreach ($vehicle as $rating){
               $data['Results'][] = $this->getVehicleId($rating['VehicleId']);
            }
        }
        return new CrashRatingResources($data);
    }

    /**
     * @param $id
     *
     * Get Vehicle Rating By ID
     * @return array
     */
    private function getVehicleId($id){
        $resource =config('services.nhtsa.base_url').'VehicleId/'.$id.'?format=json';
        $resp = (new nhtsaApiRequest($resource))
            ->makeRequest()
            ->getResponseData();
        if (isset($resp['Results']) && !empty($resp['Results'])) {
            return $resp['Results']['0'];
        }

        return [];

    }

}
