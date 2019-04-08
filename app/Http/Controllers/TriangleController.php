<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\MessageBag;

use App\Model\Triangle;
use App\Services\GeometryCalculator as GC;

class TriangleController extends Controller {
    /**
    * Generate Image upload view page
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request) {
        $request_number = count(request()->route()->parameters());
        $only_numeric = array_filter(request()->route()->parameters(), 'is_numeric');

        if (count($only_numeric) != $request_number) {
            $data = array(
                'status' => 'error',
                'message' => 'Parameter in route has to be numeric!'
            );
            return Response::json($data, 500);
        }

        $triangle = new Triangle($request->a, $request->b, $request->c);

        $data['type'] = "triangle";
        $data['a'] = round($request->a, 2);
        $data['b'] = round($request->b, 2);
        $data['c'] = round($request->c, 2);
        $data['surface'] = round($triangle->getSurface(), 2);
        $data['circumference'] = round($triangle->getCircumference(), 2);

        return $data;
    }
}
