<?php namespace DevSquared\UnitConvert;

use Illuminate\Support\Facades\Facade;

class UnitConvertFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'unitconvert-laravel';
    }
}