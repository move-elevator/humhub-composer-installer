<?php

namespace MoveElevator\Composer\Tests\Fixture\Models;

use Composer\Config;
use MoveElevator\Composer\Models\InstallationConfiguration;

trait InstallationConfigurationFixture
{
    use ComposerProjectConfigurationFixture;

    public function getInstallationConfiguration(Config $configurationMock): InstallationConfiguration
    {
        $composerProjectConfiguration = $this->getComposerProjectConfigurationFixtureObject();

        return new InstallationConfiguration(
            $configurationMock,
            __DIR__ . '/../../..',
            $composerProjectConfiguration
        );
    }
}
