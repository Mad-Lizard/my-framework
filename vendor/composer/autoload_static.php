<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit99ae037083f5d6d5a902d3a27b3fe0a1
{
    public static $prefixesPsr0 = array (
        'F' => 
        array (
            'Fenom\\' => 
            array (
                0 => __DIR__ . '/..' . '/fenom/fenom/src',
            ),
        ),
    );

    public static $classMap = array (
        'Fenom' => __DIR__ . '/..' . '/fenom/fenom/src/Fenom.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit99ae037083f5d6d5a902d3a27b3fe0a1::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit99ae037083f5d6d5a902d3a27b3fe0a1::$classMap;

        }, null, ClassLoader::class);
    }
}
