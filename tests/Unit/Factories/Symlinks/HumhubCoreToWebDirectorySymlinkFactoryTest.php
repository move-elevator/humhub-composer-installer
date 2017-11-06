<?php

namespace MoveElevator\Composer\Factories\Symlinks;

use Composer\Config;
use MoveElevator\Composer\Tests\Fixture\Models\InstallationConfigurationFixture;
use PHPUnit\Framework\TestCase;

class HumhubCoreToWebDirectorySymlinkFactoryTest extends TestCase
{
    use InstallationConfigurationFixture;

    public function testCreateCollectionWith7Entries()
    {
        $vendorDir = __DIR__ . '/../../../Fixture/VendorFolderStructure';

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, $vendorDir],
            ['vendor-dir', Config::RELATIVE_PATHS, 'VendorFolderStructure']
        ]);

        $symlink = HumhubCoreToWebDirectorySymlinkFactory::create(
            'assets',
            $this->getInstallationConfiguration($configMock)
        );

        $this->assertEquals(realpath($vendorDir) . '/humhub/humhub/assets', $symlink->getSource());
    }
}
