<?php

class BetaTestersTableSeeder extends Seeder {

	public function run()
	{
		$reebocie = GSVnet\Committees\Committee::where('unique_name', '=', 'reebocie')->first();
		$prescie = GSVnet\Committees\Committee::where('unique_name', '=', 'prescie')->first();
		$fromto = array(
			'start_date' => '2014-01-01',
			'end_date' => '2015-01-01'
		);

		// jorieke
		$jaarverband = GSVnet\Users\YearGroup::where('year', '=', 2011)->first();

        $jorieke = GSVnet\Users\User::create(array(
            'email'         => 'joriekelindner@hotmail.fr',
            'password'      => 'jorieke',
            'firstname'     => 'Jorieke',
            'lastname'      => 'Lindner',
            'middlename'    => '',
            'username'      => 'joriekee',
            'type'          => 2,
            'approved'      => true
        ));

        GSVnet\Users\Profiles\UserProfile::create(array(
            'user_id' => $jorieke->id,
            'year_group_id' => $jaarverband->id,
            'region' => 1,
            'phone' => '050-4040544',
            'address' => 'Mooistraat 2',
            'zip_code' => '9712AX',
            'town' => 'Groningen',
            'study' => 'Technische Wiskunde',
            'birthdate' => '1992-10-10',
            'church' => 'GKV',
            'gender' => 'male',
            'start_date_rug' => '2011-08-01',
            'reunist' => 0,
            'parent_address' => 'Mooiestraat 3',
            'parent_zip_code' => '9556EX',
            'parent_town' => 'Opende',
            'parent_phone' => '0800-223344'
        ));

		// jacob
		$jaarverband = GSVnet\Users\YearGroup::where('year', '=', 2012)->first();

        $jacob = GSVnet\Users\User::create(array(
            'email'         => 'jacobvenema@hotmail.com',
            'password'      => 'jacob',
            'firstname'     => 'Jacob',
            'lastname'      => 'Venema',
            'middlename'    => '',
            'username'      => 'jaapie.vecht',
            'type'          => 2,
            'approved'      => true
        ));

        $jacob->committees()->attach($prescie, $fromto);

        GSVnet\Users\Profiles\UserProfile::create(array(
            'user_id' => $jacob->id,
            'year_group_id' => $jaarverband->id,
            'region' => 4,
            'phone' => '050-4040544',
            'address' => 'Mooistraat 2',
            'zip_code' => '9712AX',
            'town' => 'Groningen',
            'study' => 'Technische Wiskunde',
            'birthdate' => '1992-10-10',
            'church' => 'GKV',
            'gender' => 'male',
            'start_date_rug' => '2011-08-01',
            'reunist' => 0,
            'parent_address' => 'Mooiestraat 3',
            'parent_zip_code' => '9556EX',
            'parent_town' => 'Opende',
            'parent_phone' => '0800-223344'
        ));

		// jasper
		$jaarverband = GSVnet\Users\YearGroup::where('year', '=', 2010)->first();

        $jasper = GSVnet\Users\User::create(array(
            'email'         => 'jaspermann@gmail.com',
            'password'      => 'jasper',
            'firstname'     => 'Jasper',
            'lastname'      => 'Möhlmann',
            'middlename'    => '',
            'username'      => 'jasperman',
            'type'          => 2,
            'approved'      => true
        ));

        GSVnet\Users\Profiles\UserProfile::create(array(
            'user_id' => $jasper->id,
            'year_group_id' => $jaarverband->id,
            'region' => 4,
            'phone' => '050-4040544',
            'address' => 'Mooistraat 2',
            'zip_code' => '9712AX',
            'town' => 'Groningen',
            'study' => 'Technische Wiskunde',
            'birthdate' => '1992-10-10',
            'church' => 'GKV',
            'gender' => 'male',
            'start_date_rug' => '2011-08-01',
            'reunist' => 0,
            'parent_address' => 'Mooiestraat 3',
            'parent_zip_code' => '9556EX',
            'parent_town' => 'Opende',
            'parent_phone' => '0800-223344'
        ));

		// maurice
		$jaarverband = GSVnet\Users\YearGroup::where('year', '=', 2011)->first();

        $maurice = GSVnet\Users\User::create(array(
            'email'         => 'mausblanco@hotmail.com',
            'password'      => 'maurice',
            'firstname'     => 'Maurice',
            'lastname'      => 'Vos',
            'middlename'    => 'de',
            'username'      => 'maurice',
            'type'          => 2,
            'approved'      => true
        ));

        GSVnet\Users\Profiles\UserProfile::create(array(
            'user_id' => $maurice->id,
            'year_group_id' => $jaarverband->id,
            'region' => 2,
            'phone' => '050-4040544',
            'address' => 'Mooistraat 2',
            'zip_code' => '9712AX',
            'town' => 'Groningen',
            'study' => 'Technische Wiskunde',
            'birthdate' => '1992-10-10',
            'church' => 'GKV',
            'gender' => 'male',
            'start_date_rug' => '2011-08-01',
            'reunist' => 0,
            'parent_address' => 'Mooiestraat 3',
            'parent_zip_code' => '9556EX',
            'parent_town' => 'Opende',
            'parent_phone' => '0800-223344'
        ));

		// basm
		$jaarverband = GSVnet\Users\YearGroup::where('year', '=', 2012)->first();

        $basm = GSVnet\Users\User::create(array(
            'email'         => 'mausblanco@hotmail.com',
            'password'      => 'bas',
            'firstname'     => 'Bas',
            'lastname'      => 'Meijndert',
            'middlename'    => 'van',
            'username'      => 'bash',
            'type'          => 2,
            'approved'      => true
        ));

        $basm->committees()->attach($reebocie, $fromto);

        GSVnet\Users\Profiles\UserProfile::create(array(
            'user_id' => $basm->id,
            'year_group_id' => $jaarverband->id,
            'region' => 3,
            'phone' => '050-4040544',
            'address' => 'Mooistraat 2',
            'zip_code' => '9712AX',
            'town' => 'Groningen',
            'study' => 'Technische Wiskunde',
            'birthdate' => '1992-10-10',
            'church' => 'GKV',
            'gender' => 'male',
            'start_date_rug' => '2011-08-01',
            'reunist' => 0,
            'parent_address' => 'Mooiestraat 3',
            'parent_zip_code' => '9556EX',
            'parent_town' => 'Opende',
            'parent_phone' => '0800-223344'
        ));

		// laura
		$jaarverband = GSVnet\Users\YearGroup::where('year', '=', 2010)->first();

        $laura = GSVnet\Users\User::create(array(
            'email'         => 'llaurabrands@gmail.com',
            'password'      => 'laura',
            'firstname'     => 'Laura',
            'lastname'      => 'Brands',
            'middlename'    => '',
            'username'      => 'smeerkees',
            'type'          => 2,
            'approved'      => true
        ));

        GSVnet\Users\Profiles\UserProfile::create(array(
            'user_id' => $laura->id,
            'year_group_id' => $jaarverband->id,
            'region' => 3,
            'phone' => '050-4040544',
            'address' => 'Mooistraat 2',
            'zip_code' => '9712AX',
            'town' => 'Groningen',
            'study' => 'Technische Wiskunde',
            'birthdate' => '1992-10-10',
            'church' => 'GKV',
            'gender' => 'male',
            'start_date_rug' => '2011-08-01',
            'reunist' => 0,
            'parent_address' => 'Mooiestraat 3',
            'parent_zip_code' => '9556EX',
            'parent_town' => 'Opende',
            'parent_phone' => '0800-223344'
        ));

		// robertt
		$jaarverband = GSVnet\Users\YearGroup::where('year', '=', 2009)->first();

        $robertt = GSVnet\Users\User::create(array(
            'email'         => 'tempelman.robert@gmail.com',
            'password'      => 'robert',
            'firstname'     => 'Robert',
            'lastname'      => 'Tempelman',
            'middlename'    => '',
            'username'      => 'robert',
            'type'          => 2,
            'approved'      => true
        ));

        GSVnet\Users\Profiles\UserProfile::create(array(
            'user_id' => $robertt->id,
            'year_group_id' => $jaarverband->id,
            'region' => 3,
            'phone' => '050-4040544',
            'address' => 'Mooistraat 2',
            'zip_code' => '9712AX',
            'town' => 'Groningen',
            'study' => 'Technische Wiskunde',
            'birthdate' => '1992-10-10',
            'church' => 'GKV',
            'gender' => 'male',
            'start_date_rug' => '2011-08-01',
            'reunist' => 0,
            'parent_address' => 'Mooiestraat 3',
            'parent_zip_code' => '9556EX',
            'parent_town' => 'Opende',
            'parent_phone' => '0800-223344'
        ));
	}

}