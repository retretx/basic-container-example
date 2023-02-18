<?php

namespace Rrmode\BasicContainerExample\Logging;

use JsonException;
use Psr\Log\LoggerInterface;
use Stringable;

use function fclose;
use function fopen;
use function fwrite;
use function json_encode;
use function sprintf;

class RequestLogger implements LoggerInterface
{
    private mixed $fileHandler;

    public function __construct(
        private string $requestLogPath,
    ) {
        $this->fileHandler = fopen($this->requestLogPath, 'wb');
    }

    public function __destruct()
    {
        fclose($this->fileHandler);
    }

    /**
     * @param string $verbosity
     * @param string $message
     * @param array $context
     * @return void
     * @throws JsonException
     */
    public function writeVerbosity(string $verbosity, string $message, array $context): void
    {
        $contextString = json_encode($context, JSON_THROW_ON_ERROR);

        fwrite(
            $this->fileHandler,
            sprintf('[%s] %s %s', $verbosity, $message, $contextString),
        );
    }

    public function emergency(Stringable|string $message, array $context = []): void
    {
        // TODO: Implement emergency() method.
    }

    public function alert(Stringable|string $message, array $context = []): void
    {
        // TODO: Implement alert() method.
    }

    public function critical(Stringable|string $message, array $context = []): void
    {
        // TODO: Implement critical() method.
    }

    public function error(Stringable|string $message, array $context = []): void
    {
        // TODO: Implement error() method.
    }

    public function warning(Stringable|string $message, array $context = []): void
    {
        // TODO: Implement warning() method.
    }

    public function notice(Stringable|string $message, array $context = []): void
    {
        // TODO: Implement notice() method.
    }

    /**
     * @param Stringable|string $message
     * @param array $context
     * @return void
     * @throws JsonException
     */
    public function info(Stringable|string $message, array $context = []): void
    {
        $this->writeVerbosity('info', $message, $context);
    }

    public function debug(Stringable|string $message, array $context = []): void
    {
        // TODO: Implement debug() method.
    }

    public function log($level, Stringable|string $message, array $context = []): void
    {
        // TODO: Implement log() method.
    }
}
