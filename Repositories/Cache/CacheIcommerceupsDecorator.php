<?php

namespace Modules\Icommerceups\Repositories\Cache;

use Modules\Icommerceups\Repositories\IcommerceupsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheIcommerceupsDecorator extends BaseCacheDecorator implements IcommerceupsRepository
{
    public function __construct(IcommerceupsRepository $icommerceups)
    {
        parent::__construct();
        $this->entityName = 'icommerceups.icommerceups';
        $this->repository = $icommerceups;
    }


    /**
   * List or resources
   *
   * @return mixed
   */
    public function calculate($parameters,$conf)
    {
        return $this->remember(function () use ($parameters,$conf) {
            return $this->repository->calculate($parameters,$conf);
        });
    }

    /**
   * List or resources
   *
   * @return mixed
   */
    public function getRates($conf,$postalCode,$weight,$items,$countryCode)
    {
        return $this->remember(function () use ($conf,$postalCode,$weight,$items,$countryCode) {
            return $this->repository->getRates($conf,$postalCode,$weight,$items,$countryCode);
        });
    }

    /**
   * add package
   *
   * @return package
   */
    public function addPackage($weight,$dimensions){
        return $this->remember(function () use ($weight,$dimensions) {
            return $this->repository->addPackage($weight,$dimensions);
        });
    }


}
