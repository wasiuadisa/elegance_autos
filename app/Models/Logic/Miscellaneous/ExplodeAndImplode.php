<?php

namespace App\Models\Logic\Miscellaneous;

class ExplodeAndImplode
{
    //E.g. $string = "cbkjakbnd--klnvdj"
    //E.g. $splittingParameter = '--'
    public function myExplode($string, $splittingParameter)
    {
        $exploded_pieces = explode($splittingParameter, $string);

        return $exploded_pieces; //array($exploded_pieces[0], $exploded_pieces[1])
    }

    //E.g. $array = array($exploded_pieces[0], $exploded_pieces[1])
    //E.g. $mergeParameter = ' '
    public function myImplode($array, $mergeParameter)
    {
        $imploded_pieces = implode($mergeParameter, $array);

        return $imploded_pieces; //"cbkjakbnd klnvdj"
    }

    //E.g. $string = "cbkjakbnd--klnvdj"
    //E.g. $splittingParameter = '--'
    //E.g. $mergeParameter = ' '
    public function explodeThenImplode($string, $splittingParameter, $mergeParameter)
    {
        $MyExploded_String = $this->myExplode($string, $splittingParameter);
        $MyImploded_Array = $this->myImplode($MyExploded_String, $mergeParameter);

        return $MyImploded_Array;
    }
}
