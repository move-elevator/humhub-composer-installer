<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Factories\Symlinks;

use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Models\Symlink;
use MoveElevator\Composer\Models\SymlinkCollection;
use MoveElevator\Composer\Statics\InstallationStatic;
use Webmozart\Glob\Glob;

final class ProjectThemesSymlinkCollectionFactory
{
    public static function create(InstallationConfiguration $installationConfiguration): SymlinkCollection
    {
        $symlinks = new SymlinkCollection();

        if (empty($installationConfiguration->getHumhubProjectThemeDirectory())) {
            return $symlinks;
        }

        $themesDirectoryPaths = Glob::glob(
            sprintf(
                '%s/*',
                $installationConfiguration->getHumhubProjectThemeDirectory()
            )
        );

        foreach ($themesDirectoryPaths as $themesDirectoryPath) {
            $symlinks->append(
                new Symlink(
                    $themesDirectoryPath,
                    sprintf(
                        '%s/%s/%s',
                        $installationConfiguration->getWebDirectory(),
                        InstallationStatic::HUMHUB_CORE_THEMES_DIRECTORY,
                        basename($themesDirectoryPath)
                    )
                )
            );
        }

        return $symlinks;
    }
}
