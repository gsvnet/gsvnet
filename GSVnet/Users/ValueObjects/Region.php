<?php namespace GSVnet\Users\ValueObjects;

use GSVnet\Core\ValueObject;
use Illuminate\Support\Facades\Config;

class Region extends ValueObject
{
    /**
     * @var int
     */
    protected $region;

    /**
     * Region constructor.
     * @param int $region
     */
    public function __construct($region)
    {
        $this->region = $this->filter(intval($region));
    }

    public function filter($region)
    {
        if (array_key_exists($region, Config::get('gsvnet.regions'))) {
            return $region;
        }

        return null;
    }

    /**
     * @return int
     */
    public function getRegion()
    {
        return $this->region;
    }
}