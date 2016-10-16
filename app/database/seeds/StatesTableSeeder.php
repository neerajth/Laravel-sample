<?php

class StatesTableSeeder extends Seeder {

	public function run()
	{
	
		// Uncomment the below to wipe the table clean before populating
		DB::table('states')->truncate();

		$statesJson = File::get(storage_path() . "/jsondata/states.json");
		$statesdata = json_decode($statesJson);
		foreach ($statesdata as $object) {
				$statesarray []=
					array(
						'id' => $object->id,
						'statename' => $object->statename ,
						'state_abb' => $object->state_abb ,
						'created_at' => $object->created ,
						'updated_at' => $object->modified ,
					);
		}

		// Uncomment the below to run the seeder
		DB::table('states')->insert($statesarray);
	}

}