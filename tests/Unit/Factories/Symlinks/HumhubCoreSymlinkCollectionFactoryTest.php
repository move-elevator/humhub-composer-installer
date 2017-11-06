<?php

namespace MoveElevator\Composer\Factories\Symlinks;

use Composer\Config;
use MoveElevator\Composer\Tests\Fixture\Models\InstallationConfigurationFixture;
use PHPUnit\Framework\TestCase;

class HumhubCoreSymlinkCollectionFactoryTest extends TestCase
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

        $installationConfiguration = $this->getInstallationConfiguration($configMock);

        $collection = HumhubCoreSymlinkCollectionFactory::create($installationConfiguration);

        $this->assertEquals(7, $collection->count());
    }
}
