# yii2-di-aws
Example of using aws-sdk trough Yii2 DI container

Inside of configuration file add something like this:

```php
'components' => [
	'awsConfig' => [
		'class' => 'zmilan\aws\AwsConfig',
		'key' => 'your_key',
		'secret' => 'your_secret',
		'region' => 'your_region',
		// optional config file
		//'configFile' => require_once('/path/to/aws.config.php'),
	]
]
```

Once the extension is installed, you can inject it into any function:

```php
class MyObject extends Object {
  protected $_aws;
  public function __construct(AwsFactory $aws, $config = []) {
    $this->_aws = $aws;
    parent::__construct($config);
  }
  
  public function doSomethingWithS3() {
    $s3 = $this->_aws->get('S3');
    $s3->putObject(...);
  }
}
```
or access it like Yii2 application component:
```php
class MyObject extends Object {
  public function doSomethingWithS3() {
    $s3 = Yii::$app->aws->get('S3');
    $s3->putObject(...);
  }
}
```
