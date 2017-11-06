<?php

namespace MoveElevator\Composer\Tests\Unit\Models;

use MoveElevator\Composer\Models\ComposerProjectConfiguration;
use MoveElevator\Composer\Tests\Fixture\Models\ComposerProjectConfigurationFixture;
use PHPUnit\Framework\TestCase;

class ComposerProjectConfigurationTest extends TestCase
{
    use ComposerProjectConfigurationFixture;

    public function testGetterAndSetterWork()
    {
        $fixture = $this->getComposerProjectConfigurationFixtureObject();

        $this->assertEquals($this->webDirectory, $fixture->getWebDirectory());
        $this->assertEquals($this->configurationDirectory, $fixture->getConfigurationDirectory());
        $this->assertEquals($this->moduleDirectory, $fixture->getModuleDirectory());
        $this->assertEquals($this->themeDirectory, $fixture->getThemeDirectory());
    }

    public function testEmptyValueForModuleDirectory()
    {
        $composerProjectConfiguration = new ComposerProjectConfiguration(
            $this->webDirectory,
            $this->configurationDirectory
        );

        $this->assertEmpty($composerProjectConfiguration->getModuleDirectory());
        $this->assertEquals('', $composerProjectConfiguration->getModuleDirectory());
    }

    public function testEmptyValueForThemeDirectory()
    {
        $composerProjectConfiguration = new ComposerProjectConfiguration(
            $this->webDirectory,
            $this->configurationDirectory
        );

        $this->assertEmpty($composerProjectConfiguration->getThemeDirectory());
        $this->assertEquals('', $composerProjectConfiguration->getThemeDirectory());
    }
}
