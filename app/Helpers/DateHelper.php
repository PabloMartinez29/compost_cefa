<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Obtiene la fecha actual en formato colombiano
     */
    public static function getCurrentDate()
    {
        return Carbon::now('America/Bogota')->format('d/m/Y');
    }

    /**
     * Obtiene la fecha y hora actual en formato colombiano
     */
    public static function getCurrentDateTime()
    {
        return Carbon::now('America/Bogota')->format('d/m/Y H:i:s');
    }

    /**
     * Obtiene solo la hora actual en formato colombiano
     */
    public static function getCurrentTime()
    {
        return Carbon::now('America/Bogota')->format('H:i:s');
    }
}
