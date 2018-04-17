<?php

namespace Iget\CieloCheckout;

use Illuminate\Support\Facades\Facade;

class CieloFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'cielo';
    }
}