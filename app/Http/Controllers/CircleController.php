<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Model\Circle;

class CircleController extends Controller {
    /**
    * Generate Image upload view page
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request) {
        if (!is_numeric($request->radius)) {
            $data = array(
                'status' => 'error',
                'message' => 'Parameter in route has to be numeric!'
            );
            return Response::json($data, 500);
        }

        $circle = new Circle($request->radius);

        $data['type'] = "circle";
        $data['radius'] = round($request->radius, 2);
        $data['surface'] = round($circle->getSurface(), 2);
        $data['circumference'] = round($circle->getCircumference(), 2);

        return $data;
    }
}
