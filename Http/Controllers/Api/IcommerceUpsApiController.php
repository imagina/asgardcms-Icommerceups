<?php

namespace Modules\Icommerceups\Http\Controllers\Api;

// Requests & Response
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Repositories
use Modules\Icommerceups\Repositories\IcommerceupsRepository;

use Modules\Icommerce\Repositories\ShippingMethodRepository;

class IcommerceUpsApiController extends BaseApiController
{

    private $icommerceups;
    private $shippingMethod;
   
    public function __construct(
        IcommerceupsRepository $icommerceups,
        ShippingMethodRepository $shippingMethod
    ){
        $this->icommerceups = $icommerceups;
        $this->shippingMethod = $shippingMethod;
    }
    
    /**
     * Init data
     * @param Requests request
     * @param Requests array products - items (object)
     * @param Requests array products - total
     * @param Requests array options - countryCode
     * @param Requests array options - postCode
     * @param Requests array options - country
     * @return route
     */
    public function init(Request $request){
            
        try {

            // Configuration
            $shippingName = config('asgard.icommerceups.config.shippingName');
            $attribute = array('name' => $shippingName);
            $shippingMethod = $this->shippingMethod->findByAttributes($attribute);

            $response = $this->icommerceups->calculate($request->all(),$shippingMethod->options);

          } catch (\Exception $e) {
            //Message Error
            $status = 500;
            $response = [
              'errors' => $e->getMessage()
            ];
        }

        return response()->json($response, $status ?? 200);

    }
    
    

}