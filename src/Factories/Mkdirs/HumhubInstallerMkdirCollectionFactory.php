<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Factories\Mkdirs;

use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Models\MkdirCollection;
use MoveElevator\Composer\Statics\InstallationStatic;

final class HumhubInstallerMkdirCollectionFactory
{
    public static function create(InstallationConfiguration $installationConfiguration): MkdirCollection
    {
        $mkdirs = new MkdirCollection();
        $mkdirs->append($installationConfiguration->getWebDirectory());
        $mkdirs->append(
            sprintf(
                '%s/%s',
                $installationConfiguration->getWebDirectory(),
                InstallationStatic::HUMHUB_CORE_PROTECTED_DIRECTORY
            )
        );
        $mkdirs->append(
            sprintf(
                '%s/%s',
                $installationConfiguration->getWebDirectory(),
                InstallationStatic::HUMHUB_CORE_PROTECTED_MODULES_DIRECTORY
            )
        );
        $mkdirs->append(
            sprintf(
                '%s/%s',
                $installationConfiguration->getWebDirectory(),
                InstallationStatic::HUMHUB_CORE_THEMES_DIRECTORY
            )
        );

        return $mkdirs;
    }
}
