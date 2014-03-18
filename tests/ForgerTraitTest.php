<?php

use Jcloutz\Forger\ForgerTrait;

class ForgerTraitTest extends PHPUnit_Framework_TestCase
{
    public function test_mocker_trait_instance_create()
    {
        $model = Model::forge();
        $this->assertNull($model->id);
    }

    public function test_mocker_trait_saved_instance_create()
    {
        $model = Model::forgeCreate();
        $this->assertEquals(1, $model->id);
    }

    public function test_mocker_trait_overrides()
    {
        $model = Model::forge(array(
            'name' => 'name',
            'salary' => 1000,
        ));

        $this->assertEquals('name', $model->name);
        $this->assertEquals(1000, $model->salary);
    }
}
