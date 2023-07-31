Installing the Module
------------------------

You can install the plugin in two ways:

- Using composer (recommended)
- From zip (downloaded from GitHub)

We recommend using Magento's PHP composer integration for the cleanest installation option. A Magento2 project should have an associated composer.json file, and this file is how developers and clients get new modules in and out of their system.

**Installing the module via Composer (recommended)**

- Add the `mentionme/module-mention-me` Composer dependency to your project's composer.json as a required dependency:

```
    composer require mention-me/magento2-module
```

- Install the downloaded module via Magento's standard command line tool:
```
    php bin/magento module:enable MentionMe_MentionMe
    php bin/magento setup:upgrade
    php bin/magento cache:flush
```

[![Composer Install](https://i.ibb.co/Nmq3qMX/https-drive-google.jpg)](https://drive.google.com/file/d/1V8trUTrWVPBJN-wfAdfyhsHgjz2j0EVq/view?usp=sharing "Composer Install")

**Installing the module manually via FTP**

- Click "clone or download" above and select "Download ZIP".

- Copy the "app" folder from the downloaded zip archive in to your Magento root directory.

- Install the downloaded module via Magento's standard command line tool:
```
    php bin/magento module:enable MentionMe_MentionMe
    php bin/magento setup:upgrade
    php bin/magento cache:flush
```

[![FTP Install](https://i.ibb.co/zNYqXmk/https-drive-google.jpg)](https://drive.google.com/file/d/1WFSCMX0w5K8t_VdgKibP7r1Mg7DMY3vp/view?usp=sharing "FTP Install")

After completing the above steps for Composer or manual installation the Mention Me module will be installed ready for configuration. 

Please note, if you are
running PHP OPcache on your server and have configured it not to clear automatically then you will need to clear the OPcache in order for the new module to become 
available after the above steps.


Configuring the integrations 
----------------------

The plugin is compatible with the latest versions of the Magento platform: 2.1.18, 2.2.9, 2.3.x

Once you’ve installed the plugin:
- Navigate to Stores > Configuration > locate and select the plugin “Mention Me”
- Add the Merchant Partner Code (that your Mention Me onboarding project manager sends to you) in the General configuration section to put the integrations into effect. The integrations are enabled in the demo environment by default. 

<img width="1047" alt="Screenshot 2019-11-28 at 15 32 12" src="https://user-images.githubusercontent.com/1708430/69818711-49bcef80-11f5-11ea-85f1-a9249e7211ce.png">

Dashboard
----------------------
This is automatically enabled. 

<img width="1046" alt="Screenshot 2019-11-28 at 15 33 44" src="https://user-images.githubusercontent.com/1708430/69818710-49245900-11f5-11ea-8c65-9e11799c00da.png">
 
Referrer
----------------------

This is automatically enabled. 

The following fields will be populated when an order is placed: 
- firstname 
- surname
- customer email 
- order_number 
- order_total (the net total amount, excluding tax and shipping) 
- order_currency 
- locale (where this has been set)


<img width="1032" alt="Screenshot 2019-11-28 at 15 35 48" src="https://user-images.githubusercontent.com/1708430/69818708-49245900-11f5-11ea-952c-0dcbd6f10bff.png">
 
Referee
----------------------

This is automatically enabled. 

- Select where to place the tag from the dropdown Position on Page.
- You can use the placement option for "I will choose where to place the tag manually" if you have a more customised theme installed and the default positions on page are unsuitable for your checkout. Manually place the MM wrapper inside the template files where you want the tag to be loaded. 

<img width="1043" alt="Screenshot 2019-11-28 at 15 38 28" src="https://user-images.githubusercontent.com/1708430/69818707-49245900-11f5-11ea-9d0f-0f7a69d7ad03.png">


Conversion Message (homepage and product)
----------------------

This is automatically enabled. 

- Select where to place the tag from the dropdown Position on Page.
- You can use the placement option for "I will choose where to place the tag manually" if you have a more customised theme installed and the default positions on page are unsuitable for your checkout. Manually place the MM wrapper inside the template files where you want the tag to be loaded. 

<img width="1040" alt="Screenshot 2019-11-28 at 15 38 54" src="https://user-images.githubusercontent.com/1708430/69818706-49245900-11f5-11ea-9661-e27f199cd6fd.png">

Landing Pages 
--------------------

This integration is automatically enabled. It’s a native Magento widget that sits among many other types of widgets in the dropdown options for clients to select and configure. It’s already built into Magento and allows you to manage Landing Page widgets and place them anywhere within your site.
 
Add via Widget With Layout:
- Navigate to Content > Widgets.
- Click Add Widget in the top right of the screen.
- Choose MentionMe Landing Page as the type and your design theme.
- Click Continue.
- Give the widget a title and select the stores it  should trigger.
- Under the Widget Options tab, specify the situation parameter of the landing page.  
- Using the Layout Update section, specify on which page and within which container the landing page should show (e.g. the CMS homepage, main content area, etc).
- Send your Mention Me onboarding project manager the URL of the landing page. 

<img width="1037" alt="Screenshot 2019-11-28 at 15 39 08" src="https://user-images.githubusercontent.com/1708430/69818705-49245900-11f5-11ea-80dd-6a9c54cb4c52.png">

[![Landing Pages](https://user-images.githubusercontent.com/1708430/74347960-d36a6b00-4da9-11ea-91a8-3ea285374da9.png)](https://drive.google.com/open?id=11o4CMOHGfFiXuue8wpNz2e7AMoLNc5H0 "Landing Pages")

Saving and viewing the configuration 
--------------------

You can see the effect of each placement on the customer side by saving the configuration then following prompts to flush your cache. 

<img width="1520" alt="Screenshot 2019-11-28 at 16 11 38" src="https://user-images.githubusercontent.com/1708430/69820790-d669ac80-11f9-11ea-94af-6f2ff5f35680.png">
<img width="1521" alt="Screenshot 2019-11-28 at 16 11 55" src="https://user-images.githubusercontent.com/1708430/69820789-d669ac80-11f9-11ea-8406-e0eba80af3ab.png">


Once you’ve done this, clients can click on Customer View to see what specific tags look like for your customers. This will open into a view of the website where you can check enabled tags are in place. 

<img width="1395" alt="Screenshot 2019-11-28 at 16 16 28" src="https://user-images.githubusercontent.com/1708430/69821094-97882680-11fa-11ea-9a2a-c58d19496506.png">
<img width="1276" alt="Screenshot 2019-11-28 at 16 17 20" src="https://user-images.githubusercontent.com/1708430/69821093-97882680-11fa-11ea-972a-5b54c24cefee.png">


Upgrading the Module
--------------------

**Upgrading the module via Composer (recommended)**

- Update the `mentionme/module-mention-me` Composer dependency to the latest stable release in your project's composer.json
```
    composer require mentionme/module-mention-me --no-update
```

- Update your project's Composer dependencies
```
    composer update mentionme/module-mention-me
```

- Install the updated module via Magento's standard command line tool:
```
    php bin/magento setup:upgrade
    php bin/magento cache:flush
```

**Upgrading the module manually via FTP**

- Click "clone or download" above and select "Download ZIP".
- Ensure you completely remove the exisiting app/code/MentionMe directory
- Copy the new "app" folder from the downloaded zip archive in to your Magento root directory.

- Install the updated module via Magento's standard command line tool:
```
    php bin/magento setup:upgrade
    php bin/magento cache:flush
```

Removing the Module
--------------------

**Remove the module via Composer (recommended)**

- Remove the `mentionme/module-mention-me` Composer dependency:
```
    composer remove mentionme/module-mention-me
```

- Inform Magento of the removal with the standard command line tool:
```
    php bin/magento setup:upgrade
    php bin/magento cache:flush
```

**Remove the module manually via FTP**

- Delete the "app/code/MentionMe" folder from your Magento root directory.

- Inform Magento of the removal with the standard command line tool:
```
    php bin/magento setup:upgrade
    php bin/magento cache:flush
```

**Support**

*Important: As with installing any new software on your system, don't forget to take appropriate backup steps, and to test your release in a 
development or staging environment before deploying to production.*

Please get in touch via support@mention-me.com if you require assistance.
