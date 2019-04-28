东合im服务端接口
========
安装
--------

使用 composer
```shell
composer require linshunwei/danhar-im
```

在配置文件中添加服务提供者（Laravel5.5 有自动添加）
```php
'providers' => [
    //...
    linshunwei\DanharIm\DanharImServiceProvider::class,
    //...
],
```

复制配置文件到配置目录，配置文件内容不多，而且可以在 `.env` 文件中设置。手动复制或者使用命令复制：
```shell
php artisan vendor:publish --provider="Linshunwei\DanharIm\DanharImServiceProvider"
```

修改配置文件 `config/danhar-im.php`
```php
    'host' => env('DANHAR_IM_HOST', '127.0.0.1'),
    'app_id' => env('DANHAR_IM_APP_ID', ''),
    'app_secret' => env('DANHAR_IM_APP_SECRET', ''),
```

或者直接在 `.env` 文件中设置需要修改的内容，没有特殊情况默认即可
```
DANHAR_IM_HOST=127.0.0.1
DANHAR_IM_APP_ID=xxxx
DANHAR_IM_APP_SECRET=xxx
```

