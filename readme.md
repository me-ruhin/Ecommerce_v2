<p align="center">
    <img src="https://s-cart.org/logo.png" width="150">
</p>
<p align="center">Free Laravel e-commerce for business<br>
    <code><b>composer create-project lanhktc/s-cart</b></code></p>
<p align="center">
 <a href="https://s-cart.org">Home page</a> | <a href="https://demo.s-cart.org">Demo</a> | <a href="https://demo.s-cart.org/sc_admin">Demo admin</a> | <a href="https://s-cart.org/installation.html">Installation</a>  | <a href="https://s-cart.org/video-guide.html">Video Guide</a> | <a href="https://s-cart.org/download.html">Download full source</a>
</p>
<p align="center">
<a href="https://packagist.org/packages/lanhktc/s-cart"><img src="https://poser.pugx.org/lanhktc/s-cart/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/lanhktc/s-cart"><img src="https://poser.pugx.org/lanhktc/s-cart/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/lanhktc/s-cart"><img src="https://poser.pugx.org/lanhktc/s-cart/license.svg" alt="License"></a>
</p>

## About S-cart
Free Open source E-commerce use Laravel framework for Business

## Support the project
Support this project :stuck_out_tongue_winking_eye: :pray:
<p align="center">
    <a href="https://www.paypal.me/LeLanh" target="_blank"><img src="https://img.shields.io/badge/Donate-PayPal-green.svg" data-origin="https://img.shields.io/badge/Donate-PayPal-green.svg" alt="PayPal Me"></a>
</p>

## S-Cart functions:

<pre>
======= FRONT-END =======

- Multi-language
- Multi-currency
- Shopping cart
- Customer login
- Product attributes: cost price, promotion price, stock..
- CMS content: category, news, content, web page
- Module/Extension: Shipping, payment, discount, ...
- Upload manager: banner, images,..
...

======= ADMIN =======

- Admin roles, permission
- Product manager
- Order management
- Customer management
- Template manager
- Module/Extension manager
- System config: email setting, info shop, maintain status,...
- Backup, restore data
- Report: chart, statistics, export csv, pdf...
...

</pre>

## Technology
- Core <a href="https://laravel.com">Laravel Framework</a>

## Requirements:

Version 3.2, 3.3:

> Core laravel framework 6.x Requirements::

```
- PHP >= 7.2
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension
```

## Installation & configuration:

<b>How to map your domain to s-cart? <a href="https://s-cart.org/installation.html">CLICK HERE</a></b>

Step1: Install last version S-cart
```
composer create-project lanhktc/s-cart
```
Step2: Set writable permissions for the following directories: 
- Chmod -R 777 <code>storage</code>
- Chmod -R 777 <code>vendor</code>
- Chmod -R 777 <code>public/data</code>

Step3:
```
- Create a new database. Example database name is "s-cart"
```

Step4:

```
Access your-domain.com/install.php to install S-cart.
If installing with link "install.php" unsuccessful, you can install it manually below.
```

Step5:

NOTE: Please <b>remove</b> or <b>rename</b> file <code>public/install.php</code> so others cannot access it.

Step6:
- Access to url admin: <b>your-domain/sc_admin</b>.
- User/pass <code><b>admin</b>/<b>admin</b></code>

OR manual installation:
```
- Step1: Create database, then import file .sql in folder database to database.
- Step2: Rename or delete file public/install.php
- Step3: Copy file .env.example to .env if file .env not exist.
- Step4: Generate API key if APP_KEY is null. 
  Use command "php artisan key:generate"
- Step5: Config value of file .env:
APP_DEBUG=false (Set "false" is security)
DB_HOST=127.0.0.1 (Database host)
DB_PORT=3306 (Database port)
DB_DATABASE=s-cart (Database name)
DB_USERNAME=root (User name use database)
DB_PASSWORD= (Password connect to database)
APP_URL=http://localhost (Your url)
ADMIN_PREFIX=sc_admin (Path to admin)
```


## License:

`S-Cart` is licensed under [The MIT License (MIT)](LICENSE).

## Demo:

- Font-end : http://demo.s-cart.org
- Back-end: http://demo.s-cart.org/sc_admin   <code>User/pass: test/123456</code>

## 

VPS SSD $5/mo, gets $50 in credit over 30 days. [DigitalOcean](https://m.do.co/c/450877e92a78).


## Screenshots:


<p><img src="https://s-cart.org/images/screen/v31/home.jpg" /></p>

#Product detail

<p><img src="https://s-cart.org/images/screen/v31/detail-1.jpg" /></p>

#Product bundle

<p><img src="https://s-cart.org/images/screen/v31/detail-bundle.jpg" /></p>

#Product group

<p><img src="https://s-cart.org/images/screen/v31/detail-group.jpg" /></p>

#Cart

<p><img src="https://s-cart.org/images/screen/v31/cart.jpg" /></p>

#Admin homepage

<p><img src="https://s-cart.org/images/screen/v31/admin-home.jpg" /></p>

#Order list

<p><img src="https://s-cart.org/images/screen/v31/order-list.jpg" /></p>

#Order detail

<p><img src="https://s-cart.org/images/screen/v31/order-detail.jpg" /></p>

#Product list

<p><img src="https://s-cart.org/images/screen/v31/product-list.jpg" /></p>

#Product detail

<p><img src="https://s-cart.org/images/screen/v31/product-detail.jpg" /></p>

#Auth

<p><img src="https://s-cart.org/images/screen/v31/auth.jpg" /></p>

#Backup

<p><img src="https://s-cart.org/images/screen/v31/backup.jpg" /></p>

