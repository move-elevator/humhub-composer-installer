<?php

namespace MoveElevator\Composer\Factories;

use Composer\Composer;
use Composer\Config;
use Composer\Package\RootPackageInterface;
use MoveElevator\Composer\Statics\InstallationStatic;
use PHPUnit\Framework\TestCase;

class InstallationConfigurationFactoryTest extends TestCase
{
    public function testFactoryCreateInstallationConfigurationFromDefault()
    {
        $vendorDir = __DIR__ . '/../../../vendor';
        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, $vendorDir],
            ['vendor-dir', Config::RELATIVE_PATHS, 'vendor']
        ]);

        $packageMock = $this->getMockBuilder(RootPackageInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $packageMock->expects($this->any())->method('getExtra')->willReturn([]);

        $composerMock = $this->getMockBuilder(Composer::class)->disableOriginalConstructor()->getMock();
        $composerMock->expects($this->any())->method('getConfig')->willReturn($configMock);
        $composerMock->expects($this->any())->method('getPackage')->willReturn($packageMock);

        $installerRootPath = __DIR__ . '/../../..';
        $config = InstallationConfigurationFactory::create($composerMock, $installerRootPath);

        $this->assertEquals(realpath($vendorDir), $config->getVendorDirectory());

        $this->assertEquals(
            $config->getVendorDirectory() . '/' . InstallationStatic::DEFAULT_WEB_DIRECTORY,
            $config->getWebDirectory()
        );
        $this->assertEquals(
            realpath($installerRootPath . '/' . InstallationStatic::DEFAULT_CONFIGURATION_DIRECTORY_RELATIVE_PATH_FROM_INSTALLATION_PACKAGE),
            $config->getHumhubConfigurationDirectory()
        );
        $this->assertEquals(
            '',
            $config->getHumhubProjectModuleDirectory()
        );
        $this->assertEquals(
            '',
            $config->getHumhubProjectThemeDirectory()
        );
    }

    public function testFactoryCreateInstallationConfigurationFromComposerExtra()
    {
        $vendorDir = __DIR__ . '/../../../vendor';
        $webDirectory = '../htdocs';

        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $configMock->expects($this->any())->method('get')->willReturnMap([
            ['vendor-dir', 0, $vendorDir],
            ['vendor-dir', Config::RELATIVE_PATHS, 'vendor']
        ]);

        $packageMock = $this->getMockBuilder(RootPackageInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $packageMock->expects($this->any())->method('getExtra')->willReturn([
            InstallationStatic::COMPOSER_EXTRA_ENTRY => [
                InstallationStatic::COMPOSER_EXTRA_WEB_DIRECTORY => $webDirectory,
                InstallationStatic::COMPOSER_EXTRA_CONFIGURATION_DIRECTORY => InstallationStatic::DEFAULT_CONFIGURATION_DIRECTORY_RELATIVE_PATH_FROM_INSTALLATION_PACKAGE,
                InstallationStatic::COMPOSER_EXTRA_PROJECT_MODULE_DIRECTORY => '../etc',
                InstallationStatic::COMPOSER_EXTRA_PROJECT_THEME_DIRECTORY => '../etc',
            ]
        ]);

        $composerMock = $this->getMockBuilder(Composer::class)->disableOriginalConstructor()->getMock();
        $composerMock->expects($this->any())->method('getConfig')->willReturn($configMock);
        $composerMock->expects($this->any())->method('getPackage')->willReturn($packageMock);

        $installerRootPath = __DIR__ . '/../../..';
        $config = InstallationConfigurationFactory::create($composerMock, $installerRootPath);

        $this->assertEquals(realpath($vendorDir), $config->getVendorDirectory());

        $this->assertEquals(
            $config->getVendorDirectory() . '/' . $webDirectory,
            $config->getWebDirectory()
        );
        $this->assertEquals(
            realpath($installerRootPath . '/' . InstallationStatic::DEFAULT_CONFIGURATION_DIRECTORY_RELATIVE_PATH_FROM_INSTALLATION_PACKAGE),
            $config->getHumhubConfigurationDirectory()
        );
        $this->assertEquals(
            $config->getVendorDirectory() . '/../etc',
            $config->getHumhubProjectModuleDirectory()
        );
        $this->assertEquals(
            $config->getVendorDirectory() . '/../etc',
            $config->getHumhubProjectThemeDirectory()
        );
    }
}
