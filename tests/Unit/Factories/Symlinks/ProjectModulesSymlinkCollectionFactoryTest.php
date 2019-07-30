<?php

namespace MoveElevator\Composer\Factories\Symlinks;

use Composer\Config;
use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Tests\Fixture\Models\InstallationConfigurationFixture;
use PHPUnit\Framework\TestCase;

class ProjectModulesSymlinkCollectionFactoryTest extends TestCase
{
    use InstallationConfigurationFixture;

    public function testCreateCollectionWith1Entry()
    {
        $vendorDir = __DIR__ . '/../../../Fixture/VendorFolderStructure';

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, $vendorDir],
            ['vendor-dir', Config::RELATIVE_PATHS, 'VendorFolderStructure']
        ]);

        $installationConfiguration = $this->getInstallationConfiguration($configMock);

        $collection = ProjectModulesSymlinkCollectionFactory::create($installationConfiguration);

        $this->assertEquals(1, $collection->count());
    }

    public function testCreateCollectionWithNoEntries()
    {
        $vendorDir = __DIR__ . '/../../../Fixture/VendorFolderStructure';

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, $vendorDir],
            ['vendor-dir', Config::RELATIVE_PATHS, 'VendorFolderStructure']
        ]);

        $this->moduleDirectory = '';
        $composerProjectConfiguration = $this->getComposerProjectConfigurationFixtureObject();

        $installationConfiguration = new InstallationConfiguration(
            $configMock,
            __DIR__ . '/../../..',
            $composerProjectConfiguration
        );

        $collection = ProjectModulesSymlinkCollectionFactory::create($installationConfiguration);

        $this->assertEquals(0, $collection->count());
    }
}
