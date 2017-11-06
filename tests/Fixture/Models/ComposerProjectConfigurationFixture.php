<?php

namespace MoveElevator\Composer\Tests\Fixture\Models;

use MoveElevator\Composer\Models\ComposerProjectConfiguration;

trait ComposerProjectConfigurationFixture
{
    /**
     * @var string
     */
    protected $webDirectory = '../WebFolder';

    /**
     * @var string
     */
    protected $configurationDirectory = '../../../etc/config';

    /**
     * @var string
     */
    protected $moduleDirectory = '../../Fixture/ProjectModules';

    /**
     * @var string
     */
    protected $themeDirectory = '../../Fixture/ProjectThemes';

    protected function getComposerProjectConfigurationFixtureObject(): ComposerProjectConfiguration
    {
        $composerProjectConfiguration = new ComposerProjectConfiguration(
            $this->webDirectory,
            $this->configurationDirectory
        );

        $composerProjectConfiguration->setModuleDirectory($this->moduleDirectory);
        $composerProjectConfiguration->setThemeDirectory($this->themeDirectory);

        return $composerProjectConfiguration;
    }
}
