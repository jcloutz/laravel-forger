<?php namespace Jcloutz\Mimic;

use Jcloutz\Mimic\Mimic;

trait MimicTrait
{
    /**
     * Creates a mocked up instance of the model and returns it.
     * @param  array  $overrides
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function mimic($overrides = array())
    {
        $mocker = new Mimic;
        $instance = $mocker->model(new self)
            ->override($overrides)
            ->get();
        return $instance;
    }

    /**
     * Creates and saves a instance of the model and returns it.
     * @param  array  $overrides
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function mimicCreate($overrides = array())
    {
        $mocker = new Mimic;
        $instance = $mocker->model(new self)
            ->override($overrides)
            ->get();
        $instance->save();
        return $instance;
    }
}
