<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Factories\Symlinks;

use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Models\SymlinkCollection;

final class HumHubAssetSymlinkFactory
{
    public static function create(InstallationConfiguration $installationConfiguration): SymlinkCollection
    {
        $symlinks = new SymlinkCollection();

        $symlinks->append(HumhubCoreToWebDirectorySymlinkFactory::create(
            'Gruntfile.js',
            $installationConfiguration
        ));
        $symlinks->append(HumhubCoreToWebDirectorySymlinkFactory::create(
            'package.json',
            $installationConfiguration
        ));
        $symlinks->append(HumhubCoreToWebDirectorySymlinkFactory::create(
            'package-lock.json',
            $installationConfiguration
        ));

        return $symlinks;
    }
}
