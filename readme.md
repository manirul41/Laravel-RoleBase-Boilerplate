## About Laravel

Laravel Role Base Boilerplate provides a very flexible and extensible way of building your custom Laravel 5 applications with user role and maintain resource.

## System Requirements

To be able to run Laravel Boilerplate you have to meet the following requirements:

* PHP >= 7.1.0
* Composer > 1.0.0

## Installation

1. Install Composer using detailed installation instructions [here](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

2. Clone repository
    ```
    $ git clone https://github.com/manirul41/Laravel-RoleBase-Boilerplate.git
    ```
3. Change into the working directory
    ```
    $ cd laravel-rolebase-boilerplate
    ```
4. Copy .env.example to .env and modify according to your environment
    ```
    $ cp .env.example .env
    ```
5. Install composer dependencies
    ```
    $ composer install --prefer-dist
    ```
6. An application key can be generated with the command
    ```
    $ php artisan key:generate
    ```
7. artisan vendor:publish and select only acl provider number e.g: enter 8
    ```
    $ artisan vendor:publish
    ```
8. Run these commands to create the tables within the defined database and populate seed data
    ```
    $ php artisan migrate --seed
    ```
8. Execute following commands to install other dependencies

$ npm install
$ npm run dev

## Role User Access Management
* admin user only access role management by [root-url]/role
    * admin can maintain which method a user can use or not.

## Troubleshooting

* If you get an forbidden message on /home then please login with admin role user and then goto to [root-url]/role and then click edit default role and check mark Home GET::Index and update role.
* If you see any kind of class not found type error try running composer dump-autoload

## Special Thanks
[Mahabubul Hasan](https://github.com/mahabubulhasan) Bhai for his [ACL Package](https://packagist.org/packages/uzzal/acl)

## Security Vulnerabilities

If you discover a security vulnerability within Laravel Boilerplate, please send an e-mail to Manirul Islam via [manirul41@gmail.com](mailto:manirul41@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).


