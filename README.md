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
        * @param Requests request
        * @param Requests array "products" - items (object) 
        * @param Requests array "products" - total (float)
        * @param Requests array "options" - countryCode (string)
        * @param Requests array "options" - postCode (varchar)
        * @param Requests array "options" - country (string)

    ### Example
        https://icommerce.imagina.com.co/api/icommerceups
