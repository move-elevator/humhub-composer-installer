<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Factories;

use MoveElevator\Composer\Models\ComposerProjectConfiguration;
use MoveElevator\Composer\Statics\InstallationStatic;

final class ComposerProjectConfigurationFactory
{
    public static function create(array $configuration): ComposerProjectConfiguration
    {
        $composerProjectConfiguration = new ComposerProjectConfiguration(
            $configuration[InstallationStatic::COMPOSER_EXTRA_WEB_DIRECTORY],
            $configuration[InstallationStatic::COMPOSER_EXTRA_HTDOCS_DIRECTORY],
            $configuration[InstallationStatic::COMPOSER_EXTRA_CONFIGURATION_DIRECTORY]
        );

        if (false === empty($configuration[InstallationStatic::COMPOSER_EXTRA_PROJECT_MODULE_DIRECTORY])) {
            $composerProjectConfiguration->setModuleDirectory(
                $configuration[InstallationStatic::COMPOSER_EXTRA_PROJECT_MODULE_DIRECTORY]
            );
        }

        if (false === empty($configuration[InstallationStatic::COMPOSER_EXTRA_PROJECT_THEME_DIRECTORY])) {
            $composerProjectConfiguration->setThemeDirectory(
                $configuration[InstallationStatic::COMPOSER_EXTRA_PROJECT_THEME_DIRECTORY]
            );
        }

        return $composerProjectConfiguration;
    }
}
