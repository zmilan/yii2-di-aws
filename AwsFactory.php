<?php
/**
 * Created by PhpStorm.
 * User: zmilan
 * Date: 4/23/15
 * Time: 11:13 PM
 */
namespace zmilan\aws;

use yii\base\Component;
use Aws\Common\Aws;

class AwsFactory extends Component
{
    public $key;
    public $secret;
    public $region;
    public $config;
    private $_aws;

    protected function getAws()
    {
        if ($this->_aws === null) {
            $this->_aws = Aws::factory($this->config);
        }
        return $this->_aws;
    }
    public function __call($method, $params)
    {
        $client = $this->getAws();
        if (method_exists($client, $method)) {
            return call_user_func_array(array($client, $method), $params);
        }

        return parent::__call($method, $params);
    }
} 