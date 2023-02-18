<?php

declare(strict_types=1);

namespace Rrmode\BasicContainerExample;

use Psr\Log\LoggerInterface;

readonly class CommandLineApplication implements ApplicationInterface
{
    public function __construct(
        private LoggerInterface $logger,
    ) {
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->logger->info('Application running');

        // TODO: implement CLI application logics
    }
}
