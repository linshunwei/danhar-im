<?php
namespace Linshunwei\DanharIm\Facades;
use Illuminate\Support\Facades\Facade;
class DanharIm extends Facade
{
    public static function getFacadeAccessor()
    {
        //return 的字符串会在相应的provider中使用
        return 'danharim';
    }
}
