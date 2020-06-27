# Fonzip Payment Connector


## Getting Started

This Package: You to send your Fonzip Payments.

### Prerequisites

What things you need to install the software and how to install them

```
"php": "^7.2.0",
"illuminate/console": "^5.3.0",
"illuminate/support": "^5.3.0",
"laravel/laravel" : "^5.6.*"
""
```

### Installing

A step by step series of examples that tell you how to get a development env running

Step 1 : require composer package

```
composer require tanerincode/fonzip
```
Step 2 : Add Service Provider in your application config file `config/app.php`
```
...
 TanerInCode\Fonzip\FonzipServiceProvider::class,
...
```

Step 3 : add .env file this keys and values
```
FONZIP_DOMAIN=https://fonzip.com/api/v1-1/
FONZIP_APPKEY = your_application_key
FONZIP_ERROR_LOG_CHANNEL = "cloudwatch_error_logs"
```

Step 4 : Run this command and share config file
```
php artisan vendor:publish
```
ps : select `fonzip.php` config file




## Built With

* [Laravel](https://laravel.com/docs/5.7) - The laravel framework

## Authors

* **Taner Tombas** - [TanerInCode](https://github.com/tanerincode)


## License

This project is licensed under the MIT License - see the [LICENSE.md](https://github.com/tanerincode/fonzip/blob/master/LICENSE) file for details
