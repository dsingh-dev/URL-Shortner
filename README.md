## About URl Shortner

This is a URL shortner application built on top of Laravel 12 and uses tailwind CSS classes for the frontend.

## Installation

This is a regular Laravel application; it's build on top of Laravel 12 and uses tailwind CSS classes for the frontend.

In terms of local development, you can use the following requirements:

- PHP 8.3 - with mysql, and other common extensions.

If you have these requirements, you can start by cloning the repository and installing the dependencies:

```bash
git clone https://github.com/dsingh-dev/URL-Shortner.git URL-Shortner

cd URL-Shortner

Next, install the dependencies using [Composer](https://getcomposer.org):

```bash
composer install
```

Now install node dependencies and build assets:

```bash
npm install
npm run build
```

After that, set up your `.env` file:

```bash
cp .env.example .env

php artisan key:generate
```

Prepare your database in newly created env file in project root:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url_shortner
DB_USERNAME=root
DB_PASSWORD=
```
Also we need mail driver also to invite users so update env for mail driver with you own mail credentials

```bash
MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=username
MAIL_PASSWORD=password
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```
Run migrations:

```bash
php artisan migrate
```

Seed the database:

```bash
php artisan db:seed
```

Run test suite to ensure everything is working:

```bash
composer test
```

## Tooling

URL-Shortner uses a few tools to ensure the code quality and consistency. Of course, [Pest](https://pestphp.com) is the testing framework of choice, and we also use [PHPStan](https://phpstan.org) for static analysis.
