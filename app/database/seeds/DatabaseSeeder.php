<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('ClientsTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('JobsTableSeeder');
		$this->call('ContractorsTableSeeder');
		$this->call('JobtypesTableSeeder');
		$this->call('TaskcategoiesTableSeeder');
		$this->call('TaskcategoriesTableSeeder');
		$this->call('TasksTableSeeder');
		$this->call('UnitsTableSeeder');
		$this->call('ProjectsTableSeeder');
		$this->call('Contract_jobtype_taskcategories_defaultsTableSeeder');
		$this->call('ContractjobtypetaskcategoriesdefaultsTableSeeder');
		$this->call('ContractjobtypetaskcategoriesactualsTableSeeder');
		$this->call('EstimatesTableSeeder');
		$this->call('InvoicesTableSeeder');
		$this->call('ResourcesTableSeeder');
		$this->call('NotesTableSeeder');
		$this->call('StatesTableSeeder');
		$this->call('ProjecttypesTableSeeder');
	}

}
