<?php

namespace MoveElevator\Composer\Tests\Unit\Factories\Symlinks;

use Composer\Config;
use MoveElevator\Composer\Factories\Symlinks\HumHubAssetSymlinkFactory;
use MoveElevator\Composer\Tests\Fixture\Models\InstallationConfigurationFixture;
use PHPUnit\Framework\TestCase;

class HumhubAssetSymlinkFactoryTest extends TestCase
{
    use InstallationConfigurationFixture;

    public function testCreateCollectionWith3Entries()
    {
        $vendorDir = __DIR__ . '/../../../Fixture/VendorFolderStructure';

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, $vendorDir],
            ['vendor-dir', Config::RELATIVE_PATHS, 'VendorFolderStructure']
        ]);

        $installationConfiguration = $this->getInstallationConfiguration($configMock);

        $collection = HumHubAssetSymlinkFactory::create($installationConfiguration);

        $this->assertEquals(3, $collection->count());
    }
}
