<?php
/**
 * Created by PhpStorm.
 * User: zmilan
 * Date: 4/23/15
 * Time: 11:22 PM
 */

namespace zmilan\aws;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;

class AwsBootstrap implements  BootstrapInterface
{
    public function bootstrap($app) {
        if (!$app->has('awsConfig')) {
            throw new InvalidConfigException('Missing configuration "awsConfig"!');
        }

        $conf = $app->get('awsConfig');
        // register DI singleton so we can inject it anywhere
        Yii::$container->setSingleton('recondev\aws\AwsFactory', [
            'key' => $conf->key,
            'secret' => $conf->secret,
            'config' => $conf->awsSdkConfig
        ]);
        // add Yii component 'aws' just for old style use
        Yii::$app->set('aws', Yii::$container->get('recondev\aws\AwsFactory'));
    }
}