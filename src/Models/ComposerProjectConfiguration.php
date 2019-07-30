<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Models;

final class ComposerProjectConfiguration
{
    /**
     * @var string
     */
    private $webDirectory;

    /**
     * @var string
     */
    private $configurationDirectory;

    /**
     * @var string
     */
    private $moduleDirectory;

    /**
     * @var string
     */
    private $themeDirectory;

    public function __construct(string $webDirectory, string $configurationDirectory)
    {
        $this->webDirectory = $webDirectory;
        $this->configurationDirectory = $configurationDirectory;
    }

    public function getWebDirectory(): string
    {
        return $this->webDirectory;
    }

    public function getConfigurationDirectory(): string
    {
        return $this->configurationDirectory;
    }

    public function getModuleDirectory(): string
    {
        return $this->moduleDirectory ?? '';
    }

    public function setModuleDirectory(string $moduleDirectory)
    {
        $this->moduleDirectory = $moduleDirectory;
    }

    public function getThemeDirectory(): string
    {
        return $this->themeDirectory ?? '';
    }

    public function setThemeDirectory(string $themeDirectory)
    {
        $this->themeDirectory = $themeDirectory;
    }
}
