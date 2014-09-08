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

		$this->call('ConfigSeeder');

//        DB::table('streets')->delete();
//        DB::table('settlements')->delete();
//        DB::table('municipalities')->delete();
//        DB::table('banks')->delete();
//
//
//        DB::unprepared(file_get_contents(app_path().'\database\seeds\ResourcesSeed.sql'));
	}

}
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array('email'=>'foo@bar.com','username' => 'foo@bar.com','password'=>Hash::make('test')));
//        $faker=Faker\Factory::create();
//        for($i=0;$i<5;$i++)
//            FormConfig::create(array(
//                'name'=>$faker->firstName,
//                'edit'=>1,
//                'add'=>1,
//
//            ));
//        for($i=0;$i<10;$i++){
//            Field::create(array(
//                'name'=>$faker->firstName,
//                'visible'=>1,
//                'edit'=>1,
//                'required'=>1
//            ));
//        }
        for($i=1;$i<5;$i++){
            $field=Field::find($i);
            $field->forms()->attach(2*$i);
            $field->forms()->attach(2*$i+1);
        }
    }

}

