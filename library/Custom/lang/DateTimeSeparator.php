<?php

class Custom_Lang_DateTimeSeparator
{
    /**
     *
     * @param <String> $datevalue
     * @return <Array> $timeArr
     * @author Parag
     * @Discription : This is used to separate YMDHIS(Year,Month,Date,Hour,mInute,Second) from the value and storing it in Array
     *
     */
    public static function timeSeparator($datevalue)
    {
        $timeArr = array();
        if($datevalue)
        {
            $timeArr['year'] = substr($datevalue,0,4);
            $timeArr['month'] = substr($datevalue,4,2);
            $timeArr['date'] = substr($datevalue,6,2);
            $timeArr['hour'] = substr($datevalue,8,2);
            $timeArr['minute'] = substr($datevalue,10,2);
            $timeArr['second'] = substr($datevalue,12,2);
        }
        return $timeArr;
    }

    /**
     *
     * @param <String> $datevalue
     * @return <Array> $dateArr
     * @author Parag
     * @Discription : This is used to separate YMD(Year,Month,Date) from the value and storing it in Array
     *
     */
    public static function dateSeparator($datevalue)
    {
        $dateArr = array ();
        if($datevalue)
        {
            $dateArr['year'] = substr($datevalue,0,4);
            $dateArr['month'] = substr($datevalue,4,2);
            $dateArr['date'] = substr($datevalue,6,2);
        }
        return $dateArr;
    }

    /**
     *
     * @param <String> $datevalue
     * @param <String> $timevalue
     * @return string
     * @author Parag
     * @Discription : This is used to combine the date and time so that it can be stored into the database
     *
     */
    public static function timeConcatinate($datevalue,$timevalue)
    {
        $timeArr = array ();
        $combineDateTimeValue = null;
        if($datevalue && $timevalue)
        {
            $timeArr['hour'] = substr($timevalue,0,2);
            $timeArr['minute'] = substr($timevalue,3,2);
            $combineDateTimeValue = $datevalue.$timeArr['hour'].$timeArr['minute'].'00';
        }
        return $combineDateTimeValue;
    }

    /**
     *
     * @param <String> $datevalue
     * @return string 
     * @author Parag
     * @Discription : This is used to combine the date so that it can be stored into the database 
     */
    public static function dateConcatinate($datevalue)
    {
        $dateArr = array ();
        $combineDateValue = null;
        if($datevalue)
        {
            $dateArr['month'] = substr($datevalue,0,2);
            $dateArr['date']= substr($datevalue,3,2);
            $dateArr['year'] = substr($datevalue,6,4);
            $combineDateValue = $dateArr['year'].$dateArr['month'].$dateArr['date'];
        }
        return $combineDateValue;
    }

    public static function dateConcatinateByDateFirst($datevalue)
    {
        $dateArr = array ();
        $combineDateValue = null;
        if($datevalue)
        {
            $dateArr['date'] = substr($datevalue,0,2);
            $dateArr['month']= substr($datevalue,3,2);
            $dateArr['year'] = substr($datevalue,6,4);
            $combineDateValue = $dateArr['year'].$dateArr['month'].$dateArr['date'];
        }
        return $combineDateValue;
    }

    public static function shorttimeSeparator($datevalue)
    {
        $timeArr = array();
        if($datevalue)
        {
            $timeArr['hour'] = substr($datevalue,0,2);
            $timeArr['minute'] = substr($datevalue,2,2);
            $timeArr['second'] = substr($datevalue,4,2);
        }
        return $timeArr;
    }
}

?>