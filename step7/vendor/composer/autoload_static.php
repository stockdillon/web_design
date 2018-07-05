<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf31622af181286cef3ccbb637386ddb0
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Felis\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Felis\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/Felis',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf31622af181286cef3ccbb637386ddb0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf31622af181286cef3ccbb637386ddb0::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
