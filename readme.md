# bitrix-angular

## install 

```
composer require domatskiy/bitrix-angular
```
## use

in php_interface/init.php

```php
if(class_exists('\Domatskiy\Angular'))
{
    $EventManager->addEventHandler("main", "OnEpilog", "OnEpilogHandler", true, 2);

    function OnEpilogHandler()
    {
        $angular = \Domatskiy\Angular::getInstance();
        //$angular->setVendorJs(SITE_TEMPLATE_PATH."/js/angular.min.js"); // add in header vendor js
        $angular->setAppJs(SITE_TEMPLATE_PATH."/assets/app/app.min.js");
        $angular->addModule('<module_name>', '<module_path>');
        $angular->init();

    }

}
```

in component_epilog.php 

```php
if(class_exists('\Domatskiy\Angular'))
{
	$angular = \Domatskiy\Angular::getInstance();
	$angular->setAppJs(<path_template_js>);
	$angular->addModule('<module_name>', '<module_path>');
}
```
