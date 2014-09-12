<?php

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

		$this->call('ConfigSeeder');
        $this->call('UserTableSeeder');

        DB::table('streets')->delete();
        DB::table('settlements')->delete();
        DB::table('municipalities')->delete();
        DB::table('banks')->delete();



        DB::unprepared(file_get_contents(app_path().'\database\seeds\ResourcesSeed.sql'));
        //exec('mysql -u root -p finansii < '.file_get_contents(app_path().'\database\seeds\ResourceSeedAdvanced.sql'),$output,$worked);
        DB::unprepared(file_get_contents(app_path() . '\database\seeds\CompaniesSeed.sql'));
        echo 'Companies seeded\n';
        DB::unprepared(file_get_contents(app_path() . '\database\seeds\OrderSeed.sql'));
        echo 'Orders seeded\n';
        DB::unprepared(file_get_contents(app_path() . '\database\seeds\LedgerSeed1.sql'));
        echo 'Ledger1 seeded\n';
        DB::unprepared(file_get_contents(app_path() . '\database\seeds\LedgerSeed2.sql'));
        echo 'Ledger2 seeded\n';
        DB::unprepared(file_get_contents(app_path() . '\database\seeds\LedgerSeed3.sql'));
        echo 'Ledger3 seeded\n';
        DB::unprepared(file_get_contents(app_path() . '\database\seeds\LedgerSeed4.sql'));
        echo 'Ledger4 seeded\n';
        DB::unprepared(file_get_contents(app_path() . '\database\seeds\LedgerSeed5.sql'));
        echo 'Ledger5 seeded\n';
        DB::unprepared(file_get_contents(app_path() . '\database\seeds\LedgerSeed6.sql'));
        echo 'Ledger6 seeded\n';
    }

}

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();

        User::create(array('email' => 'kliment.lambevski@gmail.com', 'username' => 'kliment.lambevski@gmail.com', 'password' => Hash::make('test')));
//
    }

}

