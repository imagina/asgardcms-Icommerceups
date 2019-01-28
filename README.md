# asgardcms-icommerceups

## Seeder

    run php artisan module:seed Icommerceups

## Vendors

    - add composer.json 
        "gabrielbull/ups-api": "^0.7.6"

    - That's all :)
    

## Configurations

    - Access Key
    - User ID
    - Password
    - Mode (Sandbox or Live)
    - Shipper Postalcode
    - Shipper Statecode
    - Shipper Countrycode

## API
    
    ### Parameters
        * @param Request (products,options)
        * @param Request array "products" - items (object) 
        * @param Request array "products" - total (float)
        * @param Request array "options" - countryCode (string)
        * @param Request array "options" - postCode (varchar)
        * @param Request array "options" - country (string)

    ### Example
        https://mydomain/api/icommerceups
