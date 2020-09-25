<?php

declare(strict_types=1);

$config       = [];
$sharedConfig = [];

if (PHP_SAPI === 'cli' && APP_ENV !== 'test') {
    if (is_file(__DIR__ . '/container/cli.rules.php')) {
        $config = include __DIR__ . '/container/cli.rules.php';
    }
} else {
    if (is_file(__DIR__ . '/container/web.rules.php')) {
        $config = include __DIR__ . '/container/web.rules.php';
        if (is_file(__DIR__ . '/container/swagger.rules.php')) {
            $config += include __DIR__ . '/container/swagger.rules.php';
        }

        if (is_file(__DIR__ . '/container/google-sso.rules.php')) {
            $config = array_replace_recursive($config, include __DIR__ . '/container/google-sso.rules.php');
        }

        if (is_file(__DIR__ . '/container/view-helpers.rules.php')) {
            $config += include __DIR__ . '/container/view-helpers.rules.php';
        }
    }
}

if (is_file(__DIR__ . '/container/shared.rules.php')) {
    $sharedConfig = include __DIR__ . '/container/shared.rules.php';
}

return array_replace_recursive($sharedConfig, $config);
