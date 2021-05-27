# <p align="center"><a href="https://smsales.co.ke" target="_blank"><img width="200" src="https://smsales.co.ke/images/logo.png"></a></p>

<p align="center">
  <b>Always Delivering</b><br>
  <a href="https://github.com/SHIFTECH-AFRICA/smsales-php-sdk/issues">
  <img src="https://img.shields.io/github/issues/SHIFTECH-AFRICA/smsales-php-sdk.svg">
  </a>
  <a href="https://github.com/SHIFTECH-AFRICA/smsales-php-sdk/network/members">
  <img src="https://img.shields.io/github/forks/SHIFTECH-AFRICA/smsales-php-sdk.svg">
  </a>
  <a href="https://github.com/SHIFTECH-AFRICA/smsales-php-sdk/stargazers">
  <img src="https://img.shields.io/github/stars/SHIFTECH-AFRICA/smsales-php-sdk.svg">
  </a>
  <a href="https://packagist.org/packages/shiftechafrica/smsales-php-sdk">
  <img src="https://poser.pugx.org/shiftechafrica/smsales-php-sdk/v/stable">
  </a>
  <a href="https://packagist.org/packages/shiftechafrica/smsales-php-sdk">
  <img src="https://poser.pugx.org/shiftechafrica/smsales-php-sdk/downloads">
  </a>
  <br><br>
  <a href="https://docs.smsales.co.ke/"><img src="https://github.com/dev-techguy/TechGuy/blob/master/doc.png" width="200"></a>
</p>

## Introduction

This library handles all the SMSALES API's.

## Installing

The recommended way to install smsales-php-sdk is through
[Composer](http://getcomposer.org).

```bash
# Install package via composer
composer require shiftechafrica/smsales-php-sdk
```

Next, run the Composer command to install the latest stable version of *shiftechafrica/smsales-php-sdk*:

```bash
# Update package via composer
 composer update shiftechafrica/smsales-php-sdk --lock
```

After installing, the package will be auto discovered, But if need you may run:

```bash
# run for auto discovery <-- If the package is not detected automatically -->
composer dump-autoload
```

Then run this, to get the *config/smsales.php* for your own configurations:

```bash
# run this to get the configuration file at config/smsales.php <-- read through it -->
php artisan vendor:publish --provider="SMSALES\SMSALEServiceProvider"
```

A *config/.php* file will be created, follow the example below to define your own configurations.

```dotenv
# set your account secret key api token
SMSALES_API_TOKEN=check_on_api_profile
```

## Usage

Follow the steps below on how to use the smsales-php-sdk:

#### How to use the Library

How to use the smsales-php-sdk to initiate different levels of *api's*

```php
        use SMSALES\API\Trigger;
        
        /**
         * Fetch latest sent sms
         */
        (new Trigger())->index();
  
        /**
         * initiate bulk sms
         * @return mixed
         */
        (new Trigger())->send([
            "message" => "",// required
            "phone_numbers" => ["2547XXXXXXXX","2540XXXXXXXX","2547XXXXXXXX"],// required
            "scheduled_at" => "Y-m-d H:i:s", // optional
            "callback_url"=> "https://yourdomain/report"// optional this should be a POST request
        ]);
```

## API Responses

These are the responses.

### Successful bulk sms

```json
{
    "data": {
        "message": "Accepted for processing..."
    }
}
```

### Callback report for the bulk sms

```json
{
    "sent": true,
    "phone_number": "2547XXXXXXXX",
    "batch": "1EPDHVREI6",
    "account": {
        "sms_balance": 764
    }
}
```

## Version Guidance

| Version | Status | Packagist                    | Namespace | Repo                                                                         |
| ------- | ------ | ---------------------------- | --------- | ---------------------------------------------------------------------------- |
| 1.x     | Latest | `shiftechafrica/smsales-php-sdk` | `SMSALES`     | [v1.0.0](https://github.com/SHIFTECH-AFRICA/smsales-php-sdk/releases/tag/v1.0.0) |

[smsales-php-sdk-repo]: https://github.com/SHIFTECH-AFRICA/smsales-php-sdk.git

## Security Vulnerabilities

For any security vulnerabilities, please email to [Shiftech Africa](mailto:bugs@shiftech.co.ke).

## License

This package is open-source, licensed under the [MIT License](https://opensource.org/licenses/MIT).
