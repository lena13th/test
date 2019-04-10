<?php
namespace app\assets;

use yii\web\AssetBundle;
class AdminAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $js = [
        // more plugin Js here
        '/js/init_admin.js',
    ];
    public $css = [
        // more plugin CSS here
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}