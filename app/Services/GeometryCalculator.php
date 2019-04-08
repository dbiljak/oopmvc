<?php
namespace App\Services;
use App\Model\BaseObject;

class GeometryCalculator {
    public function surfaceSum(BaseObject $a, BaseObject $b) {
        return $a->getSurface() + $b->getSurface();
    }

    public function circumferenceSum(BaseObject $a, BaseObject $b) {
        return $a->getCircumference() + $b->getCircumference();
    }

}
