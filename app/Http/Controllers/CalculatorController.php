<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Model\Triangle;
use App\Model\Circle;
use App\Services\GeometryCalculator as GC;

class CalculatorController extends Controller {
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

        if ($request_number == 2) {
            $value_1 = new Circle($request->a);
            $value_2 = new Circle($request->b);
            $type = "Two circles";
        } elseif ($request_number == 4) {
            $value_1 = new Circle($request->a);
            $value_2 = new Triangle($request->b, $request->c, $request->d);
            $type = "Circle & triangle";
        } elseif ($request_number == 6) {
            $value_1 = new Triangle($request->a, $request->b, $request->c);
            $value_2 = new Triangle($request->d, $request->e, $request->f);
            $type = "Two triangles";
        } else {
            $data = array(
                'status' => 'error',
                'message' => 'Unknown or wrong route!'
            );
            return Response::json($data, 500);
        }

        $calculate = new GC();
        $surface_sum = $calculate->surfaceSum($value_1, $value_2);
        $circumference_sum = $calculate->circumferenceSum($value_1, $value_2);

        $data['type'] = $type;
        $data['surface_sum'] = round($surface_sum, 2);
        $data['circumference_sum'] = round($circumference_sum, 2);

        return $data;
    }
}
