<?php

namespace Component;

/**
 * Класс AssetsBasic
 * Компонент приложения
 */
class AssetsBasic
{
    private static $path = null;
    private static $css = null;
    private static $js = null;

    /**
     * Подключение стилий
     */
    public static function getCss()
    {
        if(!self::$css){
            self::includeAsset();
        }
        foreach (self::$css as $css){
            echo '<link rel="stylesheet" href="' . self::$path . $css . '" />'.PHP_EOL;
        }
    }

    /**
     * Подключение скриптов
     */
    public static function getJs()
    {
        if(!self::$js){
            self::includeAsset();
        }
        foreach (self::$js as $js){
            echo '<script src="' . self::$path . $js . '"></script>'.PHP_EOL;
        }
    }

    /**
     * Подключение Asset
     */
    private static function includeAsset()
    {
        if(!self::$path){
            self::$path = App::$path . '/assets';
            if(!file_exists(self::$path.'/Asset.php')) throw new \Exception("Не обнаружен класс Asset в директории приложения.");
            require self::$path.'/Asset.php';
            self::$css = \Asset::$css;
            self::$js = \Asset::$js;
            self::$path = \Asset::$path;
        }
    }
}