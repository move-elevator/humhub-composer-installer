<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Statics;

final class InstallationStatic
{
    const COMPOSER_EXTRA_ENTRY = 'humhub';
    const COMPOSER_EXTRA_WEB_DIRECTORY = 'web-dir';
    const DEFAULT_WEB_DIRECTORY = '../web';
    const COMPOSER_EXTRA_CONFIGURATION_DIRECTORY = 'config-dir';
    const DEFAULT_CONFIGURATION_DIRECTORY_RELATIVE_PATH_FROM_INSTALLATION_PACKAGE = 'etc/config';
    const COMPOSER_EXTRA_PROJECT_MODULE_DIRECTORY = 'module-dir';
    const COMPOSER_EXTRA_PROJECT_THEME_DIRECTORY = 'theme-dir';

    const HUMHUB_CORE_DIRECTORY_RELATIVE_FROM_VENDOR = 'humhub/humhub';

    const HUMHUB_CORE_THEMES_DIRECTORY = 'themes';
    const HUMHUB_CORE_ASSETS_DIRECTORY = 'assets';
    const HUMHUB_CORE_STATICS_DIRECTORY = 'static';

    const HUMHUB_CORE_PROTECTED_DIRECTORY = 'protected';
    const HUMHUB_CORE_PROTECTED_CONFIG_DIRECTORY = 'protected/config';
    const HUMHUB_CORE_PROTECTED_HUMHUB_DIRECTORY = 'protected/humhub';
    const HUMHUB_CORE_PROTECTED_RUNTIME_DIRECTORY = 'protected/runtime';
    const HUMHUB_CORE_PROTECTED_MODULES_DIRECTORY = 'protected/modules';
    const HUMHUB_CORE_PROTECTED_HTACCESS = 'protected/.htaccess';
    const HUMHUB_CORE_THEME_DIRECTORY = 'themes/HumHub';

    const PROJECT_WEB_HTACCESS = '.htaccess';
    const PROJECT_WEB_INDEX = 'index.php';
    const HUMHUB_CONSOLE_YII_FILE = 'protected/yii';

    /**
     * disable instantiation of this class
     */
    private function __construct()
    {
    }
}
