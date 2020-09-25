<?php

declare(strict_types=1);

namespace Waglpz\DiContainer;

use Dice\Dice;

//if (! \function_exists('Waglpz\Webapp\config')) {
//    function config(string|null $partial = null, string|null $projectRoot = null): mixed
//    {
//        $projectRoot = \Waglpz\Webapp\projectRoot($projectRoot);
//        $config      = include $projectRoot . '/main.php';
//
//        if ($partial !== null && ! isset($config[$partial])) {
//            throw new \InvalidArgumentException(
//                \sprintf(
//                    'Unknown config key given "%s".',
//                    $partial,
//                ),
//            );
//        }
//
//        return $partial !== null ? $config[$partial] : $config;
//    }
//}

//if (! \function_exists('Waglpz\Webapp\projectRoot')) {
//    function projectRoot(string|null $projectRoot = null): string
//    {
//        if ($projectRoot === null) {
//            \assert(\defined('PROJECT_CONFIG_DIRECTORY'));
//
//            return \PROJECT_CONFIG_DIRECTORY;
//        }
//
//        return $projectRoot;
//    }
//}

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
