<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Factories\Symlinks;

use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Models\Symlink;

final class HumhubCoreToWebDirectorySymlinkFactory
{
    public static function create(
        string $relativePath,
        InstallationConfiguration $installationConfiguration
    ): Symlink {
        return new Symlink(
            sprintf('%s/%s', $installationConfiguration->getHumhubCoreDirectory(), $relativePath),
            sprintf('%s/%s', $installationConfiguration->getWebDirectory(), $relativePath)
        );
    }
}
