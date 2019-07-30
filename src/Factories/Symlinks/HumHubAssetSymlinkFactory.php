<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Factories\Symlinks;

use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Models\SymlinkCollection;
use MoveElevator\Composer\Statics\InstallationStatic;

final class HumHubAssetSymlinkFactory
{
    public static function create(InstallationConfiguration $installationConfiguration): SymlinkCollection
    {
        $symlinks = new SymlinkCollection();
        $symlinks->append(HumhubCoreToHtdocsDirectorySymlinkFactory::create(
            InstallationStatic::COMPOSER_EXTRA_PROJECT_GRUNTFILE,
            $installationConfiguration
        ));
        $symlinks->append(HumhubCoreToHtdocsDirectorySymlinkFactory::create(
            InstallationStatic::COMPOSER_EXTRA_PROJECT_PACKAGE_JSON,
            $installationConfiguration
        ));
        $symlinks->append(HumhubCoreToHtdocsDirectorySymlinkFactory::create(
            InstallationStatic::COMPOSER_EXTRA_PROJECT_PACKAGE_LOCK_JSON,
            $installationConfiguration
        ));
        return $symlinks;
    }
}
