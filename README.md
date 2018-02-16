Requirements
-------

Requires Composer ([Getting Started](https://getcomposer.org/doc/00-intro.md))
You will need **PHP >= 7.1.3** and the `mbstring` extension.

Install
-------

Install using Composer.

```
$ composer install
```

Usage
-------

To create the CSV you can either write

```
$ php get-payment-dates
```

or

```
$ php bin/console app:get-payment-dates
```

Info
-------

The application uses:
- [Symfony 4 skeleton](https://github.com/symfony/skeleton)
- [thephpleague CSV](https://github.com/thephpleague/csv)