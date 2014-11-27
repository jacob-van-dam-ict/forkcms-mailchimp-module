# Installation

* Composer
```js
{
    "require": {
        "zfr/zfr-mailchimp-bundle": "2.*"
    }
}
```
* Appkernel

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new ZfrMailChimpBundle\ZfrMailChimpBundle()
    );
}
```

* App/Config/Parameters.yml

``` yml
mailchimp.apikey:       yourApiKeyComesHere
```
* App/Config/Config.yml

``` yml
zfr_mail_chimp:
    api_key: %mailchimp.apikey%
    async: false
```


* Use the module installer
