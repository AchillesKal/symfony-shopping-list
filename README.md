# Shopping list app

An app to keep your shopping lists and shopping items.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
Give examples
```


### Setup

If you've just downloaded the code, congratulations!

To get it working, follow these steps:

**Download Composer dependencies**

Make sure you have [Composer installed](https://getcomposer.org/download/)
and then run:

```
composer install
```

You may alternatively need to run `php composer.phar install`, depending
on how you installed Composer.

**Download Yarn dependencies**
```
yarn install
```


**Generate front-end assets**
```
yarn run dev
```

**Start the built-in web server**

You can use Nginx or Apache, but the built-in web server works
great:

```
php -S 127.0.0.1:8000 -t public
```

Now check out the site at `http://localhost:8000`

Have fun!

## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Symfony 4 ](https://symfony.com/) - PHP Framework
* [Yarn](https://yarnpkg.com) - Front-end Dependency Management

## Authors

* **Achilles Kaloeridis** - [achilleskal](https://github.com/AchillesKal)

See also the list of [contributors](https://github.com/AchillesKal/symfony-shopping-list/graphs/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
