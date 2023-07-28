<?php

namespace FaithFM\NewRelicHelper;

class NewRelicHelper
{

    /**
     * Send a reduced (random) sample of traces to New Relic
     *
     * @param $sampleRate float|string  Fraction of the times that a trace sample will be logged (0.1 = 10%)
     * return void
     */
    public static function reduceTraceSampling($sampleRate = 0.1): void
    {
        $randomNumber = rand(0, 999) / 1000;        // allow for 3 decimal places (ie: 0.1% increments)
        $sampleRate = (float) $sampleRate;          // allow float or string sample rate values
        if ($randomNumber > $sampleRate) {
            // Ensure PHP agent is available  (ie: to avoid breaking the local env)
            if (extension_loaded('newrelic')) {
                newrelic_ignore_transaction();
            }
        }
    }

    /**
     * Set APM name based on the Laravel APP_NAME
     *
     * return void
     */
    public static function setApmName(): void
    {
        // Ensure PHP agent is available  (ie: to avoid breaking the local env)
        if (extension_loaded('newrelic')) {
            $appName = self::getAppName();
            if ($appName)
                newrelic_set_appname("PHP-H $appName");
        }
    }

    /**
     * Get APP_NAME from Laravel config or from .env file
     *
     * return string
     */
    protected static function getAppName(): ?string
    {
        // Try to get APP_NAME from Laravel config
        try {
            if (function_exists('config')) {
                return config("app.name");
            }
        } catch (\Exception $e) {
            // ignore
        }

        // We have a number of non-Laravel entry points... in this case load APP_NAME directly from .env file
        if (class_exists('Dotenv\Dotenv')) {
            // search in current directory, parent, and grandparent folders
            $dotenvSearchPaths = ['.', '..', '../..'];
            foreach ($dotenvSearchPaths as $path) {
                $dotenv = \Dotenv\Dotenv::createImmutable($path);
                if ($dotenv->safeLoad()) {
                    return $_ENV['APP_NAME'];
                }
            }
        }

        return null;
    }
}
