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

//        DB::table('streets')->delete();
//        DB::table('settlements')->delete();
//        DB::table('municipalities')->delete();
//        DB::table('banks')->delete();
//
//
//
//        DB::unprepared(file_get_contents(app_path().'\database\seeds\ResourcesSeed.sql'));
//        //exec('mysql -u root -p finansii < '.file_get_contents(app_path().'\database\seeds\ResourceSeedAdvanced.sql'),$output,$worked);
//        DB::unprepared(file_get_contents(app_path() . '\database\seeds\CompaniesSeed.sql'));
//        print 'Companies seeded';
//        DB::unprepared(file_get_contents(app_path() . '\database\seeds\AccountsSeed.sql'));
//        print 'Accounts seeded';
//        DB::unprepared(file_get_contents(app_path() . '\database\seeds\OrderSeed.sql'));
//        print 'Orders seeded';
//        DB::unprepared(file_get_contents(app_path() . '\database\seeds\LedgerSeed1.sql'));
//        print 'Ledger1 seeded';
//        DB::unprepared(file_get_contents(app_path() . '\database\seeds\LedgerSeed2.sql'));
//        print 'Ledger2 seeded';
//        DB::unprepared(file_get_contents(app_path() . '\database\seeds\LedgerSeed3.sql'));
//        print 'Ledger3 seeded';
//        DB::unprepared(file_get_contents(app_path() . '\database\seeds\LedgerSeed4.sql'));
//        print 'Ledger4 seeded';
//        DB::unprepared(file_get_contents(app_path() . '\database\seeds\LedgerSeed5.sql'));
//        print 'Ledger5 seeded';
//        DB::unprepared(file_get_contents(app_path() . '\database\seeds\LedgerSeed6.sql'));
//        print 'Ledger6 seeded';
//        DB::table('ledgers')->update(array('currency_code' => 1));
    }

}

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        $apiKey=UUID::v4();
        ApplicationModel::create(array('id'=>UUID::v4(),'company_name'=>'KL inc.','owner'=>1,'api_key'=>$apiKey));
        User::create(array('id'=>UUID::v4(),'email' => 'kliment.lambevski@gmail.com', 'username' => 'kliment.lambevski@gmail.com',
            'password' => Hash::make('test'),'application'=>$apiKey));
        $apiKey=UUID::v4();
        ApplicationModel::create(array('id'=>UUID::v4(),'company_name'=>'KL inc. no2','owner'=>1,'api_key'=>$apiKey));
        User::create(array('id'=>UUID::v4(),'email' => 'kliment@gmail.com', 'username' => 'kliment.lambevski@gmail.com',
            'password' => Hash::make('test'),'application'=>$apiKey));
    }

}

