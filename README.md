Work with anti-captcha.com using API v.2.0
==========================================

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist sabirov/yii2-anti-captcha-v2 "*"
```

or add

```
"sabirov/yii2-anti-captcha-v2": "*"
```

to the require section of your `composer.json` file.

Usage
-----

> Refer to the [Official Documentation](https://anticaptcha.atlassian.net/wiki/display/API/API+v.2+Documentation) 

###  ImageToTextTask : solve usual image captcha

A simple example  :

```php
use Sabirov\AntiCaptcha\ImageToText;

$anticaptcha = new ImageToText();
$anticaptcha->setVerboseMode(true); // chatty mode ON
$anticaptcha->setKey( 'YourСlientKey' );
$anticaptcha->setFile( '/path/to/image' );

if ( ! $anticaptcha->createTask() ) {
    $anticaptcha->debout( "API v2 send failed - " . $anticaptcha->getErrorMessage(), "red" );

    return false;
}

$taskId = $anticaptcha->getTaskId();

if ( ! $anticaptcha->waitForResult() ) {
	$anticaptcha->debout( "could not solve captcha", "red" );
	$anticaptcha->debout( $anticaptcha->getErrorMessage() );
} else {
	echo "\nhash result: " . $captcha_result . "\n\n";
}
```

Object structure:

Property | Set property| Type | Required | Default value | Purpose
---------|-------------|------|----------|---------------|--------
body|setFile($fileName)|String|Yes|-|in the set function to pass the absolute path to the image
phrase|setPhraseFlag($value)|Boolean|No|false|**false** - no requirements  **true** - worker must enter an answer with at least one "space"
case|setCaseFlag($value)|Boolean|No|false|**false** - no requirements  **true** - worker will see a special mark telling that answer must be entered with case sensitivity.
numeric|setNumericFlag($value)|Integer|No|0|**0** - no requirements  **1** - only number are allowed  **2** - any letters are allowed except numbers
math|setMathFlag($value)|Boolean|No|false|**false** - no requirements  **true** - worker will see a special mark telling that answer must be calculated
minLength|setMinLengthFlag($value)|Integer|No|0|**0** - no requirements  **>1** - defines minimum length of the answer
maxLength|setMaxLengthFlag($value)|Integer|No|0|**0** - no requirements **>1** - defines maximum length of the answer

### NoCaptchaTask : Google Recaptcha puzzle solving

> Refer to the [Official Documentation](https://anticaptcha.atlassian.net/wiki/display/API/NoCaptchaTask+%3A+Google+Recaptcha+puzzle+solving) 

### NoCaptchaTaskProxyless : Google Recaptcha puzzle solving without proxies

A simple example  :

```php
use Sabirov\AntiCaptcha\NoCaptchaProxyless;

$anticaptcha = new NoCaptchaProxyless();
$anticaptcha->setVerboseMode(true); // chatty mode ON
$anticaptcha->setKey( 'YourСlientKey' );
$anticaptcha->setWebsiteURL( 'https://www.instagram.com/' );
$anticaptcha->setWebsiteKey( '6LebnxwUAAAAAGm3yH06pfqQtcMH0AYDwlsXnh-u' );

if ( ! $anticaptcha->createTask() ) {
	$anticaptcha->debout( "API v2 send failed - " . $anticaptcha->getErrorMessage(), "red" );
	return false;
}

$taskId = $anticaptcha->getTaskId();

if ( ! $anticaptcha->waitForResult() ) {
	$anticaptcha->debout( "could not solve captcha", "red" );
	$anticaptcha->debout( $anticaptcha->getErrorMessage() );
	return false;
} else {
	echo "\nhash result: " . $anticaptcha->getTaskSolution() . "\n\n";
}
```

Object structure:

Property | Set property| Type | Required | Purpose
---------|-------------|------|----------|--------
websiteURL|setWebsiteURL( $value )|String|Yes|Address of target web page
websiteKey|setWebsiteKey( $value )|String|Yes|Recaptcha website key                                              <div class="g-recaptcha" data-sitekey="THAT_ONE"></div>
websiteSToken|setWebsiteSToken( $value )|String|No|Secret token for previous version of Recaptcha (now deprecated). In most cases websites use newer version and this token is not required.