<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbd276d9029741128fb7e7a7307323e39
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'EFPE\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'EFPE\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/lib',
        ),
    );

    public static $classMap = array (
        'EFPE\\Helpers\\ProvenExpertAPI' => __DIR__ . '/../..' . '/src/lib/Helpers/ProvenExpertAPI.php',
        'EFPE\\ProvenExpertEmbeds\\AbstractProvenExpertEmbed' => __DIR__ . '/../..' . '/src/lib/ProvenExpertEmbeds/AbstractProvenExpertEmbed.php',
        'EFPE\\ProvenExpertEmbeds\\ProvenExpertLogoEmbed' => __DIR__ . '/../..' . '/src/lib/ProvenExpertEmbeds/ProvenExpertLogoEmbed.php',
        'EFPE\\ProvenExpertEmbeds\\RatingSummaryRichSnippetEmbed' => __DIR__ . '/../..' . '/src/lib/ProvenExpertEmbeds/RatingSummaryRichSnippetEmbed.php',
        'EFPE\\ProvenExpertEmbeds\\RatingsSealBarEmbed' => __DIR__ . '/../..' . '/src/lib/ProvenExpertEmbeds/RatingsSealBarEmbed.php',
        'EFPE\\ProvenExpertEmbeds\\RatingsSealCircleEmbed' => __DIR__ . '/../..' . '/src/lib/ProvenExpertEmbeds/RatingsSealCircleEmbed.php',
        'EFPE\\ProvenExpertEmbeds\\RatingsSealLandingEmbed' => __DIR__ . '/../..' . '/src/lib/ProvenExpertEmbeds/RatingsSealLandingEmbed.php',
        'EFPE\\ProvenExpertEmbeds\\RatingsSealLandscapeEmbed' => __DIR__ . '/../..' . '/src/lib/ProvenExpertEmbeds/RatingsSealLandscapeEmbed.php',
        'EFPE\\ProvenExpertEmbeds\\RatingsSealPortraitEmbed' => __DIR__ . '/../..' . '/src/lib/ProvenExpertEmbeds/RatingsSealPortraitEmbed.php',
        'EFPE\\ProvenExpertEmbeds\\RatingsSealSquareEmbed' => __DIR__ . '/../..' . '/src/lib/ProvenExpertEmbeds/RatingsSealSquareEmbed.php',
        'EFPE\\Settings\\ProvenExpertApiCredentials' => __DIR__ . '/../..' . '/src/lib/Settings/ProvenExpertApiCredentials.php',
        'EFPE\\Widgets\\AbstractWidget' => __DIR__ . '/../..' . '/src/lib/Widgets/AbstractWidget.php',
        'EFPE\\Widgets\\ProvenExpertLogoWidget' => __DIR__ . '/../..' . '/src/lib/Widgets/ProvenExpertLogoWidget.php',
        'EFPE\\Widgets\\RatingSummaryRichSnippetWidget' => __DIR__ . '/../..' . '/src/lib/Widgets/RatingSummaryRichSnippetWidget.php',
        'EFPE\\Widgets\\RatingsSealBarWidget' => __DIR__ . '/../..' . '/src/lib/Widgets/RatingsSealBarWidget.php',
        'EFPE\\Widgets\\RatingsSealCircleWidget' => __DIR__ . '/../..' . '/src/lib/Widgets/RatingsSealCircleWidget.php',
        'EFPE\\Widgets\\RatingsSealLandingWidget' => __DIR__ . '/../..' . '/src/lib/Widgets/RatingsSealLandingWidget.php',
        'EFPE\\Widgets\\RatingsSealLandscapeWidget' => __DIR__ . '/../..' . '/src/lib/Widgets/RatingsSealLandscapeWidget.php',
        'EFPE\\Widgets\\RatingsSealPortraitWidget' => __DIR__ . '/../..' . '/src/lib/Widgets/RatingsSealPortraitWidget.php',
        'EFPE\\Widgets\\RatingsSealSquareWidget' => __DIR__ . '/../..' . '/src/lib/Widgets/RatingsSealSquareWidget.php',
        'EFPE\\Widgets\\WidgetsRegistration' => __DIR__ . '/../..' . '/src/lib/Widgets/WidgetsRegistration.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbd276d9029741128fb7e7a7307323e39::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbd276d9029741128fb7e7a7307323e39::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbd276d9029741128fb7e7a7307323e39::$classMap;

        }, null, ClassLoader::class);
    }
}
