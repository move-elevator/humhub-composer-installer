<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Factories\Symlinks;

use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Models\Symlink;
use MoveElevator\Composer\Models\SymlinkCollection;
use MoveElevator\Composer\Statics\InstallationStatic;
use Webmozart\Glob\Glob;

final class ProjectModulesSymlinkCollectionFactory
{
    public static function create(InstallationConfiguration $installationConfiguration): SymlinkCollection
    {
        $symlinks = new SymlinkCollection();

        if (empty($installationConfiguration->getHumhubProjectModuleDirectory())) {
            return $symlinks;
        }

        $moduleDirectoryPaths = Glob::glob(
            sprintf(
                '%s/*',
                $installationConfiguration->getHumhubProjectModuleDirectory()
            )
        );

        foreach ($moduleDirectoryPaths as $moduleDirectoryPath) {
            $symlinks->append(
                new Symlink(
                    $moduleDirectoryPath,
                    sprintf(
                        '%s/%s/%s',
                        $installationConfiguration->getWebDirectory(),
                        InstallationStatic::HUMHUB_CORE_PROTECTED_MODULES_DIRECTORY,
                        basename($moduleDirectoryPath)
                    )
                )
            );
        }

        return $symlinks;
    }
}
