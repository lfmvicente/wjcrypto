<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc40012416bb3fb9ffd6ad0329cf8a371
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Wjcrypto\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Wjcrypto\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/code/wjcrypto/vendor',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc40012416bb3fb9ffd6ad0329cf8a371::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc40012416bb3fb9ffd6ad0329cf8a371::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}