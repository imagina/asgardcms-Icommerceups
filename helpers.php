<?php

use Modules\IcommerceUps\Entities\Configups;

if (! function_exists('icommerceups_get_configuration')) {

    function icommerceups_get_configuration()
    {
        $configuration = new Configups;
        return $configuration->getData();
    }

}

// Initial Method
if (! function_exists('icommerceups_Init')) {

    function icommerceups_Init($products, $options = array()){

        //$totalWeight = $products["weight"];
        $valueTotal = $products["total"];
        $items = $products["items"];

        $countryCode = isset($options["countryCode"]) ? $options["countryCode"] : null;
        $postalCode = isset($options["postCode"]) ? $options["postCode"] : null;

        if($postalCode!=null && $countryCode!=null){

            $totalWeight = icommerce_getTotalWeight($items,$countryCode); // Without Freeshiping
            return icommerceups_get_rates($postalCode, $totalWeight, $items, $countryCode);

        }else{
            
            return [
              'msj' => 'error',
              'data' => trans('icommerceups::configups.messages.msjini')
            ];
        }

    }

}


if (! function_exists('icommerceups_get_rates')) {

    function icommerceups_get_rates($postalCode,$weight,$items,$countryCode)
    {

        $resultMethods = [];
        $response["msj"] = "error";

        $conf = icommerceups_get_configuration();

        // Mode Testing or Production
        $useIntegration = false;
        if($conf->mode==1)
            $useIntegration = true;

        $rate = new \Ups\Rate($conf->access_key,$conf->user_id,$conf->password,$useIntegration);
        
        try {

            /***
                required - Max Allowed: 1 - Shipment container.
            ***/
            $shipment = new \Ups\Entity\Shipment();

            // *** Shipper ***
            /***
                required - Contains the address details of shipper
                If the ShipFrom container is not present then this address will be used as the ShipFrom. If this address is used as the ShipFrom the shipment will be rated from this origin address.
            ***/
            $shipperAddress = $shipment->getShipper()->getAddress();
            $shipperAddress->setPostalCode($conf->shipper_postalcode);

           
            $address = new \Ups\Entity\Address();
            $address->setPostalCode($conf->shipper_postalcode);

            /***
                Shipper CountryCode - Required, but default to US. For additional information, refer to Country or Territory Codes in the Appendix.
            ***/
            if($conf->shipper_countrycode && !empty($conf->shipper_countrycode))
                $address->setCountryCode($conf->shipper_countrycode);

            /***
                Ship From - ShipFrom Container.
            ***/
            $shipFrom = new \Ups\Entity\ShipFrom();

            /***
                conditional - Required to negotiate rates
            ***/
            //$address->setStateProvinceCode("FL");

            /***
                conditional - Contains ShipFrom address elements
                The shipment will be rated from this origin address to the destination ShipTo address.
            ***/
            $shipFrom->setAddress($address);
            $shipment->setShipFrom($shipFrom);

            /***
                ShipTo - Container stores the details of ShipTo
            ***/
            $shipTo = $shipment->getShipTo();

            /***
                optional - ShipFrom locations name or company name.
            ***/
            $shipTo->setCompanyName('Customer');
            
            /***
                required - ShipTo Address container contains the details of ShipTo address
            ***/
            $shipToAddress = $shipTo->getAddress();

            /***
                required - Receiver's postal code.
            ***/
            $shipToAddress->setPostalCode($postalCode);

            /***
                required - The IATA OR UPS BILLING code representing the receiver's country or territory. For additional information, refer to the Country or Territory Codes in the Appendix.
            ***/
            $shipToAddress->setCountryCode($countryCode);


            /***
                optional - A flag indicating if the shipper's address is a residential location. True if tag exists; false otherwise.
            ***/
            $shipToAddress->setResidentialAddressIndicator(true);


            $dimensions = icommerce_totalDimensions($items);

            // *** Package ***
            $package = icommerceups_addPackage($weight,$conf->weight_dimentions,$dimensions);
           
            $shipment->addPackage($package);
            
            /***
                optional - testing pickup
            ***/
            /*
            $pickupType = new \Ups\Entity\PickupType();
            $pickupType->setCode('03');

            $rateRequest = new \Ups\Entity\RateRequest();
            $rateRequest->setPickupType($pickupType);
            */
            
            /***
                optional - testing Invoice Total
                International Forms
            ***/
            /* 
            $invoiceLineTotal = new \Ups\Entity\InvoiceLineTotal;
            $invoiceLineTotal->setMonetaryValue(99999999);
            $invoiceLineTotal->setCurrencyCode('USD');
            $shipment->setInvoiceLineTotal($invoiceLineTotal);
            */

            /***
                optional  - testing Negotiate rates
                Depends Account UPS
            ***/
            /*
            $shOptions = new \Ups\Entity\ShipmentServiceOptions;
            $shOptions->setNegotiatedRatesIndicator(true);
            $shipment->setShipmentServiceOptions($shOptions);
            $shipment->showNegotiatedRates();
            $rates = $rate->getRate($shipment);
            */


            // *** Get Rates ***
            $rates = $rate->shopRates($shipment);



            $methodConfiguration = null;

            foreach ($rates->RatedShipment as $key => $rate) {
                
                $resultMethods[$key] = [
                    "configName" => $rate->Service->getName(),
                    "configTitle" => $rate->Service->getName(),
                    "price" => $rate->TotalCharges->MonetaryValue
                ];
                
            }
            
            $response["data"] = json_decode(json_encode($resultMethods));
            $response["msj"] = "success";
            return $response;
            

        } catch (Exception $e) {
            $response["data"] = $e->getMessage();
            return $response;
        }

    }
}

// National and International
if (! function_exists('icommerceups_addPackage')){

    function icommerceups_addPackage($weight,$weightDimensions,$dimensions){

        $package = new \Ups\Entity\Package();

        /***
            required - The code for the UPS packaging type associated with the package.
            Valid values: 00 = UNKNOWN 01 = UPS Letter 02 = Package 03 = Tube 04 = Pak 21 = Express Box 24 = 25KG Box 25 = 10KG Box 30 = Pallet 2a = Small Express Box 2b = Medium Express Box 2c = Large Express Box
        ***/
        $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);

        
        /***
            conditional - Container to hold Package Weight information.
            validation = Weight allowed for letters/envelopes.
        ***/
        $package->getPackageWeight()->setWeight($weight);


        /***
            conditional - Container to hold Unit of Measurement of Package Weight.
        ***/
        $weightUnit = new \Ups\Entity\UnitOfMeasurement;

        /***
            optional - Code representing the unit of measure associated with the package weight.
            Valid values: LBS = Pounds (default) KGS = Kilograms
        ***/
        $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_LBS);

        $package->getPackageWeight()->setUnitOfMeasurement($weightUnit);
        /* old code
        if($weightDimensions==0)
            $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_LBS);
        else
            $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
        */
        

        /*** 
            optional - Dimensions
        ***/
        
        $dimensionsPack = new \Ups\Entity\Dimensions();

        $dimensionsPack->setWidth(round($dimensions[0]));
        $dimensionsPack->setHeight(round($dimensions[1]));
        $dimensionsPack->setLength(round($dimensions[2]));

        $unit = new \Ups\Entity\UnitOfMeasurement;
        $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);
        
        $dimensionsPack->setUnitOfMeasurement($unit);
        
        $package->setDimensions($dimensionsPack);
        
        return $package;
    }

}