<?php

namespace Modules\Cities\Services;

use App\Jobs\DeleteProduct;
use Illuminate\Support\Arr;
use Modules\Products\Entities\Product;

class SortCitiesService
{
    public function __construct()
    {
        $this->url = 'https://apibeta.gonitros.com/api/guest/cities/191';
    }

    public function sortCities()
    {
        $response = file_get_contents($this->url);
        $cities = json_decode($response,true);
        $cities = collect($cities['data']);
        $sortedCities = $cities->sortBy('name_ar');
        $ids = [];
        foreach($sortedCities as $key => $value){
            $ids[$key] = $value['id'];
        }
        return $ids;
    }

}
