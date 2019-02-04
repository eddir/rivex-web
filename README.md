## Вебприложения Rivex ##

**Вебприложения Rivex** содержат все сайты проекта Rivex.

### Установка ###

Минимальная локальная установка под OS Ubuntu 16.04 и PHP 7.2

* `git clone git@github.com:eddir/rivex-web.git rivex-web`
* `cd projectname`
* `php composer.phar install`
* `php composer.phar update`
* `cp .env.example .env`
* `php artisan key:generate`
* Откройте .env и укажите следующие значения:
   * APP_URL: `http://localhost:8000` или другой, если ипользуется apache/nginx
   * DB_DATABASE
   * DB_USERNAME
   * DB_PASSWORD
* `php artisan serve --host=localhost --port=8000` или свой домен вместо localhost. При наличии apache/nginx эту команду вводить не нужно. Используется для запуска тестового веб-сервера.
* `php artisan migrate --seed` вводиться в отдельном окне терминала.

### Include ###

* [Styleshout](https://www.styleshout.com/) for front template
* [CKEditor](http://ckeditor.com) the great editor
* [Elfinder](https://github.com/Studio-42/elFinder) the nice file manager
* [Sweat Alert](http://t4t5.github.io/sweetalert/) for the cool alerts
* [AdminLTE](https://adminlte.io/themes/AdminLTE/index2.html) the great admin template
* [Gravatar](https://github.com/creativeorange/gravatar) the Gravatar package
* [Intervention Image](http://image.intervention.io/) for image manipulation
* [Email confirmation](https://github.com/bestmomo/laravel-email-confirmation) the package for email confirmation
* [Artisan language](https://github.com/bestmomo/laravel-artisan-language) the package for language strings management
* [Laravel debugbar](https://github.com/barryvdh/laravel-debugbar)
* [Etrepat baum](https://github.com/etrepat/baum) for comments management

### Tricks ###

To use application the database is seeding with users :

* Administrator : email = admin@la.fr, password = admin
* Redactor : email = redac@la.fr, password = redac
* User : email = walker@la.fr, password = walker
* User : email = slacker@la.fr, password = slacker

### Tests ###

When you want to launch the tests refresh and populate the database :

`php artisan migrate:fresh --seed`

Then:

`./vendor/phpunit/phpunit/phpunit && php artisan dusk`
