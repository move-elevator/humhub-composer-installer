<?php

namespace MoveElevator\Composer\Factories\Mkdirs;

use Composer\Config;
use MoveElevator\Composer\Tests\Fixture\Models\InstallationConfigurationFixture;
use PHPUnit\Framework\TestCase;

class HumhubInstallerMkdirCollectionFactoryTest extends TestCase
{
    use InstallationConfigurationFixture;

    public function testCreateCollectionWith4Entries()
    {
        $vendorDir = __DIR__ . '/../../../Fixture/VendorFolderStructure';

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, $vendorDir],
            ['vendor-dir', Config::RELATIVE_PATHS, 'VendorFolderStructure']
        ]);

        $installationConfiguration = $this->getInstallationConfiguration($configMock);

        $collection = HumhubInstallerMkdirCollectionFactory::create($installationConfiguration);

        $this->assertEquals(4, $collection->count());
    }
}
