<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Services;

use MoveElevator\Composer\Factories\Symlinks\HumhubInstallerSymlinkCollectionFactory;
use MoveElevator\Composer\Factories\Mkdirs\HumhubInstallerMkdirCollectionFactory;
use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Models\Symlink;
use Symfony\Component\Filesystem\Filesystem;

final class InstallationService
{
    private $installationConfiguration;
    private $fileSystem;

    public function __construct(InstallationConfiguration $installationConfiguration, Filesystem $filesystem)
    {
        $this->installationConfiguration = $installationConfiguration;
        $this->fileSystem = $filesystem;
    }

    public function install(): void
    {
        $this->createDirectories();
        $this->createSymbolicLinks();
    }

    public function getRelativePathBySymlink(Symlink $symlink): string
    {
        return sprintf(
            '%s%s',
            $this->fileSystem->makePathRelative(dirname($symlink->getSource()), dirname($symlink->getTarget())),
            basename($symlink->getSource())
        );
    }

    private function createDirectories(): void
    {
        $mkdirs = HumhubInstallerMkdirCollectionFactory::create($this->installationConfiguration);

        $this->fileSystem->mkdir($mkdirs);
    }

    private function createSymbolicLinks(): void
    {
        $symlinks = HumhubInstallerSymlinkCollectionFactory::create($this->installationConfiguration);

        /** @var Symlink $symlink */
        foreach ($symlinks as $symlink) {
            $this->fileSystem->symlink($this->getRelativePathBySymlink($symlink), $symlink->getTarget());
        }
    }
}
