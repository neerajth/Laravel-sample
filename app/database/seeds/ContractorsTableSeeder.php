<?php

class ContractorsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('contractors')->truncate();

		$contractorJson = File::get(storage_path() . "/jsondata/contractors.json");
		$cdata = json_decode($contractorJson);
		foreach ($cdata as $object) {
				$contractors []=
					array(
						'id' => $object->id,
						'firstname' => $object->firstname ,
						'lastname' => $object->lastname ,
						'businessname' => $object->businessname ,
						'email' => $object->email ,
						'password' => $object->password ,
						'phone' => $object->phone ,
						'fax' => $object->fax ,
						'street1' => $object->street1 ,
						'street2' => $object->street2 ,
						'city' => $object->city ,
						'state' => $object->state ,
						'zip' => $object->zip ,
						'usertype' => $object->usertype ,
						'created_at' => $object->created_at ,
						'updated_at' => $object->updated_at ,
					);
		}

		// Uncomment the below to run the seeder
		 DB::table('contractors')->insert($contractors);
	}

}
