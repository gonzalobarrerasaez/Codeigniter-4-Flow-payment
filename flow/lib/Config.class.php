<?php
class Config
{
    static function get($name)
    {

        global $COMMERCE_CONFIG;
        switch (ENVIRONMENT) {
            case 'production':
                $COMMERCE_CONFIG = array(
                    'APIKEY' => '',
                    'SECRETKEY' => '',
                    'APIURL' => 'https://www.flow.cl/api',
                    'BASEURL' => ''
                );
                break;
            default:
                $COMMERCE_CONFIG = array(
                    'APIKEY' => '2CF73601-1E89-4E59-8901-302L4F9071CC',
                    'SECRETKEY' => '6a9e8f6fd33422591272c5740197556e8a3b6bfb',
                    'APIURL' => 'https://sandbox.flow.cl/api',
                    'BASEURL' => ''
                );
                break;
        }
        if (!isset($COMMERCE_CONFIG[$name])) {
            throw new Exception("The configuration element " . $name . " does not exits in " . ENVIRONMENT, 1);
        }

        return $COMMERCE_CONFIG[$name];
    }
}
