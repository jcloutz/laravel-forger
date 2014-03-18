<?php

use Jcloutz\Mimic\Mimic;
use Jcloutz\Mimic\MimicTrait;

class MockerTest extends PHPUnit_Framework_TestCase
{
    private $mimic;

    public function setUp()
    {
        parent::setUp();
        $this->mimic = new Mimic;
    }

    public function test_faker_call_without_args()
    {
        $model = new Model;
        $this->mimic->model($model);
        $this->assertTrue(is_string($this->mimic->execute('sentence')));
    }

    public function test_faker_call_with_args()
    {
        $model = new Model;
        $this->mimic->model($model);
        $data = $this->mimic->execute('randomFloat|2|10|20');
        $this->assertTrue(is_numeric($data));
        $this->assertTrue($data > 10);
        $this->assertTrue($data < 20);
    }

    public function test_user_function_call_without_faker_args()
    {
        $model = new Model;
        $this->mimic->model($model);
        $data = $this->mimic->execute('call|makeName');
        $this->assertEquals('Mocker', $data);
    }

    public function test_user_function_call_with_faker_func()
    {
        $model = new Model;
        $this->mimic->model($model);
        $data = $this->mimic->execute('call|salary|randomNumber');
        $this->assertEquals(50000.00, $data);
    }

    public function test_user_function_call_with_faker_func_with_args()
    {
        $model = new Model;
        $this->mimic->model($model);
        $data = $this->mimic->execute('call|cube|randomNumber|2|2');
        $this->assertEquals(8, $data);
    }

    public function test_static_data_argument()
    {
        $model = new Model;
        $this->mimic->model($model);
        $data = $this->mimic->execute('static|Mocker');
        $this->assertEquals('Mocker', $data);
    }

    public function test_get_function()
    {
        $model = new Model;
        $this->mimic->model($model);
        $mockedObject = $this->mimic->get();
        $this->assertEquals('Mocker', $mockedObject->name);
        $this->assertEquals(50000.00, $mockedObject->salary);
    }

    public function test_attribute_overrides()
    {
        $mimic = new Mimic;
        $model = new Model;
        $mimic->model($model)->override(array(
            'name' => 'New Name',
            'salary' => 30000.00,
        ));
        $mockedObject = $mimic->get();

        $this->assertEquals('New Name', $mockedObject->name);
        $this->assertEquals(30000.00, $mockedObject->salary);
    }
}

class Model
{
    use MimicTrait;

    public $id;

    public static $mockable = array(
        'name' => 'static|Mocker',
        'salary' => 'call|salary|randomNumber',
    );

    public function salary($data)
    {
        return 50000.00;
    }

    public function cube($data)
    {
        return $data * $data * $data;
    }

    public function makeName()
    {
        return 'Mocker';
    }

    public function save()
    {
        $this->id = 1;
        return true;
    }
}
