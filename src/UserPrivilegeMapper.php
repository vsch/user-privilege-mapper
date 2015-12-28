<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 15-07-21
 * Time: 5:01 PM
 */

namespace Vsch\UserPrivilegeMapper;

use Closure;
use Illuminate\Support\Traits\Macroable;

class UserPrivilegeMapper
{
    use Macroable;

    public static function __callStatic($method, $parameters)
    {
        if (static::hasMacro($method)) {
            if (static::$macros[$method] instanceof Closure) {
                return call_user_func_array(Closure::bind(static::$macros[$method], null, get_called_class()), $parameters);
            } else {
                return call_user_func_array(static::$macros[$method], $parameters);
            }
        }

        return false;
    }

    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            if (static::$macros[$method] instanceof Closure) {
                return call_user_func_array(static::$macros[$method]->bindTo($this, get_class($this)), $parameters);
            } else {
                return call_user_func_array(static::$macros[$method], $parameters);
            }
        }

        return false;
    }

}
