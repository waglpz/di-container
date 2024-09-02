<?php

declare(strict_types=1);

namespace Waglpz\DiContainer;

use Dice\Dice;

if (! \function_exists('Waglpz\DiContainer\container')) {
    function container(): Container
    {
        static $container = null;
        if ($container !== null) {
            return $container;
        }

        if (! \defined('PROJECT_CONFIG_DIRECTORY')) {
            throw new \Error(
                'Runtime Constant "PROJECT_CONFIG_DIRECTORY" may not defined as expected.',
            );
        }

        $dicRules = include \PROJECT_CONFIG_DIRECTORY . '/dic.rules.php';
        $dic      = (new Dice())->addRules($dicRules);
        /** @noinspection PhpUnnecessaryLocalVariableInspection */
        $container = new Container($dic);

        return $container;
    }
}
