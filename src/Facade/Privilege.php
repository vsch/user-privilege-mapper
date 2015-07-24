<?php 

namespace Vsch\UserPrivilegeMapper\Facade;

use Illuminate\Support\Facades\Facade;

class Privilege extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'privilege'; }

}
