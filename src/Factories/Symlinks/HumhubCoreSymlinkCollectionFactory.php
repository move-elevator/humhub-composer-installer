<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Factories\Symlinks;

use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Models\SymlinkCollection;
use MoveElevator\Composer\Statics\InstallationStatic;

final class HumhubCoreSymlinkCollectionFactory
{
    public static function create(InstallationConfiguration $installationConfiguration): SymlinkCollection
    {
        $symlinks = new SymlinkCollection();
        $symlinks->append(HumhubCoreToWebDirectorySymlinkFactory::create(
            InstallationStatic::HUMHUB_CORE_ASSETS_DIRECTORY,
            $installationConfiguration
        ));
        $symlinks->append(HumhubCoreToWebDirectorySymlinkFactory::create(
            InstallationStatic::HUMHUB_CORE_STATICS_DIRECTORY,
            $installationConfiguration
        ));
        $symlinks->append(HumhubCoreToWebDirectorySymlinkFactory::create(
            InstallationStatic::HUMHUB_CORE_PROTECTED_CONFIG_DIRECTORY,
            $installationConfiguration
        ));
        $symlinks->append(HumhubCoreToWebDirectorySymlinkFactory::create(
            InstallationStatic::HUMHUB_CORE_PROTECTED_HUMHUB_DIRECTORY,
            $installationConfiguration
        ));
        $symlinks->append(HumhubCoreToWebDirectorySymlinkFactory::create(
            InstallationStatic::HUMHUB_CORE_PROTECTED_RUNTIME_DIRECTORY,
            $installationConfiguration
        ));
        $symlinks->append(HumhubCoreToWebDirectorySymlinkFactory::create(
            InstallationStatic::HUMHUB_CORE_THEME_DIRECTORY,
            $installationConfiguration
        ));
        $symlinks->append(HumhubCoreToWebDirectorySymlinkFactory::create(
            InstallationStatic::HUMHUB_CORE_PROTECTED_HTACCESS,
            $installationConfiguration
        ));

        return $symlinks;
    }
}
