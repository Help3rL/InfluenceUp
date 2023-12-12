<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3e925e4670518821724c47a4f336598e
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'RtclBooking\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'RtclBooking\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3e925e4670518821724c47a4f336598e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3e925e4670518821724c47a4f336598e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3e925e4670518821724c47a4f336598e::$classMap;

        }, null, ClassLoader::class);
    }
}
