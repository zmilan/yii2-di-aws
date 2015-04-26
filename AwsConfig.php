<?php
/**
 * Created by PhpStorm.
 * User: zmilan
 * Date: 4/23/15
 * Time: 11:13 PM
 */

namespace zmilan\aws;

use yii\base\Object;
use yii\base\InvalidConfigException;

class AwsConfig extends Object
{
    public $key;
    public $secret;
    public $region;
    public $awsSdkConfig;

    public function init()
    {
        parent::init();

        if ($this->awsSdkConfig === null) {
            if (!$this->key) {
                throw new InvalidConfigException('Key cannot be empty!');
            }
            if (!$this->secret) {
                throw new InvalidConfigException('Secret cannot be empty!');
            }
            if (!$this->region) {
                throw new InvalidConfigException('Region cannot be empty!');
            }
            $this->awsSdkConfig = [
                'key' => $this->key,
                'secret' => $this->secret,
                'region' => $this->region
            ];
        } else {
            if (!is_array($this->awsSdkConfig) && !file_exists($this->awsSdkConfig)) {
                throw new InvalidConfigException("{$this->awsSdkConfig} does not exist");
            }
        }
    }
}