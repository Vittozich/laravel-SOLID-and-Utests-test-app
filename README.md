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

Do not forget create the table in database named as `laratest`

### If you want to clone this repository:

    git clone https://github.com/Vittozich/laravel-SOLID-and-Utests-test-app.git
    cd laravel-SOLID-and-Utests-test-app
    composer install
    cp .env.example .env
    php artisan key:generate  
<hr>


### laravel base settings:
 
In mySql I created empty DB `larareact` and `laratest_testing` with `utf8mb4_unicode_ci`

In `.env`:    

        DB_DATABASE=laratest    
        DB_DATABASE_TESTING=laratest_testing

  Then (now it's not needed): 

        composer require laravel/ui --dev
       
        php artisan ui react --auth

        npm install


<hr>

        php artisan vendor:publish
        
<hr>

### Polymorphic Relationships:

- template: instead of `post_id` use `likeable_id` and `likeable_type`, where `likeable_type` taken from `get_class($post)` function, where `$post` is instanceof `Post::class`   
- use `get_class()` to get second argument (class name with namespace) of polymorphic relationship (we know the first argument is `id` of class)

#Tests

##vInstallation

    composer require --dev laravel/dusk
    php artisan dusk:install
    
A Browser directory will be created within your tests directory and will contain an example test.
Next, set the APP_URL environment variable in your .env file.
This value should match the URL you use to access your application in a browser.
    
    
For tests with browser 

    php artisan dusk
    
For test with unit and feature

    php artisan test
    
If you used phpstorm you can just run it from code
    
<hr>

For self learning, I used [Laravel testing series](https://laracasts.com/series/phpunit-testing-in-laravel)

<hr><br>

## Test rules

- every methods should start with `test` prefix or comment above `/** @test */`
- every methods should be named - how they work inside (like a documentation)
- integration test structure is - Given, When, Then
- if you test models you need use `factories`
- if you need (but you really need) clear (refresh) database after each test need to `use RefreshDatabase;` 
in test class with use requirement above class `use Illuminate\Foundation\Testing\RefreshDatabase;`
- check logic of the methods and create regression test to testing mistakes and errors.
- you can get out method and protected attributes to parent and make code cleaner.

<hr><br>

## Mistakes and disgusting in laravel tests

- if you need `assertEquals` new ID with database ID you need to use `RefreshDatabase` or `DatabaseTransactions`
but both methods doesn't work with production database and with new tests in old database, which is filled up information,
because `RefreshDatabase` refresh all table, and `DatabaseTransactions` refresh transaction/query, but not refresh <strong>AUTO_INCREMENT!!!!!!</strong>
and so on need to use copy of database only with empty data!!!


<hr><br>

## Usable methods for browser tests

| method  | description |  explanation or example |
| ------- |:-----------:| -----------------------:|
| visit | visit the site page | exact url |
| clickLink | click the link | Click to text in the link |
| assertPathIs | check route path | without site url (http://somesite.com/) |
| assertUrlIs | check full path | with site url |
| assertSee | check if see it on page | exactly text |

<hr><br>

## Usable methods for unit tests (and all tests in particular)

| method  | description |  explanation or example |
| ------- |:-----------:| -----------------------:|
| assertEquals | check if two parameters are equals | === |
| assertCount | check if count(second parameter) are equal to first parameter | 2 === 2 instead 2 === count([1,2])|

<hr><br>

## Usable methods for integration and model tests (and all tests in particular)

| method  | description |  explanation or example |
| ------- |:-----------:| -----------------------:|
| expectException | check method throw new Exception  | ethod should called before the line in the test where this exception should appear |
| expectExceptionMessage | check if method throw new Exception with exact message | method should called before the line in the test where this exception should appear|
| assertDatabaseHas(table_name, array_data) | what should to see in database  | old method is seeInDatabase |
| assertDatabaseMissing(table_name, array_data) | what should not to see in database  | old method is notSeeInDatabase |
| assertTrue | variable inside should be true  | === true |
| assertFalse| variable inside should be false  | === false |


<hr><br>

## Factories methods for integration and model tests

| method ($faker->*) | description |  explanation or example |
| ------------------ |:-----------:| -----------------------:|
| sentence | random short sentence | Nostrum consequatur molestiae aliquid quae eos sit. |
| paragraph | random long sentence as paragraph| can be bigger than 255 symbols (this is a text, but not a string) |


<hr><br>

## additional functions for tests

Like a __construct, but for tests: 

     public function setUp(): void

and inside this method should be call the parent same method:

      parent::setUp();      

<hr>

## phpunit settings in `phpunit.xml`

Delete string  `<server name="DB_DATABASE" value=":memory:"/>` 

and configurate `DB_CONNECTION` as `mysql_testing` (or `mysql` if you want to test on production database)

<hr>

## additional settings or features for make tests cleaner

- you can create global php function as helper for tests in some file. But you need to include this file in
`composer.json` in `autoload-dev` in `files` array, then you have to `composer dumputoload` command to connect this file to laravel.

<hr>

# Fast commands

## create models

Console method create a model in the folder

    php artisan make:model Models/Article -m
    
Migrate:
    
    php artisan migrate

or with steps (1 step = 1 migration):

    php artisan migrate --step
    
Migrate for testing database (copy of real database first time):
    
        php artisan migrate --database=mysql_testing --step
        
! NOTE - after create `mysql_testing` every command ` php artisan migrate ` migration occur in both tables.
(but that doesn't work correctly sometimes)
    
# How to use `tinker`

To start command line:
    
    php artisan tinker
    
To do an action (clear the table) at model and database (example Article model):

    App\Models\Article::truncate();

# P.S

## Notes for myself:

- don't forget `return` in models methods, which are used inside the model or in test/controllers 
- `scopeSomeName` - it is static/normal method, which can call as a static `::` if it is a first calling method,
 then called with `->` and it's name would be `SomeName`
- getSomeNameAttribute - it is custom attribute, which would called like that `$this->someName`  or `$this->some_name`
(without `()` at the end, because it is not a method) (second option is more correct)


ctrl+alt+n - fast navigation

## legend (notices)

When I write like `some....` or `someValue` it means it is a any variable.

I try to write describing/example code with `Readme` description/notes in same `commit` to comfortable learn on every issue about `Laravel` and `PHP`.

<hr>

Документ написан на английском, но с русским акцентом.

Написание этой `обучающей документации` на английском тоже является частью изучения фреймворка. 
