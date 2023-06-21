<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit26b7c6e485188db391855ec6e82c659b
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit26b7c6e485188db391855ec6e82c659b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit26b7c6e485188db391855ec6e82c659b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit26b7c6e485188db391855ec6e82c659b::$classMap;

        }, null, ClassLoader::class);
    }
}