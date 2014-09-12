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

//		$this->call('ConfigSeeder');
//        $this->call('UserTableSeeder');

//        DB::table('streets')->delete();
//        DB::table('settlements')->delete();
//        DB::table('municipalities')->delete();
//        DB::table('banks')->delete();


      //  DB::unprepared(file_get_contents(app_path().'\database\seeds\ResourcesSeed.sql'));
      //exec('mysql -u root -p finansii < '.file_get_contents(app_path().'\database\seeds\ResourceSeedAdvanced.sql'),$output,$worked);
      DB::statement(file_get_contents(app_path().'\database\seeds\ResourceSeedAdvanced.sql'));
	}

}
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array('email'=>'kliment.lambevski@gmail.com','username' => 'kliment.lambevski@gmail.com','password'=>Hash::make('test')));
//
    }

}

