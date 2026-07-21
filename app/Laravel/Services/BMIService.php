<?php
namespace App\Laravel\Services;

use App\Laravel\Models\{EventSaleReport, Event};

/* App Classes
 */
use Carbon\{Carbon, CarbonPeriod};

class BMIService{
    private function remarks($bmi) {
        switch (true) {
            case ($bmi < 18.5):
                return "Underweight";

            case ($bmi < 25.0):
                return "Normal weight";

            case ($bmi < 30.0):
                return "Overweight";

            case ($bmi < 35.0):
                return "Obese Class I";

            case ($bmi < 40.0):
                return "Obese Class II";

            default:
                return "Obese Class III";
        }
    }

    public function compute($weight, $height/*, $sex, $birthdate*/){
        // $current_date = now();

        // convert cm to m
        $height_meters = $height / 100;
        
        $output = $weight / ($height_meters ** 2);
        $remarks = $this->remarks($output);

        return (object) ['bmi'=> round($output, 2), 'remarks'=>$remarks];
    }
}
