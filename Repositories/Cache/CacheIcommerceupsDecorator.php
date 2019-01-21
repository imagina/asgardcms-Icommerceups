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
}
