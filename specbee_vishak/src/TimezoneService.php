<?php
/**
 * @file providing the service that convert timezone into time'.
 *
 */

namespace Drupal\specbee_vishak;

class TimezoneService
{

    public function getTimeZone()
    {

        //Getting our custom form timezone config value
        $config = \Drupal::config('timezone.adminsettings');
        $timezone = $config->get('timezone');
        $city = $config->get('city');

        //Calculating the time based on timezone
        date_default_timezone_set($timezone);
        $date = date('dS F Y \-\ h:i A');

        return array(
            $date,
            $city
        );
    }
}

