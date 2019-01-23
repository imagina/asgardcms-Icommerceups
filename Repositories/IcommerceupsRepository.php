<?php

namespace Modules\Icommerceups\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface IcommerceupsRepository extends BaseRepository
{

    public function calculate($parameters,$conf);

    public function getRates($conf,$postalCode,$weight,$items,$countryCode);

    public function addPackage($weight,$dimensions);

}
