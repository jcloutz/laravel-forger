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
        $mocker = new Mocker;
        $instance = $mocker->mock(new self)
            ->override($overrides)
            ->get();
        return $instance;
    }

    /**
     * Creates and saves a instance of the model and returns it.
     * @param  array  $overrides
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function mockCreate($overrides = array())
    {
        $mocker = new Mocker;
        $instance = $mocker->mock(new self)
            ->override($overrides)
            ->get();
        $instance->save();
        return $instance;
    }
}
