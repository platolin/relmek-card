<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbf01764ce35fbc7b758a6a3f44ba948b
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Simplon\\Mysql\\' => 14,
        ),
        'R' => 
        array (
            'Relmek\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Simplon\\Mysql\\' => 
        array (
            0 => __DIR__ . '/..' . '/simplon/mysql/src',
        ),
        'Relmek\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Relmek',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbf01764ce35fbc7b758a6a3f44ba948b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbf01764ce35fbc7b758a6a3f44ba948b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
