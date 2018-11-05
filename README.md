# Fork CMS Mailchimp module
This module allows visitors to subscribe for specific Mailchimp lists in you Fork CMS installation.

## Capabilities
* Set subscription status
* Select a list to subscribe to
* Store name of subscriber

## How to install

### 1. Upload the module
Upload this module as usual, copy the `Mailchimp` folder from the `Backend` and `Frontend`.

### 2. Run composer
This module requires extra dependencies, you can install these by running:

```
composer require thinkshout/mailchimp-api-php
```

### 3. Run module installer
* Login on the backend of the website
* Navigate to `Settings` -> `Modules` and scrolldown
* Now you will find the `Mailchimp` module in the `Not installed modules` list
* Click on `Install`

### 4. Configure the Mailchimp module
* Go to `Settings` -> `Mailchimp`
* Set your API key, which you can retrieve here: https://admin.mailchimp.com/account/api/
* Click on `Create A Key`
* Insert the key and save the page, now you should be able to select a list