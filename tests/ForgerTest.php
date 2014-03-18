<?php

use Jcloutz\Forger\Forger;
use Jcloutz\Forger\ForgerTrait;

class ForgerTest extends PHPUnit_Framework_TestCase
{
    private $forger;

    public function setUp()
    {
        parent::setUp();
        $this->forger = new Forger;
    }

    public function test_faker_call_without_args()
    {
        $model = new Model;
        $this->forger->forge($model);
        $this->assertTrue(is_string($this->forger->execute('sentence')));
    }

    public function test_faker_call_with_args()
    {
        $model = new Model;
        $this->forger->forge($model);
        $data = $this->forger->execute('randomFloat|2|10|20');
        $this->assertTrue(is_numeric($data));
        $this->assertTrue($data > 10);
        $this->assertTrue($data < 20);
    }

    public function test_user_function_call_with_faker_func()
    {
        $model = new Model;
        $this->forger->forge($model);
        $data = $this->forger->execute('call|userFunc');
        $this->assertEquals(100, $data);
    }

    public function test_user_function_call_with_faker_func_with_args()
    {
        $model = new Model;
        $this->forger->forge($model);
        $data = $this->forger->execute('call|cube|randomNumber|2|2');
        $this->assertEquals(8, $data);
    }

    public function test_user_function_with_static_data()
    {
        $model = new Model;
        $this->forger->forge($model);
        $data = $this->forger->execute('call|uppercase|forger');
        $this->assertEquals('FORGER', $data);
    }

    public function test_static_data_argument()
    {
        $model = new Model;
        $this->forger->forge($model);
        $data = $this->forger->execute('Forger');
        $this->assertEquals('Forger', $data);
    }

    public function test_get_function()
    {
        $model = new Model;
        $this->forger->forge($model);
        $forgedObject = $this->forger->get();
        $this->assertEquals('Forger', $forgedObject->name);
        $this->assertEquals(100, $forgedObject->salary);
    }

    public function test_attribute_overrides()
    {
        $forger = new Forger;
        $model = new Model;
        $forger->forge($model)->override(array(
            'name' => 'Model Forger',
            'salary' => 300,
        ));
        $forgedObject = $forger->get();

        $this->assertEquals('Model Forger', $forgedObject->name);
        $this->assertEquals(300, $forgedObject->salary);
    }
}

class Model
{
    use ForgerTrait;

    public $id;

    public $forger = array(
        'name' => 'Forger',
        'address' => 'streetAddress',
        'salary' => 'call|userFunc',
    );

    public function userFunc()
    {
        return 100;
    }

    public function uppercase($data)
    {
        return strtoupper($data);
    }

    public function cube($data)
    {
        return $data * $data * $data;
    }

    public function save()
    {
        $this->id = 1;
        return true;
    }
}
