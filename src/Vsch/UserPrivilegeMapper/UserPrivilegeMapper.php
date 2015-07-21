<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 15-07-21
 * Time: 5:01 PM
 */

namespace Vsch\UserPrivilegeMapper;

use Illuminate\Support\Traits\MacroableTrait;

class UserPrivilegeMapper
{
    use MacroableTrait;

    /**
     * UserPrivilegeMapper constructor.
     *
     * @param $app
     */
    public
    function __construct($app)
    {
    }

    public static function __callStatic($method, $parameters)
    {
        if (static::hasMacro($method))
        {
            return call_user_func_array(static::$macros[$method], $parameters);
        }

        return false;
    }

}
