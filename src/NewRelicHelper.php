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
            newrelic_set_appname(config("app.name"));
        }
    }
}
