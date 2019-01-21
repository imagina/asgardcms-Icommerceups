<?php

namespace Modules\Icommerceups\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Icommerce\Entities\ShippingMethod;

class IcommerceupsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $options['init'] = "Modules\Icommerceups\Http\Controllers\Api\IcommerceUpsApiController";
        $options['accessKey'] = "";
        $options['userId'] = "";
        $options['password'] = "";
        $options['mode'] = "sandbox";
        $options['shipperPostalCode'] = "";
        $options['shipperStateCode'] = "";
        $options['shipperCountryCode'] = "";

        $params = array(
            'title' => trans('icommerceups::icommerceups.single'),
            'description' => trans('icommerceups::icommerceups.description'),
            'name' => config('asgard.icommerceups.config.shippingName'),
            'status' => 0,
            'options' => $options
        );

        ShippingMethod::create($params);

    }
}
