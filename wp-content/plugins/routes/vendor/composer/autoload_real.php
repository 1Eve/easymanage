<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit26b7c6e485188db391855ec6e82c659b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit26b7c6e485188db391855ec6e82c659b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit26b7c6e485188db391855ec6e82c659b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit26b7c6e485188db391855ec6e82c659b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
