<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9662b14ad6f700b6af9a04b698d3983a
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9662b14ad6f700b6af9a04b698d3983a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9662b14ad6f700b6af9a04b698d3983a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9662b14ad6f700b6af9a04b698d3983a::$classMap;

        }, null, ClassLoader::class);
    }
}
