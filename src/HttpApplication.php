<?php

declare(strict_types=1);

namespace Rrmode\BasicContainerExample;

use Psr\Log\LoggerInterface;

readonly class HttpApplication implements ApplicationInterface
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
        $this->logger->info('Incoming HTTP Request');

        // TODO: implement HTTP application logics
    }
}
