<?php

namespace Dmr\PhpToJs;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getNamespace()
 * @method static void add(array $items)
 * @method static array all()
 * @method static array variables()
 */
class PhpToJsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'phptojs';
    }
}
