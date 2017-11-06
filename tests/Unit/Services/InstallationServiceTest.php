<?php

namespace MoveElevator\Composer\Services;

use Composer\Config;
use MoveElevator\Composer\Models\Symlink;
use MoveElevator\Composer\Tests\Fixture\Models\InstallationConfigurationFixture;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class InstallationServiceTest extends TestCase
{
    use InstallationConfigurationFixture;

    public function testCasesForRelativePathSymlinks()
    {
        $vendorDir = __DIR__ . '/../../Fixture/VendorFolderStructure';

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, $vendorDir],
            ['vendor-dir', Config::RELATIVE_PATHS, 'VendorFolderStructure']
        ]);

        $this->webDirectory = '../WebFolder';
        $installationConfiguration = $this->getInstallationConfiguration($configMock);
        $service = new InstallationService($installationConfiguration, new Filesystem());

        $symlink = new Symlink(
            __FILE__,
            __DIR__ . '/../../Fixture/WebFolder/test'
        );

        $this->assertEquals(
            '../../Unit/Services/InstallationServiceTest.php',
            $service->getRelativePathBySymlink($symlink)
        );
    }

    public function testInstallationRun()
    {
        $vendorDir = __DIR__ . '/../../Fixture/VendorFolderStructure';

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, $vendorDir],
            ['vendor-dir', Config::RELATIVE_PATHS, 'VendorFolderStructure']
        ]);

        $this->webDirectory = '../WebFolder';
        $installationConfiguration = $this->getInstallationConfiguration($configMock);

        $fileSystemMock = $this->getMockBuilder(Filesystem::class)
            ->setMethods(['mkdir', 'symlink'])
            ->getMock();
        $fileSystemMock->expects($this->exactly(16))
            ->method('symlink');
        $fileSystemMock->expects($this->exactly(1))
            ->method('mkdir');

        $service = new InstallationService($installationConfiguration, $fileSystemMock);
        $service->install();
    }
}
