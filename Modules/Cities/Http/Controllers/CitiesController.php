<?php

namespace Modules\Cities\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cities\Services\SortCitiesService;

class CitiesController extends Controller
{
    public function sort(SortCitiesService $service )
    {
        $cities = $service->sortCities();
        return response()->json(['status'=>'success','data'=>$cities]);

    }
}
