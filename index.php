<?php

use League\Container\Argument\ResolvableArgument;
use League\Container\Container;
use League\Container\ReflectionContainer;
use Psr\Log\LoggerInterface;
use Rrmode\BasicContainerExample\ApplicationInterface;
use Rrmode\BasicContainerExample\CommandLineApplication;
use Rrmode\BasicContainerExample\HttpApplication;
use Rrmode\BasicContainerExample\Logging\CommandLogger;
use Rrmode\BasicContainerExample\Logging\RequestLogger;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

// Container configuration

$container = new Container();

$container->delegate(
    new ReflectionContainer(cacheResolutions: true),
);

$container->add('requestLogPath', new ResolvableArgument('request.log'));

$logger = match (PHP_SAPI) {
    'cli' => CommandLogger::class,
    default => RequestLogger::class,
};

$container->add(LoggerInterface::class, $logger);

$application = match (PHP_SAPI) {
    'cli' => CommandLineApplication::class,
    default => HttpApplication::class,
};

$container->add(ApplicationInterface::class, $application);

// Application entrypoint

$appImpl = $container->get(ApplicationInterface::class);

$appImpl->run();

// Running with 'php index.php' - CommandLineApplication::run() -> CommandLogger::info('Application running')
// Running with php -S localhost:8000 index.php - HttpApplication::run() -> RequestLogger::info('Incoming HTTP Request')
