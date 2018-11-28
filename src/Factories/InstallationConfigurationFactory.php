<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Factories;

use Composer\Composer;
use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Statics\InstallationStatic;

final class InstallationConfigurationFactory
{
    public static function create(Composer $composer, string $humhubInstallerPackageRootPath): InstallationConfiguration
    {
        $composerExtras = $composer->getPackage()->getExtra();

        $humhubConfig = [
            InstallationStatic::COMPOSER_EXTRA_WEB_DIRECTORY => InstallationStatic::DEFAULT_WEB_DIRECTORY,
            InstallationStatic::COMPOSER_EXTRA_CONFIGURATION_DIRECTORY =>
                InstallationStatic::DEFAULT_CONFIGURATION_DIRECTORY_RELATIVE_PATH_FROM_INSTALLATION_PACKAGE,
            InstallationStatic::COMPOSER_EXTRA_PROJECT_MODULE_DIRECTORY => null,
            InstallationStatic::COMPOSER_EXTRA_PROJECT_THEME_DIRECTORY => null,
            'Gruntfile.js' => '',
            'package.json' => '',
            'package-lock.json' => '',
        ];

        if (true === isset($composerExtras[InstallationStatic::COMPOSER_EXTRA_ENTRY])) {
            $humhubConfig = array_merge($humhubConfig, $composerExtras[InstallationStatic::COMPOSER_EXTRA_ENTRY]);
        }

        $installationConfiguration = new InstallationConfiguration(
            $composer->getConfig(),
            $humhubInstallerPackageRootPath,
            ComposerProjectConfigurationFactory::create($humhubConfig)
        );

        return $installationConfiguration;
    }
}
