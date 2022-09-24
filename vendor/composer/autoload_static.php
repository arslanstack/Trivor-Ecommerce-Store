<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7ae7b5997f705705d1da13fdc3bfe9e1
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit7ae7b5997f705705d1da13fdc3bfe9e1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7ae7b5997f705705d1da13fdc3bfe9e1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7ae7b5997f705705d1da13fdc3bfe9e1::$classMap;

        }, null, ClassLoader::class);
    }
}