
### Installation Instructions
1. Run `git clone https://github.com/jeremykenedy/laravel-auth.git laravel-auth`

2. Create a MySQL database for the project   
    * ```create database mahindra_test;```
        
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
5. Run `composer update` from the projects root folder
6. From the projects root folder run:
```
php artisan vendor:publish --tag=laravelroles &&
php artisan vendor:publish --tag=laravel2step
```
7. From the projects root folder run `php artisan key:generate`
8. From the projects root folder run `php artisan migrate`
9. From the projects root folder run `composer dump-autoload`
10. From the projects root folder run `php artisan db:seed`
11. Compile the front end assets with [npm steps](#using-npm) or [yarn steps](#using-yarn).

#### Build the Front End Assets with Mix
##### Using Yarn:
1. From the projects root folder run `yarn install`
2. From the projects root folder run `yarn run dev` or `yarn run production`
  * You can watch assets with `yarn run watch`

### Seeds
##### Seeded Roles
  * Unverified - Level 0
  * User  - Level 1
  * Administrator - Level 5

##### Seeded Permissions
  * view.users
  * create.users
  * edit.users
  * delete.users

##### Seeded Users

|Email|Password|Access|
|:------------|:------------|:------------|
|user@user.com|password|User Access|
|admin@admin.com|password|Admin Access|

