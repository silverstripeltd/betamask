<?php declare(strict_types=1);

namespace SilverStripe\Betamask\Extension;

use SilverStripe\Core\Environment;
use SilverStripe\Core\Extension;
use SilverStripe\FeatureFlag\FeatureFlag;
use SilverStripe\View\Requirements;
use SilverStripe\View\TemplateGlobalProvider;

class LeftAndMain extends Extension implements TemplateGlobalProvider
{

    private const string ENV_DEV = 'dev';
    private const string ENV_UAT = 'uat';
    private const string ENV_TEST = 'test';

    private static array $environments = [
        self::ENV_DEV => 'dev',
        'live' => 'prod',
    ];

    public function onInit(): void
    {
        FeatureFlag::withBetamask(
            static function (): void {
                Requirements::css('silverstripeltd/betamask: client/dist/cms-refresh.css');
                Requirements::javascript('silverstripeltd/betamask: client/dist/cms-refresh.js');
            },
            static function (): void {
                Requirements::css('silverstripeltd/betamask: client/dist/pre-cms-refresh.css');
                Requirements::javascript('silverstripeltd/betamask: client/dist/pre-cms-refresh.js');
            },
        );
    }

    public static function getEnvironmentLabel(): string
    {
        $env = Environment::getEnv('SS_ENVIRONMENT_TYPE');

        // If environment type defined in config, return its value
        if (array_key_exists($env, self::$environments)) {
            return self::$environments[$env];
        }

        // For test environments, lets find UAT or Test
        $uatCwp = Environment::getEnv('CWP_ENVIRONMENT');
        $uatCloud = Environment::getEnv('CL_ENVIRONMENT');

        if (str_contains($uatCwp, 'uat') || str_contains($uatCloud, 'uat')) {
            return self::ENV_UAT;
        }

        // Default is always test
        return self::ENV_TEST;
    }

    public static function getEnvironmentCss(): string
    {
        return strtolower(self::getEnvironmentLabel());
    }

    public static function get_template_global_variables(): array
    {
        return [
            'EnvironmentLabel' => 'getEnvironmentLabel',
            'EnvironmentCss' => 'getEnvironmentCss',
        ];
    }
}
