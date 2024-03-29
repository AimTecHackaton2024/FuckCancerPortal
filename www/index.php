<?php declare(strict_types = 1);

require __DIR__ . '/../vendor/autoload.php';
$isApi = substr($_SERVER['REQUEST_URI'], 0, 4) === '/api';

if (!$isApi)
{
    App\Bootstrap::runWeb();
}
else
{
    App\Bootstrap::runApi();
}
