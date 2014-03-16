<?php namespace Jcloutz\Mocker;

use \Faker\Factory;

class Faker
{
    /**
     * @var string
     */
    private $function;

    /**
     * @var array
     */
    private $args = array();

    /**
     * Contructs the object
     * @param string $faker
     */
    public function __construct($faker)
    {
        if (strpos($faker, '|') === false) {
            $this->function = $faker;
        } else {
            $fakerProperties = explode('|', $faker);

            $this->function = $fakerProperties[0];
            array_shift($fakerProperties);
            $this->resolveArguments($fakerProperties);
        }
    }

    /**
     * Returns the generate faker data
     * @return mixed
     */
    public function getValue()
    {
        $faker = Factory::create();
        try {
            if (count($this->args) > 0) {
                $value = call_user_func_array([$faker, $this->function], $this->args);
            } else {
                $value = call_user_func([$faker, $this->function]);
            }
        } catch ( \InvalidArgumentException $e) {
            $value = $this->function;
        }

        return $value;
    }

    /**
     * Maps the arguments array and determins if they are numeric or string
     * @param  array $args
     * @return array
     */
    private function resolveArguments($args)
    {
        $this->args = array_map([$this, 'convertInt'], $args);
    }

    /**
     * Used by resolveArguments as an array_map function
     * @param  string $number
     * @return mixed
     */
    private function convertInt($number)
    {
        if (is_numeric($number)) {
            $value = intval($number);
        } else {
            $value = $number;
        }
        return $value;
    }
}
