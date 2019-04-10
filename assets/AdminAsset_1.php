<?php
namespace app\assets;

use yii\web\AssetBundle;
class AdminAsset_1 extends AssetBundle
{
    public $js = [
        // more plugin Js here
    ];
    public $css = [
        // more plugin CSS here
        'css/admin_style.css',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        ];
}