<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Models;

use Composer\Config;
use MoveElevator\Composer\Statics\InstallationStatic;

final class InstallationConfiguration
{
    /**
     * @var string
     */
    private $vendorDirectory;

    /**
     * @var string
     */
    private $humhubInstallerPackageRootPath;

    /**
     * @var string
     */
    private $absoluteProjectRootPath;

    /**
     * @var string
     */
    private $webDirectory;

    /**
     * @var string
     */
    private $humhubCoreDirectory;

    /**
     * @var string
     */
    private $humhubConfigurationDirectory;

    /**
     * @var string
     */
    private $humhubProjectModuleDirectory = '';

    /**
     * @var string
     */
    private $humhubProjectThemeDirectory = '';

    /**
     * @throws \InvalidArgumentException
     * @SuppressWarnings(PHPMD.ConstructorNewOperator)
     */
    public function __construct(
        Config $composerConfig,
        string $humhubInstallerPackageRootPath,
        ComposerProjectConfiguration $projectConfiguration
    ) {
        $vendorDirectory = $composerConfig->get('vendor-dir');

        if (empty($vendorDirectory)) {
            throw new \InvalidArgumentException(
                'could not find any vendor directory from the composer configuration', 1497861291
            );
        }

        if (empty($humhubInstallerPackageRootPath)) {
            throw new \InvalidArgumentException('could not find the humhub installer package path', 1497861292);
        }

        $this->vendorDirectory = realpath($vendorDirectory);
        $this->humhubInstallerPackageRootPath = realpath($humhubInstallerPackageRootPath);

        $this->setAbsoluteProjectRootPath($composerConfig->get('vendor-dir', Config::RELATIVE_PATHS));
        $this->webDirectory = sprintf('%s/%s', $this->getVendorDirectory(), $projectConfiguration->getWebDirectory());
        $this->setHumhubConfigurationDirectory($projectConfiguration->getConfigurationDirectory());

        $this->humhubCoreDirectory = sprintf(
            '%s/%s', $this->getVendorDirectory(), InstallationStatic::HUMHUB_CORE_DIRECTORY_RELATIVE_FROM_VENDOR
        );

        if (false === empty($projectConfiguration->getModuleDirectory())) {
            $this->humhubProjectModuleDirectory = sprintf(
                '%s/%s', $this->getVendorDirectory(), $projectConfiguration->getModuleDirectory()
            );
        }

        if (false === empty($projectConfiguration->getThemeDirectory())) {
            $this->humhubProjectThemeDirectory = sprintf(
                '%s/%s', $this->getVendorDirectory(), $projectConfiguration->getThemeDirectory()
            );
        }
    }

    public function getVendorDirectory(): string
    {
        return $this->vendorDirectory;
    }

    public function getHumhubInstallerPackageRootPath(): string
    {
        return $this->humhubInstallerPackageRootPath;
    }

    public function getHumhubCoreDirectory(): string
    {
        return $this->humhubCoreDirectory;
    }

    public function getWebDirectory(): string
    {
        return $this->webDirectory;
    }

    public function getHumhubConfigurationDirectory(): string
    {
        return $this->humhubConfigurationDirectory;
    }

    public function getHumhubProjectModuleDirectory(): string
    {
        return $this->humhubProjectModuleDirectory;
    }

    public function getHumhubProjectThemeDirectory(): string
    {
        return $this->humhubProjectThemeDirectory;
    }

    public function getAbsoluteProjectRootPath(): string
    {
        return $this->absoluteProjectRootPath;
    }

    private function setHumhubConfigurationDirectory(string $configurationDirectory): void
    {
        $projectConfigurationDirectory = realpath(
            sprintf('%s/%s', $this->getVendorDirectory(), $configurationDirectory)
        );

        if (false === $projectConfigurationDirectory) {
            $projectConfigurationDirectory = realpath(
                sprintf('%s/%s', $this->getHumhubInstallerPackageRootPath(), $configurationDirectory)
            );
        }

        if (false === $projectConfigurationDirectory) {
            throw new \InvalidArgumentException(
                sprintf(
                    'could not find the config file folder under: %s or %s',
                    sprintf('%s/%s', $this->getVendorDirectory(), $configurationDirectory),
                    sprintf('%s/%s', $this->getHumhubInstallerPackageRootPath(), $configurationDirectory)
                ),
                1497861295
            );
        }

        $this->humhubConfigurationDirectory = $projectConfigurationDirectory;
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function setAbsoluteProjectRootPath(string $relativeVendorDirectory): void
    {
        $tempAbsoluteProjectRootPath = str_replace($relativeVendorDirectory, '', $this->getVendorDirectory());
        $this->absoluteProjectRootPath = realpath($tempAbsoluteProjectRootPath);

        if (false === $this->absoluteProjectRootPath) {
            throw new \InvalidArgumentException(
                'could not find the absolute project root path: ' . $tempAbsoluteProjectRootPath,
                1497861294
            );
        }
    }
}
