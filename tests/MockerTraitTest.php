<?php

use Jcloutz\Mocker\MockerTrait;

class MockerTraitTest extends PHPUnit_Framework_TestCase
{
    public function test_mocker_trait_instance_create()
    {
        $model = Model::mockInstance();
        $this->assertNull($model->id);
    }

    public function test_mocker_trait_saved_instance_create()
    {
        $model = Model::mockCreate();
        $this->assertEquals(1, $model->id);
    }

    public function test_mocker_trait_overrides()
    {
        $model = Model::mockInstance(array(
            'name' => 'name',
            'salary' => 1000,
        ));

        $this->assertEquals('name', $model->name);
        $this->assertEquals(1000, $model->salary);
    }
}

