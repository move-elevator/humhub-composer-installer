<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Statics;

final class InstallationStatic
{
    public const COMPOSER_EXTRA_ENTRY = 'humhub';
    public const COMPOSER_EXTRA_WEB_DIRECTORY = 'web-dir';
    public const DEFAULT_WEB_DIRECTORY = '../web';
    public const COMPOSER_EXTRA_CONFIGURATION_DIRECTORY = 'config-dir';
    public const DEFAULT_CONFIGURATION_DIRECTORY_RELATIVE_PATH_FROM_INSTALLATION_PACKAGE = 'etc/config';
    public const COMPOSER_EXTRA_PROJECT_MODULE_DIRECTORY = 'module-dir';
    public const COMPOSER_EXTRA_PROJECT_THEME_DIRECTORY = 'theme-dir';
    public const COMPOSER_EXTRA_PROJECT_GRUNTFILE = 'Gruntfile.js';
    public const COMPOSER_EXTRA_PROJECT_PACKAGE_JSON = 'package.json';
    public const COMPOSER_EXTRA_PROJECT_PACKAGE_LOCK_JSON = 'package-lock.json';

    public const HUMHUB_CORE_DIRECTORY_RELATIVE_FROM_VENDOR = 'humhub/humhub';

    public const HUMHUB_CORE_THEMES_DIRECTORY = 'themes';
    public const HUMHUB_CORE_ASSETS_DIRECTORY = 'assets';
    public const HUMHUB_CORE_STATICS_DIRECTORY = 'static';

    public const HUMHUB_CORE_PROTECTED_DIRECTORY = 'protected';
    public const HUMHUB_CORE_PROTECTED_CONFIG_DIRECTORY = 'protected/config';
    public const HUMHUB_CORE_PROTECTED_HUMHUB_DIRECTORY = 'protected/humhub';
    public const HUMHUB_CORE_PROTECTED_RUNTIME_DIRECTORY = 'protected/runtime';
    public const HUMHUB_CORE_PROTECTED_MODULES_DIRECTORY = 'protected/modules';
    public const HUMHUB_CORE_PROTECTED_HTACCESS = 'protected/.htaccess';
    public const HUMHUB_CORE_THEME_DIRECTORY = 'themes/HumHub';

    public const PROJECT_WEB_HTACCESS = '.htaccess';
    public const PROJECT_WEB_INDEX = 'index.php';
    public const HUMHUB_CONSOLE_YII_FILE = 'protected/yii';

    /**
     * disable instantiation of this class
     */
    private function __construct()
    {
    }
}
