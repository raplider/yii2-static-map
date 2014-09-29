<?php
/**
 * Codru Components
 *
 * @author Maxim Vasiliev <codrilla@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace codru\staticmap;


class OpenStreetMapGeneratingUriStrategy implements GeneratingUriStrategy
{
    const OPENSTREET_MAP_URI = 'http://staticmap.openstreetmap.de/staticmap.php?';

    function generate($mapOptions)
    {
        $url = static::OPENSTREET_MAP_URI;
        foreach ($mapOptions as $key => $value) {
            if (is_array($value)) {
                $url .= $key . '=';
                foreach ($value as $k => $v) {
                    if (!is_numeric($k)) {
                        $url .= $k . ':' . $v . '|';
                    } else {
                        $url .= $v . '|';
                    }
                }
                $url = $this->cutLastSymbol($url);
            } else {
                $url .= $key . '=' . $value . '&';
            }
        }
        $url = $this->cutLastSymbol($url);
        return $url;
    }

    private function cutLastSymbol($str)
    {
        return substr($str, 0, strlen($str) - 1);
    }
}
