<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit33d636137de64b8b8d1fa1c13ef3785c
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit33d636137de64b8b8d1fa1c13ef3785c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit33d636137de64b8b8d1fa1c13ef3785c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit33d636137de64b8b8d1fa1c13ef3785c::$classMap;

        }, null, ClassLoader::class);
    }
}
