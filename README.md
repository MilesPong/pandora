Pandora
========

Info Reserves.

Composer
-------------

1. Install composer

```bash
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```

2. Get dependencies

```bash
cd $PROJECT_DIR
composer install
```

After running the above commands you may be requried to open the link address in browser provided by the terminal. From the page, you may see some info like this,

> Tokens you have generated that can be used to access the GitHub API.

Use the **tokens** Github returned to you, and now all the dependencies are ready.

For more usages, you could read it from [Composer](http://getcomposer.org/) website.

PHP requirements
----------------

It's recommended to check the environment of PHP before deployment.

```bash
php requirements.php
```

Adjust your PHP settings according to the returned results.

Preparing application
-----------------------

1. Initialize environment

```bash
cd $PROJECT_DIR
./init
```

Two environments are avaiable, `Prod` and `Dev`.

Now you may have all the whole files project needed.

2. Edit config

Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.

3. Mirgrate

Apply migrations with console command `./yii migrate`

```bash
./yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
./yii migrate --migrationPath=@mdm/admin/migrations
./yii migrate --migrationPath=@yii/rbac/migrations
./yii migrate
```

4. RBAC

You should uncomment the the line include `*` in the `as access` section in the `common\config\main.php` to do the first RBAC settings.

While `allowActions` is set to `*`, it means everybody is allowed to access any controllers and actions, so remember to comment it back as soon as you have your RBAC set.

More infos please check [yii2-admin](https://github.com/mdmsoft/yii2-admin)

5. User admin

There is an initial value set in the `common\config\main.php`, you could check it in the `admins` array.

The same as RBAC, it's necessary to set your value for the 1st deployment in the admin control panel. It's easy job and just set your username such as `admin`, therefor you may access to `user/admin` while you loggin as `admin`.

More infos please check [yii2-user](https://github.com/dektrium/yii2-user)

6. Domain Url

Check the files `backend\config\main-local.php` and `frontend\config\main-local.php`.

Set the frontend and backend url in the `baseUrl` section.

Web server
-----------

Set document roots of your web server:

- for frontend `/path/to/yii-application/frontend/web/` and using the frontend URL, such as `http://frontend.dev/`
- for backend `/path/to/yii-application/backend/web/` and using the backend URL, such as `http://backend.dev/`

For more settings of `Apache` and `Nginx`, you could check it from `web server section` of official docs in [docs/guide/start-installation.md](docs/guide/start-installation.md#preparing-application)

*Loaded Extensions*
-------------

Extensions mentioned below are included.

- [dektrium/yii2-user](https://github.com/dektrium/yii2-user.git)
- [mdmsoft/yii2-admin](https://github.com/mdmsoft/yii2-admin.git)


Yii 2 Advanced Project Template
---------------------------------------------

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```
