# Twitter Clone

## Installation:

### 1.Initialize project

Clone (twitter-clone) repository to your machine.

```bash
$ git clone https://github.com/abdelrahman-waziry/twitter-clone.git
$ cd twitter-clone
```

Make sure that you have [Composer](https://getcomposer.org/download/) dependency manager installed on your machine.

```bash
$ composer install
```

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate
    
Run the database migrations (**Set the database connection in .env before migrating & make sure that your database server is running**)

    php artisan migrate
    
### 2.Install Socialite 

Add the package to your project's dependencies:

```bash
$ composer require laravel/socialite
```

Reference Oauth credentials to `config/services.php`

```
'twitter' => [
    'client_id' => env('TWITTER_KEY'),
    'client_secret' => env('TWITTER_SECRET'),
    'redirect' => env('TWITTER_REDIRECT_URI')
],

'facebook' => [
    'client_id' => env('FACEBOOK_KEY'),
    'client_secret' => env('FACEBOOK_SECRET'),
    'redirect' => env('FACEBOOK_REDIRECT_URI')
],

'google' => [
    'client_id' => env('google_KEY'),
    'client_secret' => env('google_SECRET'),
    'redirect' => env('GOOGLE_REDIRECT_URI')
],
```

Add Applications Oauth credentials to `config/services.php`

```
TWITTER_KEY=YOUR_TWITTER_KEY 
TWITTER_SECRET=YOUR_TWITTER_SECRET
TWITTER_REDIRECT_URI=http://localhost:8000/auth/twitter/callback

FACEBOOK_KEY=YOUR_FACEBOOK_KEY 
FACEBOOK_SECRET=YOUR_FACEBOOK_SECRET
FACEBOOK_REDIRECT_URI=http://localhost:8000/auth/facebook/callback

GOOGLE_KEY=YOUR_GOOGLE_KEY
GOOGLE_SECRET=GOOGLE_SECRET 
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```