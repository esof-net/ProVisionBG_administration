<?php
namespace ProVision\Administration;

use File;
use Illuminate\Support\Facades\Facade;
use LaravelLocalization;
use Lavary\Menu\Menu;

class Administration extends Facade {

    const AS_MODULE_PREFIX = 'provision.administration.module.'; //administration module route prefix

    /**
     * inited modules container
     * @var string
     */
    private static $modules;

    /**
     * Current module name
     * @var string
     */
    private static $currentModuleTitle = 'Enter module name here!';

    /**
     * Current module sub name
     * @var string
     */
    private static $currentModuleSubTitle = '';

    /**
     * Set current module name for administration titles
     * @param $name
     * @return string
     */
    public static function setTitle($name) {
        Administration::$currentModuleTitle = $name;
        return $name;
    }

    /**
     * Get current module name
     * @return string
     */
    public static function getTitle() {
        return Administration::$currentModuleTitle;
    }

    /**
     * Set current module sub name for administration titles
     * @param $name
     * @return string
     */
    public static function setSubTitle($name) {
        Administration::$currentModuleSubTitle = $name;
        return $name;
    }

    /**
     * Get current module sub name
     * @return string
     */
    public static function getSubTitle() {
        return Administration::$currentModuleSubTitle;
    }

    /**
     * Get all language codes
     * @return array
     */
    public static function getLanguages() {
        return LaravelLocalization::getSupportedLocales();
    }

    /**
     * Get current language code
     * @return string
     */
    public static function getLanguage() {
        $locale = LaravelLocalization::setLocale();
        if (!empty($locale)) {
            return $locale;
        } else {
            return \App::getLocale();
        }
    }

    /**
     * Get static block for blade templates
     * @param $key
     * @return mixed
     */
    public static function getStaticBlock($key) {
        $block = StaticBlock::where('key', $key)->first();
        if ($block) {
            return $block->text;
        }

        \Debugbar::error('static block not found: ' . $key);
        return false;
    }

    /**
     * Get module order index
     * @param $module
     * @return mixed
     */
    public static function getModuleOrderIndex($module) {
        $module = \Module::where('slug', $module);
        if (!$module) {
            return false;
        }
        return $module['order'];
    }

    /**
     * Get administration menu instance
     * @return Menu
     */
    public static function getMenuInstance() {
        $menu = \Menu::get('ProVisionAdministrationMenu');
        if (empty($menu)) {
            $menu = \Menu::make('ProVisionAdministrationMenu', []);
        }
        return $menu;
    }

    /**
     * Is in maintenance mode
     * @return bool
     */
    public static function isInMaintenanceMode() {
        return File::exists(storage_path('/framework/down-provision-administration'));
    }

    /**
     * Check request URL is in administration
     * @return bool
     */
    public static function routeInAdministration() {
        //ако се ползва laravellocalization => 'hideDefaultLocaleInURL' => false,
        if (!empty(\LaravelLocalization::setLocale())) {
            if (!\Request::is(\LaravelLocalization::setLocale() . '/' . config('provision_administration.url_prefix') . '*')) {
                return false;
            }
        } else {
            if (!\Request::is(config('provision_administration.url_prefix') . '*')) {
                return false;
            }
        }

        return true;
    }

    /**
     * Web site prefix in route
     * @return string
     */
    public static function routePrefix() {
        return \LaravelLocalization::setLocale();
    }

    /**
     * Administration prefix in route
     * @return mixed|string
     */
    public static function routeAdministrationPrefix() {
        if (!empty(\LaravelLocalization::setLocale())) {
            return \LaravelLocalization::setLocale() . '/' . config('provision_administration.url_prefix');
        } else {
            return config('provision_administration.url_prefix');
        }

    }

    /**
     * Default middleware for route
     * @param array $middleware
     * @return array
     */
    public static function routeMiddleware($middleware = []) {
        $default = [
            'web',
            'localeSessionRedirect',
            'localizationRedirect',
        ];
        return array_merge($default, $middleware);
    }

    /**
     * Administration AS in route
     * @return string
     */
    public static function routeAdministrationAs() {
        return \Administration::getLanguage() . '.';
    }

    /**
     * Адреси за администраторските route
     * @param $name
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    public static function route($name, $parameters = [], $absolute = true) {
        return route(Administration::routeAdministrationName($name), $parameters, $absolute);
    }

    /**
     * Име на администраторският route
     * @param $name
     * @return string
     */
    public static function routeAdministrationName($name) {
        return self::AS_MODULE_PREFIX . $name;
    }

    /**
     * Get route administration name
     * @param $name
     * @return string
     */
    public static function routeName($name) {
        return Administration::routeAdministrationName($name);
    }

    /**
     * Check request is in administration dashboard
     * @return bool
     */
    public static function isDashboard() {
        if (!empty(\LaravelLocalization::setLocale())) {
            if (\Request::is(\LaravelLocalization::setLocale() . '/' . config('provision_administration.url_prefix'))) {
                return true;
            }
        } else {
            if (\Request::is(config('provision_administration.url_prefix'))) {
                return true;
            }
        }

        return false;
    }

}