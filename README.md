<h2>DDEV Installation</h2>
Install the DDEV with following tutorial first:
https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/

Create a new project with following tutorial:
https://ddev.readthedocs.io/en/latest/users/project/
Change following variables in the config.yaml file:
<pre>
    docroot: "public"
    php_version: "8.2"
    webserver_type: apache-fpm
</pre>

Update following variable in the .env file:
<pre>DATABASE_URL=mysql://db:db@db:3306/db?serverVersion=5.7</pre>
You can skip following step, because the db already created by ddev
<pre>bin/console doctrine:database:create</pre>

After the installation start the ddev and go to into local machine with following command:
<pre>ddev ssh</pre>

Afterwards you can install the Marketplace Project with the tutorial down below.
If you are using a M1 Apple Macbook you would probably have following error:
https://stackoverflow.com/questions/68095626/node-sass-with-apple-m1-big-sur-and-arm64

You can install sass with following command:
<pre>
npm uninstall node-sass
npm install --save-dev sass
</pre>

To create an admin user use following command:
<pre>
    bin/console sylius:install:setup
</pre>

Paypal installation. Use the official tutorial except last step:
https://github.com/Sylius/PayPalPlugin/blob/1.5/docs/installation.md
<pre>
    bin/console doctrine:migrations:execute --up 'Sylius\PayPalPlugin\Migrations\Version20200907102535'
</pre>

For the creation of a custom model, you have to use SymfonyMakerBundle. Since it has conflicts with php8 use following command to install:
<pre>composer require symfony/maker-bundle --dev --ignore-platform-req=php -W</pre>


<p>
    <a href="https://github.com/BitBagCommerce/OpenMarketplace/actions">
        <img src="https://img.shields.io/github/actions/workflow/status/BitBagCommerce/OpenMarketplace/build.yml?branch=master" alt="Build">
    </a>
    <a href="https://join.slack.com/t/openmarketplacegroup/shared_invite/zt-1ks2kfsqe-w_J2uqgTMNEAYQS0xa8Q8Q">
        <img src="https://img.shields.io/badge/chat-on%20slack-e51670.svg" alt="Chat">
    </a>
    <a href="https://bitbag.io/contact-us">
        <img src="https://img.shields.io/badge/support-contact%20author-blue" alt="Contact">
    </a>
</p>

Official website: http://open-marketplace.io </br>
Demo: http://demo.open-marketplace.io

BitBag OpenMarketplace is the first open-source marketplace platform. The solution is based on Sylius, Symfony and Semantic UI meaning it is fully compatible with each. The platform is highly customizable project made using full-stack BDD with Behat and PHPSpec.

Like what we do? Give us a star! ⭐

Looking for a professional team to build a MVM for your business on top of open-source? [Contact us!](https://bitbag.io/contact-us)

---
<p align="center">
    <a href="https://bitbag.io/" target="_blank">
        <img src="doc/images/overview.png" />
    </a>
</p>

# Table of Contents

* [Overview](#overview)
* [Customization](#customization)
* [Contribution](#contribution)
* [Support](#we-are-here-to-help)
* [About us](#about-bitbag)
* [License](#license)
* [Authors](#Authors)
* [Contact](#contact)

# Overview

- [Installation](./doc/installation.md)
- [Vendor profile](./doc/vendor-profile.md)
- [Conversations](./doc/conversations.md)
- [Product Listing](./doc/product_listings.md)
- [Shipment](./doc/manage_shipping_methods.md)
- [Order Process](./doc/order_process.md)
- [Order management](./doc/manage_orders.md)
- [Clients](./doc/manage_clients.md)
- [Product Reviews](./doc/manage_product_reviews.md)
- [Customization](./doc/how_to_customize.md)
- [API](./doc/api.md)

## Customization

Our project is highly customizable, [here](./doc/how_to_customize.md) is our guide on how to do it.

## Contribution

Every contribution is meaningful, kudos to everyone who helped us with developing this project! Issues and PRs are welcomed.

## We are here to help

This **open-source project was developed to help the Sylius community**. If you have any additional questions, would like help with installing or configuring the plugin, or need any assistance with your Sylius project - let us know! For community support, join the official [OpenMarketplace Community Slack](https://join.slack.com/t/openmarketplacegroup/shared_invite/zt-1vejiwrbn-XZkLwRH5L0s4L9~qfkcP~g).

If you want to participate in the development, you can do it by submitting [pull requests](https://github.com/BitBagCommerce/OpenMarketplace/pulls) or reporting [issues](https://github.com/BitBagCommerce/OpenMarketplace/issues).

## About BitBag

BitBag is a Software House working on digital commerce projects on top of best open-source technologies, such as Sylius, Shopware, Pimcore, Symfony and Vue Storefront. We work with worldwide companies who see eCommerce as an important factor of their strategy.

If you think we could help your business within the above-mentioned technology stack, contact us directly. We could be the right people to do the job. Fill the form on [this site](https://bitbag.io/contact-us/) or send us an e-mail at hello@bitbag.io.

## License

This project's source code is completely free and released under the terms of the MIT license.

## Authors

See the full list of contributors [here](https://github.com/BitBagCommerce/OpenMarketplace/contributors).

## Contact

You can contact us using the contact form on [our website](https://bitbag.io/contact-us/) or send us an e-mail to hello@bitbag.io with your question(s). We are also active on the [community Slack](https://join.slack.com/t/openmarketplacegroup/shared_invite/zt-1ij1t41wx-HfAR6~URm3OAcqm0jc423Q).

[![](https://bitbag.io/wp-content/uploads/2021/08/badges-bitbag.png)](https://bitbag.io/contact-us/)
