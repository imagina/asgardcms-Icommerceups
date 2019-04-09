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

        $titleTrans = 'icommerceups::icommerceups.single';
        $descriptionTrans = 'icommerceups::icommerceups.description';

        foreach (['en', 'es'] as $locale) {

            if($locale=='en'){
                $params = array(
                    'title' => trans($titleTrans),
                    'description' => trans($descriptionTrans),
                    'name' => config('asgard.icommerceups.config.shippingName'),
                    'status' => 0,
                    'options' => $options
                );

                $shippingMethod = ShippingMethod::create($params);
                
            }else{

                $title = trans($titleTrans,[],$locale);
                $description = trans($descriptionTrans,[],$locale);

                $shippingMethod->translateOrNew($locale)->title = $title;
                $shippingMethod->translateOrNew($locale)->description = $description;

                $shippingMethod->save();
            }

        }// Foreach

    }
}
