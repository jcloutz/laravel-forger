<?php namespace Jcloutz\Mocker;

use Jcloutz\Mocker\Mocker;

trait MockerTrait
{
    /**
     * Creates a mocked up instance of the model and returns it.
     * @param  array  $overrides
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function mockInstance($overrides = array())
    {
        return self::getMocker($overrides);
    }

    /**
     * Creates and saves a instance of the model and returns it.
     * @param  array  $overrides
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function mockCreate($overrides = array())
    {
        $instance = self::getMocker($overrides);
        $instance->save();
        return $instance;
    }

    /**
     * Generates a mocker instance to create the mockup data for the
     * model.
     * @param  array $overrides
     * @return \Illumnate\Database\Eloquent\Model
     */
    private static function getMocker($overrides = array())
    {
        $mock = new Mocker(self::$mockable);

        $instance = new self;

        self::unguard();

        $data = array_merge($mock->getFieldData(), $overrides);
        $instance->fill($data);

        self::reGuard();

        return $instance;
    }
}
