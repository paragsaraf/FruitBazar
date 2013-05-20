<?php
class Custom_Lang_CleanValues
{
    public static function h_($array=array ())
    {       
        foreach ($array as $key => $value)
        {
            $cleanArr[$key]=htmlentities($value);
        } 
        return $cleanArr;
    }
}
?>