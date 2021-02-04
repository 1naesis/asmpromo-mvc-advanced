<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit088b860e2e6cca67eb6b52cc75ea1c80
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'RedBeanPHP\\' => 11,
        ),
        'C' => 
        array (
            'Component\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'RedBeanPHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP',
        ),
        'Component\\' => 
        array (
            0 => __DIR__ . '/../..' . '/components',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit088b860e2e6cca67eb6b52cc75ea1c80::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit088b860e2e6cca67eb6b52cc75ea1c80::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit088b860e2e6cca67eb6b52cc75ea1c80::$classMap;

        }, null, ClassLoader::class);
    }
}
