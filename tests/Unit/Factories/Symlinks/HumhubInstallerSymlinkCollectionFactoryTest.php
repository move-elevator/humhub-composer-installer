<?php

namespace MoveElevator\Composer\Factories\Symlinks;

use Composer\Config;
use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Tests\Fixture\Models\InstallationConfigurationFixture;
use PHPUnit\Framework\TestCase;

class HumhubInstallerSymlinkCollectionFactoryTest extends TestCase
{
    use InstallationConfigurationFixture;

    public function testCreateCollectionWith1Entries()
    {
        $vendorDir = __DIR__ . '/../../../Fixture/VendorFolderStructure';

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, $vendorDir],
            ['vendor-dir', Config::RELATIVE_PATHS, 'VendorFolderStructure']
        ]);

        $installationConfiguration = $this->getInstallationConfiguration($configMock);

        $collection = HumhubInstallerSymlinkCollectionFactory::create($installationConfiguration);

        $this->assertEquals(16, $collection->count());
    }
}
