<?php

namespace MoveElevator\Composer\Factories;

use MoveElevator\Composer\Statics\InstallationStatic;
use PHPUnit\Framework\TestCase;

class ComposerProjectConfigurationFactoryTest extends TestCase
{
    public function testFactoryCreatesObject()
    {
        $webDirectory = '../web';
        $configurationDirectory = '../etc';
        $moduleDirectory = '../etc/module';
        $themeDirectory = '../etc/theme';

        $configuration = [
            InstallationStatic::COMPOSER_EXTRA_WEB_DIRECTORY => $webDirectory,
            InstallationStatic::COMPOSER_EXTRA_CONFIGURATION_DIRECTORY => $configurationDirectory,
            InstallationStatic::COMPOSER_EXTRA_PROJECT_MODULE_DIRECTORY => $moduleDirectory,
            InstallationStatic::COMPOSER_EXTRA_PROJECT_THEME_DIRECTORY => $themeDirectory
        ];

        $composerProjectConfiguration = ComposerProjectConfigurationFactory::create($configuration);

        $this->assertEquals($webDirectory, $composerProjectConfiguration->getWebDirectory());
        $this->assertEquals($configurationDirectory, $composerProjectConfiguration->getConfigurationDirectory());
        $this->assertEquals($moduleDirectory, $composerProjectConfiguration->getModuleDirectory());
        $this->assertEquals($themeDirectory, $composerProjectConfiguration->getThemeDirectory());
    }

    public function testFactoryCreatesObjectWithoutModuleAndThemeDirectory()
    {
        $webDirectory = '../web';
        $configurationDirectory = '../etc';

        $configuration = [
            InstallationStatic::COMPOSER_EXTRA_WEB_DIRECTORY => $webDirectory,
            InstallationStatic::COMPOSER_EXTRA_CONFIGURATION_DIRECTORY => $configurationDirectory,
        ];

        $composerProjectConfiguration = ComposerProjectConfigurationFactory::create($configuration);

        $this->assertEquals($webDirectory, $composerProjectConfiguration->getWebDirectory());
        $this->assertEquals($configurationDirectory, $composerProjectConfiguration->getConfigurationDirectory());
        $this->assertEquals('', $composerProjectConfiguration->getModuleDirectory());
        $this->assertEquals('', $composerProjectConfiguration->getThemeDirectory());
    }
}
