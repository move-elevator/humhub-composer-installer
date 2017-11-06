<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Factories\Symlinks;

use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Models\Symlink;
use MoveElevator\Composer\Models\SymlinkCollection;
use MoveElevator\Composer\Statics\InstallationStatic;

final class ProjectConfigurationSymlinkCollectionFactory
{
    public static function create(InstallationConfiguration $installationConfiguration): SymlinkCollection
    {
        $symlinks = new SymlinkCollection();

        $symlinks->append(new Symlink(
            sprintf(
                '%s/%s',
                $installationConfiguration->getHumhubConfigurationDirectory(),
                InstallationStatic::PROJECT_WEB_HTACCESS
            ),
            sprintf(
                '%s/%s',
                $installationConfiguration->getWebDirectory(),
                InstallationStatic::PROJECT_WEB_HTACCESS
            )
        ));

        $symlinks->append(new Symlink(
            sprintf(
                '%s/%s',
                $installationConfiguration->getHumhubConfigurationDirectory(),
                InstallationStatic::PROJECT_WEB_INDEX
            ),
            sprintf(
                '%s/%s',
                $installationConfiguration->getWebDirectory(),
                InstallationStatic::PROJECT_WEB_INDEX
            )
        ));

        $symlinks->append(new Symlink(
            sprintf(
                '%s/%s',
                $installationConfiguration->getHumhubConfigurationDirectory(),
                InstallationStatic::HUMHUB_CONSOLE_YII_FILE
            ),
            sprintf(
                '%s/%s',
                $installationConfiguration->getWebDirectory(),
                InstallationStatic::HUMHUB_CONSOLE_YII_FILE
            )
        ));

        return $symlinks;
    }
}
