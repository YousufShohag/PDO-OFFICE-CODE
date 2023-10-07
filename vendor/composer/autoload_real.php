<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInita322b3ae1a96f48252e53e73d10b5098
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

        spl_autoload_register(array('ComposerAutoloaderInita322b3ae1a96f48252e53e73d10b5098', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInita322b3ae1a96f48252e53e73d10b5098', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInita322b3ae1a96f48252e53e73d10b5098::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
