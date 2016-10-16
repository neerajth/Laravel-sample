<?php

use Mockery as m;
use Way\Tests\Factory;

class ContractJobtypeTaskcategoriesDefaultsTest extends TestCase {

	public function __construct()
	{
		$this->mock = m::mock('Eloquent', 'Contract_jobtype_taskcategories_default');
		$this->collection = m::mock('Illuminate\Database\Eloquent\Collection')->shouldDeferMissing();
	}

	public function setUp()
	{
		parent::setUp();

		$this->attributes = Factory::contract_jobtype_taskcategories_default(['id' => 1]);
		$this->app->instance('Contract_jobtype_taskcategories_default', $this->mock);
	}

	public function tearDown()
	{
		m::close();
	}

	public function testIndex()
	{
		$this->mock->shouldReceive('all')->once()->andReturn($this->collection);
		$this->call('GET', 'contract_jobtype_taskcategories_defaults');

		$this->assertViewHas('contract_jobtype_taskcategories_defaults');
	}

	public function testCreate()
	{
		$this->call('GET', 'contract_jobtype_taskcategories_defaults/create');

		$this->assertResponseOk();
	}

	public function testStore()
	{
		$this->mock->shouldReceive('create')->once();
		$this->validate(true);
		$this->call('POST', 'contract_jobtype_taskcategories_defaults');

		$this->assertRedirectedToRoute('contract_jobtype_taskcategories_defaults.index');
	}

	public function testStoreFails()
	{
		$this->mock->shouldReceive('create')->once();
		$this->validate(false);
		$this->call('POST', 'contract_jobtype_taskcategories_defaults');

		$this->assertRedirectedToRoute('contract_jobtype_taskcategories_defaults.create');
		$this->assertSessionHasErrors();
		$this->assertSessionHas('message');
	}

	public function testShow()
	{
		$this->mock->shouldReceive('findOrFail')
				   ->with(1)
				   ->once()
				   ->andReturn($this->attributes);

		$this->call('GET', 'contract_jobtype_taskcategories_defaults/1');

		$this->assertViewHas('contract_jobtype_taskcategories_default');
	}

	public function testEdit()
	{
		$this->collection->id = 1;
		$this->mock->shouldReceive('find')
				   ->with(1)
				   ->once()
				   ->andReturn($this->collection);

		$this->call('GET', 'contract_jobtype_taskcategories_defaults/1/edit');

		$this->assertViewHas('contract_jobtype_taskcategories_default');
	}

	public function testUpdate()
	{
		$this->mock->shouldReceive('find')
				   ->with(1)
				   ->andReturn(m::mock(['update' => true]));

		$this->validate(true);
		$this->call('PATCH', 'contract_jobtype_taskcategories_defaults/1');

		$this->assertRedirectedTo('contract_jobtype_taskcategories_defaults/1');
	}

	public function testUpdateFails()
	{
		$this->mock->shouldReceive('find')->with(1)->andReturn(m::mock(['update' => true]));
		$this->validate(false);
		$this->call('PATCH', 'contract_jobtype_taskcategories_defaults/1');

		$this->assertRedirectedTo('contract_jobtype_taskcategories_defaults/1/edit');
		$this->assertSessionHasErrors();
		$this->assertSessionHas('message');
	}

	public function testDestroy()
	{
		$this->mock->shouldReceive('find')->with(1)->andReturn(m::mock(['delete' => true]));

		$this->call('DELETE', 'contract_jobtype_taskcategories_defaults/1');
	}

	protected function validate($bool)
	{
		Validator::shouldReceive('make')
				->once()
				->andReturn(m::mock(['passes' => $bool]));
	}
}
