# Fast Model Mockups in Laravel

[![Build Status](https://travis-ci.org/jcloutz/laravel-mocker.png?branch=master)](https://travis-ci.org/jcloutz/laravel-mocker)

This package is intended to allow for the fast creation of database objects in Laravel.

## Installation


## Usage

Forger adds the ability to quickly retrieve a populated mockup of any model in your project. The [Faker Package](https://github.com/fzaninotto/Faker) to generate mockup data based on an array of values.


```php
<?php // namespace Models;

use Jcloutz\Mocker\MockerTrait;

class Widget extends Eloquent
{
    use ForgerTrait;

    protected $table = 'widgets';

    protected $fillable = [];

    public static $mockable = array(
        'name'  => 'A Fancy Widget', // Static data
        'cost'  => 'randomFloat|2|0|100', // Faker method with arguments
        'price' => 'call|uppercase|word', // Call to user function with data from faker
    );

    public function uppercase($string)
    {
        return strtoupper($string);
    }
}

```

The ForgerTrait provides two static functions to models `::forge()` and `::forgeCreate()`.


```php
    // Returns an instance of Widget without saving it to the database.
    $widget = Widget::forge();

    // Returns an instance of Widget and saves it to the database.
    $widget = Widget::forgeCreate();
```

## License

[WTFPL](http://www.wtfpl.net/)