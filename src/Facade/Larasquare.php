<?php

namespace Erdaldemirci\Larasquarev\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @see Erdaldemirci\Larasquarev\Foursquare
 */
class Larasquare extends Facade {

    protected static function getFacadeAccessor() { return 'larasquare'; }

}