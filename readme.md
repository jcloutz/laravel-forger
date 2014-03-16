# Fast Model Mockups in Laravel

This package is intended to allow for the fast creation of database object in Laravel.

## Installation


## Usage

Mocker adds the ability to quickly retrieve a populated mockup of any model in your project. The [Faker Package](https://github.com/fzaninotto/Faker) to generate mockup data based on an array of values.

```php
<?php // namespace Models;

use Jcloutz\Mocker\MockerTrait;

class Widget extends Eloquent
{
    use MockerTrait;

    protected $table = 'widgets';

    protected $fillable = [];

    public static $mockable = array(
        'name' => 'word',
        'cost' => 'randomFloat|2|0|100',
    );
}

```

The MockerTrait provides two static functions `::MockCreate()` and `::mockInstance()`.

```php
    // Returns an instance of Widget without saving it to the database.
    $widget = Widget::mockInstance();

    // Returns an instance of Widget and saves it to the database.
    $widget = Widget::mockCreate();
```

