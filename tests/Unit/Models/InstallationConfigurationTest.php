<?php

namespace MoveElevator\Composer\Tests\Fixture\Models;

use Composer\Config;
use MoveElevator\Composer\Models\InstallationConfiguration;
use MoveElevator\Composer\Statics\InstallationStatic;
use PHPUnit\Framework\TestCase;

class InstallationConfigurationTest extends TestCase
{
    use ComposerProjectConfigurationFixture;

    public function testGetterAreSetCorrectly()
    {
        $vendorDir = __DIR__ . '/../../../vendor';
        $realPathVendorDir = realpath($vendorDir);

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, $vendorDir],
            ['vendor-dir', Config::RELATIVE_PATHS, 'vendor']
        ]);

        $installerPackageRootPath = __DIR__ . '/../../..';
        $this->configurationDirectory = '../etc/config';
        $composerProjectConfiguration = $this->getComposerProjectConfigurationFixtureObject();

        $installationConfiguration = new InstallationConfiguration(
            $configMock,
            $installerPackageRootPath,
            $composerProjectConfiguration
        );

        $this->assertEquals($realPathVendorDir, $installationConfiguration->getVendorDirectory());
        $this->assertEquals(
            realpath($installerPackageRootPath),
            $installationConfiguration->getHumhubInstallerPackageRootPath()
        );
        $this->assertEquals(
            $realPathVendorDir . '/' . $this->webDirectory,
            $installationConfiguration->getWebDirectory()
        );
        $this->assertEquals(
            realpath($vendorDir . '/' . $this->configurationDirectory),
            $installationConfiguration->getHumhubConfigurationDirectory()
        );
        $this->assertEquals(
            $realPathVendorDir . '/' . $this->moduleDirectory,
            $installationConfiguration->getHumhubProjectModuleDirectory()
        );
        $this->assertEquals(
            $realPathVendorDir . '/' . $this->themeDirectory,
            $installationConfiguration->getHumhubProjectThemeDirectory()
        );
        $this->assertEquals(
            $realPathVendorDir . '/' . InstallationStatic::HUMHUB_CORE_DIRECTORY_RELATIVE_FROM_VENDOR,
            $installationConfiguration->getHumhubCoreDirectory()
        );
        $this->assertEquals(
            realpath($installerPackageRootPath),
            $installationConfiguration->getAbsoluteProjectRootPath()
        );
    }

    public function testThrowExceptionForUnknownVendor()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode(1497861291);

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, ''],
        ]);

        $installerPackageRootPath = __DIR__ . '/../../..';
        $composerProjectConfiguration = $this->getComposerProjectConfigurationFixtureObject();

        new InstallationConfiguration(
            $configMock,
            $installerPackageRootPath,
            $composerProjectConfiguration
        );
    }

    public function testThrowExceptionForUnknownHumhubInstallationPackagePath()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode(1497861292);

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, __DIR__ . '/../../../vendor'],
        ]);

        $installerPackageRootPath = '';
        $composerProjectConfiguration = $this->getComposerProjectConfigurationFixtureObject();

        new InstallationConfiguration(
            $configMock,
            $installerPackageRootPath,
            $composerProjectConfiguration
        );
    }

    public function testThrowExceptionForUnknownProjectRootPath()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode(1497861294);

        $vendorDir = __DIR__ . '/../../../vendor';

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, $vendorDir],
            ['vendor-dir', Config::RELATIVE_PATHS, '/']
        ]);

        $installerPackageRootPath = __DIR__ . '/../../..';
        $composerProjectConfiguration = $this->getComposerProjectConfigurationFixtureObject();

        new InstallationConfiguration(
            $configMock,
            $installerPackageRootPath,
            $composerProjectConfiguration
        );
    }

    public function testThrowExceptionForUnknownProjectConfiguration()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode(1497861295);

        $vendorDir = __DIR__ . '/../../../vendor';

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, $vendorDir],
            ['vendor-dir', Config::RELATIVE_PATHS, 'vendor']
        ]);

        $installerPackageRootPath = __DIR__ . '/../../..';
        $this->configurationDirectory = '/falscherPfad';
        $composerProjectConfiguration = $this->getComposerProjectConfigurationFixtureObject();

        new InstallationConfiguration(
            $configMock,
            $installerPackageRootPath,
            $composerProjectConfiguration
        );
    }
}
