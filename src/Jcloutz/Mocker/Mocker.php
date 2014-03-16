<?php namespace Jcloutz\Mocker;

use Jcloutz\Mocker\Faker;

class Mocker
{
    /**
     * @var array
     */
    private $fields = array();

    /**
     * @param array $fields
     */
    public function __construct($fields)
    {
        $this->buildFieldData($fields);
    }

    /**
     * Builds an array of data for model fields.
     * @param  array $attributes
     */
    public function buildFieldData($attributes)
    {
        foreach ($attributes as $key => $faker) {
            $data = new Faker($faker);
            $this->fields[$key] =$data->getValue();
        }
    }

    /**
     * Returns field data generated by Faker
     * @return array
     */
    public function getFieldData()
    {
        return $this->fields;
    }
}