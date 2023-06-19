# php-webconfig
 PHP SDK for managing a web.config file

| Build | License |
| ----- | ------- |
| [![CI][x1]][y1] | [![License][x3]][y3] |

### Requirements
- PHP >= 7.1
- DOM extension
- SimpleXML extension

### Installation
If Composer is not installed on your system yet, you may go ahead and install it using this command line:
```
$ curl -sS https://getcomposer.org/installer | php
```
Next, add the following require entry to the <code>composer.json</code> file in the root of your project.
```json
{
    "require" : {
        "riverside/php-webconfig" : "*"
    }
}
```
Finally, use Composer to install php-express and its dependencies:
```
$ php composer.phar install 
```

[x1]: https://github.com/riverside/php-webconfig/actions/workflows/test.yml/badge.svg
[y1]: https://github.com/riverside/php-webconfig/actions/workflows/test.yml
[x3]: https://poser.pugx.org/riverside/php-webconfig/license
[y3]: https://packagist.org/packages/riverside/php-webconfig