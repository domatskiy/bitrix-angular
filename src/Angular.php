<?php

namespace Domatskiy;

/**
 * @var $APPLICATION CMain
 */

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Page\Asset;

class Angular
{
    protected $modules = array();
    protected $vendor_js = '';
    protected $app_js = '';
    protected $js = array();

    /**
     * @var \Domatskiy\Angular
     */
    protected static $instance;

    function __construct()
    {

    }

    /**
     * @return Angular
     */
    public static function getInstance()
    {
        if(!(static::$instance instanceof \Domatskiy\Angular))
            static::$instance = new static();

        return static::$instance;
    }

    public function setVendorJs($path)
    {
        $this->vendor_js = $path;
    }

    public function addModule($code, $path){

        if(!is_string($code) || $code == '')
            throw new ArgumentException('not correct module name');

        # TODO $code на символы

        if(!is_string($path) || $path == '')
            throw new ArgumentException('not correct module name');

        $this->modules[$code] = $path;
    }

    public function addLoadedModule($code){

        if(!is_string($code) || $code == '')
            throw new ArgumentException('not correct module name');

        $this->modules[$code] = null;
    }


    public function setAppJs($path){

        if(!is_string($path) || $path == '')
            throw new ArgumentException('not correct module name');

        $this->app_js = $path;
    }

    public function addJs($path){

        if(!is_string($path) || $path == '')
            throw new ArgumentException('not correct module name');

        $this->js[] = $path;
    }

    public function init()
    {
        $asset = Asset::getInstance();

        if($this->vendor_js)
            $asset->addJs($this->vendor_js);

        $asset->addString('<script>var app_modules = '.\CUtil::PhpToJSObject(array_keys($this->modules)).';</script>');

        foreach ($this->modules as $code => $path)
            if($path)
                $asset->addJs($path);

        if($this->app_js)
            $asset->addJs($this->app_js);

        foreach ($this->js as $path)
            $asset->addJs($path);

    }
}