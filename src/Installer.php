<?php
declare(strict_types=1);

namespace MoveElevator\Composer;

use Composer\Script\Event;
use MoveElevator\Composer\Factories\InstallationConfigurationFactory;
use MoveElevator\Composer\Services\InstallationService;
use Symfony\Component\Filesystem\Filesystem;

final class Installer
{
    public static function initialize(Event $event): void
    {
        $fileSystem = new Filesystem();
        $installationConfiguration = InstallationConfigurationFactory::create(
            $event->getComposer(),
            __DIR__ . '/..'
        );

        $installationService = new InstallationService($installationConfiguration, $fileSystem);
        $installationService->install();
    }
}
