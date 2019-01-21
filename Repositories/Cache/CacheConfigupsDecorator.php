<?php

namespace Modules\IcommerceUps\Repositories\Cache;

use Modules\IcommerceUps\Repositories\ConfigupsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheConfigupsDecorator extends BaseCacheDecorator implements ConfigupsRepository
{
    public function __construct(ConfigupsRepository $configups)
    {
        parent::__construct();
        $this->entityName = 'icommerceups.configups';
        $this->repository = $configups;
    }
}
