<?php

namespace CommunBundle\Tools;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Tools 
{
    public static  function isLatitude($lat)
    {
        if ( !preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/", $lat) ) 
        {
            return false;
        }
        return true;
    }
    
    public static  function isLongitude($long)
    {
        if ( !preg_match("/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,6}$/", $long) )
        {
            return false;
        }
        return true;
    }
    
    public static function uploadFile(UploadedFile $file, $dir)
    {
        $file_name = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($dir, $file_name);
        return $file_name;
    }
    
    public static function isTime($time)
    {
        return preg_match('/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/', $time);
    }
    
    /**
     * 
     * @param time $t1
     * @param time $t2
     * @return integer 0:$t1=$t2, 1:$t1>$t2, 2:$t1<$t2 
     */
    public static function compareTowTimes($t1, $t2)
    {
        if (strtotime($t1) < strtotime($t2))
        {
            return 2;
        } else if (strtotime($t1) > strtotime($t2))
        {
            return 1;
        }
        
        return 0;
    }
    
    public static function isInt($value)
    {
        return preg_match('/^[0-9]+$/', $value);
    }
    
    public static function isMonth($month)
    {
        return preg_match('/^((1[0-2]|0[1-9])-[0-9]{4})$/', $month);
    }
}
