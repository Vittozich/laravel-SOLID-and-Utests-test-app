My laravel app where I learn how to work with the init and functional tests in Laravel.
And use PHP SOLID in project.

All examples in code, the sequence of actions can be tracked by commits!

### `JUNE 2020`

### `learning difficulty level: 7 of 10`

Down below something like "learning documentation"

# Laravel installation and basic setting:

For database and server-hosting in localhost I use [OpenServer](https://ospanel.io/)

For installation I already used installed [composer](https://getcomposer.org/download/)
 and [PHP](https://www.php.net/manual/en/install.php) 
or use PHP from OpenServer


### If you want to clone this repository:

    git clone https://github.com/Vittozich/laravel-SOLID-and-Utests-test-app.git
    cd laravel-SOLID-and-Utests-test-app
    composer install
    cp .env.example .env
    php artisan key:generate  
<hr>


### laravel base settings:
 
In mySql I created empty DB `larareact` with `utf8mb4_unicode_ci`

In `.env`:    

        DB_DATABASE=laratest    

  Then: 

        composer require laravel/ui --dev
       
        php artisan ui react --auth

        npm install


<hr>

        php artisan vendor:publish
        
<br><hr>

#Tests

##Installation

    composer require --dev laravel/dusk
    php artisan dusk:install
    
A Browser directory will be created within your tests directory and will contain an example test.
Next, set the APP_URL environment variable in your .env file.
This value should match the URL you use to access your application in a browser.
    
    
For tests with browser 

    php artisan dusk
    
For test with unit and feature

    php artisan test
    
And if you used phpstorm you can just run it from code
    
<hr>

For self learning, I used [Laravel testing series](https://laracasts.com/series/phpunit-testing-in-laravel)

<hr><br>

## Test rules

- every methods should start with `test` prefix or comment above `/** @test */`
- every methods should be named - how they work inside (like a documentation)

##Usable methods for browser tests

| method  | description |  explanation |
| ------- |:-----------:| ------------:|
| visit | visit the site page | exact url |
| clickLink | click the link | Click to text in the link |
| assertPathIs | check route path | without site url (http://somesite.com/) |
| assertUrlIs | check full path | with site url |
| assertSee | check if see it on page | exactly text |

<hr><br>

#Usable methods for unit tests

| method  | description |  explanation |
| ------- |:-----------:| ------------:|
| assertEquals | check if two parameters are equals | === |


<hr><br>

#additional functions for tests

Like a __construct, but for tests: 

     public function setUp(): void


# P.S

## legend (notices)

When I write like `some....` or `someValue` it means it is a any variable.

I try to write describing/example code with `Readme` description/notes in same `commit` to comfortable learn on every issue about `Laravel` and `PHP`.

<hr>

Документ написан на английском, но с русским акцентом.

Написание этой `обучающей документации` на английском тоже является частью изучения фреймворка. 
