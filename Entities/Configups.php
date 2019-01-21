<?php
namespace Modules\IcommerceUps\Entities;

class Configups
{
  private $access_key;
  private $user_id;
  private $password;
  private $mode;
  private $weight_dimentions;
  private $shipper_postalcode;
  private $shipper_statecode;
  private $shipper_countrycode;
  private $status;

  
  public function __construct()
  {
    $this->access_key = setting('icommerceups::access_key');
    $this->user_id = setting('icommerceups::user_id');
    $this->password = setting('icommerceups::password');
    $this->mode = setting('icommerceups::mode');
    $this->weight_dimentions = setting('icommerceups::weight_dimentions');
    $this->shipper_postalcode = setting('icommerceups::shipper_postalcode');
    $this->shipper_statecode = setting('icommerceups::shipper_statecode');
    $this->shipper_countrycode = setting('icommerceups::shipper_countrycode');
    $this->status = setting('icommerceups::status');
    
  }
  
  
  public function getData()
  {
    return (object) [
      'access_key' => $this->access_key,
      'user_id' => $this->user_id,
      'password' => $this->password,
      'mode' => $this->mode,
      'weight_dimentions' => $this->weight_dimentions,
      'shipper_postalcode' => $this->shipper_postalcode,
      'shipper_statecode' => $this->shipper_statecode,
      'shipper_countrycode' => $this->shipper_countrycode,
      'status' => $this->status,
    ];
  }
  
  public function calculate($cart){
  
  }
  
}