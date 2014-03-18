<?php namespace Jcloutz\Forger;

use Jcloutz\Forger\Forger;

trait ForgerTrait
{
    /**
     * Creates a forged instance of the model and returns it.
     * @param  array  $overrides
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function forge($overrides = array())
    {
        $forger = new Forger;
        $instance = $forger->forge(new self)
            ->override($overrides)
            ->get();
        return $instance;
    }

    /**
     * Creates and saves a forged instance of the model and returns it.
     * @param  array  $overrides
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function forgeCreate($overrides = array())
    {
        $forger = new Forger;
        $instance = $forger->forge(new self)
            ->override($overrides)
            ->get();
        $instance->save();
        return $instance;
    }
}
