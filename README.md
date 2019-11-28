Installing the Module
------------------------

You can install the plugin in two ways:

- Using composer (recommended)
- From zip (downloaded from GitHub)

We recommend using Magento's PHP composer integration for the cleanest installation option. A Magento2 project should have an associated composer.json file, and this file is how developers and clients get new modules in and out of their system.

**Installing the module via Composer (recommended)**

- Add this GitHub repository to your project's composer.json as a Composer source repository:
```
    composer config repositories.mentionme vcs https://github.com/mention-me/magento2-integration
```

- Add the `mentionme/module-mention-me` Composer dependency to your project's composer.json as a required dependency:
```
    composer require mentionme/module-mention-me --no-update
```

- Update your project's Composer dependencies:
```
    composer update mentionme/module-mention-me
```

- Install the downloaded module via Magento's standard command line tool:
```
    php bin/magento module:enable MentionMe_MentionMe
    php bin/magento setup:upgrade
    php bin/magento cache:flush
```

[insert video - in google drive]

**Installing the module manually via FTP**

- Click "clone or download" above and select "Download ZIP".

- Copy the "app" folder from the downloaded zip archive in to your Magento root directory.

- Install the downloaded module via Magento's standard command line tool:
```
    php bin/magento module:enable MentionMe_MentionMe
    php bin/magento setup:upgrade
    php bin/magento cache:flush
```

[insert video - in google drive]

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

[insert image: general configuration]

Dashboard
----------------------
This is automatically enabled. 

[insert image: dashboard]
 
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


[insert image: referrer]
 
Referee
----------------------

This is automatically enabled. 

- Select where to place the tag from the dropdown Position on Page.
- You can use the placement option for "I choose where to place the tag manually" if you have a more customised theme installed and the default positions on page are unsuitable for your checkout. Manually place the MM wrapper inside the template files where you want the tag to be loaded. 

[insert image: referee]


Conversion Message (homepage and product)
----------------------

This is automatically enabled. 

- Select where to place the tag from the dropdown Position on Page.
- You can use the placement option for "I choose where to place the tag manually" if you have a more customised theme installed and the default positions on page are unsuitable for your checkout. Manually place the MM wrapper inside the template files where you want the tag to be loaded. 

[insert image: homepage and product]

Landing Pages 
--------------------

This integration is automatically enabled. It’s a native Magento widget that sits among many other types of widgets in the dropdown options for clients to select and configure. It’s already built into Magento and allows you to manage Landing Page widgets and place them anywhere within their site.
 
Add via Widget With Layout:
- Navigate to Content > Widgets.
- Click Add Widget in the top right of the screen.
- Choose MentionMe Landing Page as the type and your design theme.
- Click Continue.
- Give the widget a title and select the stores it  should trigger.
- Under the Widget Options tab, specify the situation parameter of the landing page.  
- Using the Layout Update section, specify on which page and within which container the landing page should show (e.g. the CMS homepage, main content area, etc).
- Send your Mention Me onboarding projetc manager the URL of the landing page. 

[insert video from google drive]

Saving and viewing the configuration 
--------------------

You can see the effect of each placement on the customer side by saving the configuration then following prompts to flush your cache. 

[insert pics: configuration and cache management] 


Once you’ve done this, clients can click on Customer View to see what specific tags look like for your customers. This will open into a view of the website where you can check enabled tags are in place. 

[insert pics: customer view and customer view site]


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
