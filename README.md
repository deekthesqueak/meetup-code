meetup-code
===========

Sample code from Seattle PHP Meetups.

Remember to install and run Composer.

```bash
curl -sS https://getcomposer.org/installer | php
php composer.phar install --dev
```

Then copy the `phpunit.xml.dist` file to `phpunit.xml` so you can run phpunit.

```bash
cp phpunit.xml.dist phpunit.xml
./vendor/bin/phpunit
```

Windows users, you are on your own until someone let's me know how you would do this.
