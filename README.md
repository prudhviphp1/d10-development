# Drupal 10 Module Development




**Develop and deliver engaging and intuitive enterprise-level apps**

## What is this book about?
Drupal 10 Module Development is a one-stop guide that dives deep into creating complex custom modules for business needs. This book is updated on the latest version of Drupal 10, which will take you through Drupal architecture, data modeling, and APIs for module development along with recent enhancements in Drupal 10 core releases.

This book covers the following exciting features:
* Gain insight into the Drupal 10 architecture for developing advanced modules
* Master different Drupal 10 subsystems and APIs
* Optimize data management by modeling, storing, manipulating, and processing data efficiently
* Present data and content cleanly and securely using the theme system
* Understand helpful functions while dealing with managed and unmanaged files
* Ensure your Drupal app has business logic integrity with automated testing
* Implement secure coding in Drupal


## Instructions and Navigations
All of the code is organized into folders. For example, Chapter02.

The code will look like the following:
```
firstmodule.hello:
  path: '/hello'
  defaults:
    _controller:  Drupal\firstmodule\Controller\HelloDrupalController::helloDrupal
    _title: 'Our first route'
  requirements:
    _permission: 'access content'
```

**Following is what you need for this book:**
If you are a Drupal developer looking to learn Drupal 10 to write modules for your sites, this book is for you. Drupal site builders and PHP developers with basic object-oriented programming skills will also find this book helpful. Although not necessary, some Symfony experience will help with understanding concepts easily.

With the following software and hardware list you can run all code files present in the book (Chapter 1-18).
### Software and Hardware List
| Chapter | Software required | OS required |
| -------- | ------------------------------------ | ----------------------------------- |
| 1-18 | Drupal 10 | Windows, Mac OS X, and Linux (Any) |


## Setup

To set up a local development environment, perform the following:

1. Run the following commands:

```
$ docker-compose up -d
$ docker-compose exec php composer install
$ docker-compose exec php ./vendor/bin/run drupal:site-install
```

2. Go to [http://localhost:8080](http://localhost:8080) and you have a Drupal site running. To log in, use `admin` / `admin`.

## Modules

The modules covered in the book are found inside the `packt` folder in the root of the project. These are duplicated in each chapter and are individually symlinked in the Drupal custom module folder.

By default, when setting up the project, the chapter 2 modules are symlinked. You can change this by creating a local `runner.yml` file and overriding the `chapter` value that is used in the symlink (check the default in the `runner.yml.dist` file).

Once that is done, you can run the following command to symlink the right modules:

```bash
$ docker-compose exec php ./vendor/bin/run drupal:module-setup
```

## Mails

All outgoing sent using the native PHP mailer are caught using Mailhog. You can access the emails at [http://localhost:8025](http://localhost:8025).

## Tests

Run tests as follows:

```bash
$ docker-compose exec -u www-data php ./vendor/bin/phpunit
```

This will run all the tests in the configured packt modules.

## Coding standards

To run the coding standards check, use this command:

```bash
$ docker-compose exec php ./vendor/bin/run drupal:phpcs
```

And this command to try to automatically fix coding standards issues that pop up:

```bash
$ docker-compose exec php ./vendor/bin/run drupal:phpcbf
```



## Get to Know the Author
**Daniel Sipos**
is a senior web developer specializing in Drupal. He's been working with Drupal sites since version 6, and started out, like many others, as a site builder. He's a self-taught programmer with many years' experience working professionally on complex Drupal 7 and 8 projects. In his spare time, he runs webomelette, a Drupal website where he writes technical articles, tips, and techniques related to Drupal development.


