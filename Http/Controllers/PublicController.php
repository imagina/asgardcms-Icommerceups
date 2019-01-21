<?php

namespace Modules\IcommerceUps\Http\Controllers;

use Modules\Core\Http\Controllers\BasePublicController;

class PublicController extends BasePublicController
{
   
    public function __construct()
    {
        parent::__construct();

    }

    public function rates($countryCode,$zip){

         /*

            Postal Code Tests

            99205   =   Washington
            10001   =   Miami
            01030   =   Ciudad de Mexico
            110111  =   Bogota
        
        */

        $products = array(
            'weight' => 9 
        );

        $postalCode = $zip;

        $country = null;

        $results = icommerceups_Init($products,$postalCode,$countryCode,$country);
        if($results["msj"]=="success"){
            foreach ($results["data"] as $key => $value) {
                echo "{$value->configName} - {$value->price} <br>";
                
            }
        }else{
            echo "{$results["msj"]} - {$results["data"]}";
        }

    }

    /*
    public function rate()
    {
        
       
        $accessKey = "4D3A8A2BEE16F468";
        $userId = "Xadapter";
        $password = "Force@007";
        
        $rate = new \Ups\Rate($accessKey,$userId,$password);
        
        try {
            $shipment = new \Ups\Entity\Shipment();

            $shipperAddress = $shipment->getShipper()->getAddress();
            $shipperAddress->setPostalCode('99205');// Washington

            $address = new \Ups\Entity\Address();
            $address->setPostalCode('99205'); // Washington
            //$address->setStateProvinceCode('WA'); 
            //$address->setCountryCode('US'); 

            $shipFrom = new \Ups\Entity\ShipFrom();
            $shipFrom->setAddress($address);

            $shipment->setShipFrom($shipFrom);

            $shipTo = $shipment->getShipTo();
            $shipTo->setCompanyName('Test Ship To');
            $shipToAddress = $shipTo->getAddress();
            $shipToAddress->setPostalCode('10001');// Destino
            //$shipToAddress->setStateProvinceCode('NY'); 
            //$shipToAddress->setCountryCode('US'); 

            $package = new \Ups\Entity\Package();
            $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
            $package->getPackageWeight()->setWeight(10);
            
            // if you need this (depends of the shipper country)
            $weightUnit = new \Ups\Entity\UnitOfMeasurement;
            $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_LBS);
            $package->getPackageWeight()->setUnitOfMeasurement($weightUnit);
            
            // Dimensions
            /*
            $dimensions = new \Ups\Entity\Dimensions();
            $dimensions->setHeight(10);
            $dimensions->setWidth(10);
            $dimensions->setLength(10);
            $unit = new \Ups\Entity\UnitOfMeasurement;
            $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);
            $dimensions->setUnitOfMeasurement($unit);
            $package->setDimensions($dimensions);
            */
            /*
            $shipment->addPackage($package);

            //dd($rate->getRate($shipment));

            $rates = $rate->shopRates($shipment);
    
            foreach ($rates->RatedShipment as $key => $rate) {
                echo "{$rate->Service->getName()} - {$rate->TotalCharges->MonetaryValue}<br>";
            }

        } catch (Exception $e) {
            dd($e);
        }

    }
    */

}