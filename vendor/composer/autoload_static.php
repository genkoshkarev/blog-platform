<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3b1e8a1ae70d49e8c994a28ae464c3f7
{
    public static $prefixLengthsPsr4 = array (
        'v' => 
        array (
            'vendor\\' => 7,
        ),
        'V' => 
        array (
            'Valitron\\' => 9,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'vendor\\' => 
        array (
            0 => 'F:\\programm\\OpenServer\\domains\\cg28577_test2\\vendor',
        ),
        'Valitron\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/valitron/src/Valitron',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3b1e8a1ae70d49e8c994a28ae464c3f7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3b1e8a1ae70d49e8c994a28ae464c3f7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3b1e8a1ae70d49e8c994a28ae464c3f7::$classMap;

        }, null, ClassLoader::class);
    }
}
