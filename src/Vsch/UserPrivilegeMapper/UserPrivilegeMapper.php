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

    protected $app;

    /**
     * UserPrivilegeMapper constructor.
     *
     * @param $app
     */
    public
    function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param string $privilege text name of the privilege to test for the currently logged in user
     *
     * @return bool
     */
    public
    function isUserPrivilegedTo($privilege)
    {
        $user = Auth::user();

        if ($user && !self::hasMacro($privilege)) return false;

        return self::$privilege($user);
    }
}
