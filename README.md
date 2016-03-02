# mobilecommonsd [![Wercker](https://img.shields.io/wercker/ci/56d705051618a4fe2c0091c5.svg?style=flat-square)](https://app.wercker.com/#applications/56d705051618a4fe2c0091c5) [![StyleCI](https://styleci.io/repos/52885874/shield)](https://styleci.io/repos/52885874)

This is Northstar's __mobilecommonsd__, a lightweight worker which synchronizes changes in
[Mobile Commons](https://mobilecommons.com) profiles into our user API. It is built using
[Lumen 5.2](https://lumen.laravel.com), the Laravel micro-framework.

## Contributing

Fork and clone this repository, and install into your local [DS Homestead](https://github.com/DoSomething/ds-homestead).

After installation, set environment variables & run the outstanding migrations:

    $ cp .env.example .env
    $ php artisan migrate

You may run unit tests locally using PHPUnit:

    $ vendor/bin/phpunit
    
We follow [Laravel's code style](http://laravel.com/docs/5.1/contributions#coding-style) and automatically
lint all pull requests with [StyleCI](https://styleci.io/repos/26884886). Be sure to configure
[EditorConfig](http://editorconfig.org) to ensure you have proper indentation settings.

Consider [writing a test case](http://laravel.com/docs/5.1/testing) when adding or changing a feature.
Most steps you would take when manually testing your code can be automated, which makes it easier for
yourself & others to review your code and ensures we don't accidentally break something later on!


### License
&copy;2016 DoSomething.org. mobilecommonsd is free software, and may be redistributed under the terms specified
in the [LICENSE](https://github.com/DoSomething/northstar-mobilecommonsd/blob/dev/LICENSE) file. The name and logo for
DoSomething.org are trademarks of Do Something, Inc and may not be used without permission.


