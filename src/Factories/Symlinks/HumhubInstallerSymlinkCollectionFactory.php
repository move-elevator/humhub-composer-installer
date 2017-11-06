<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Factories\Symlinks;

use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Models\SymlinkCollection;

final class HumhubInstallerSymlinkCollectionFactory
{
    public static function create(InstallationConfiguration $installationConfiguration): SymlinkCollection
    {
        $symlinks = new SymlinkCollection();

        $symlinks->multipleAppend(ProjectConfigurationSymlinkCollectionFactory::create($installationConfiguration));
        $symlinks->multipleAppend(ProjectModulesSymlinkCollectionFactory::create($installationConfiguration));
        $symlinks->multipleAppend(ProjectThemesSymlinkCollectionFactory::create($installationConfiguration));

        $symlinks->multipleAppend(HumhubCoreSymlinkCollectionFactory::create($installationConfiguration));

        return $symlinks;
    }
}
