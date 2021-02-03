<?php


namespace App\Censure;


class Censurator
{
    public function purify($string) {
        $motVilain = array("navet", "oignon", "butternut");

            foreach($motVilain as $naughty) {

                $string = str_ireplace($naughty, "********", $string);

        }
        return $string;

      }


}