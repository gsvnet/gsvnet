<?php

use Illuminate\Database\Seeder;

class YearGroupsSeeder extends Seeder {
	public function run() {
		DB::table('year_groups')->truncate();

		GSVnet\Users\YearGroup::create(array(
			"year" => 2013,
			"name" => "Xiudez"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 2012,
			"name" => "Llavontar"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 2011,
			"name" => "Marikstos"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 2010,
			"name" => "Frinchov"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 2009,
			"name" => "Fuaab Fnør"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 2008,
			"name" => "Chiethon"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 2007,
			"name" => "Syfaris"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 2006,
			"name" => "Tayros"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 2005,
			"name" => "Verix"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 2004,
			"name" => "Unestra"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 2003,
			"name" => "Capro"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 2002,
			"name" => "Pynthras"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 2001,
			"name" => "Frontijn"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 2000,
			"name" => "Kicentha"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1999,
			"name" => "Taquor"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1998,
			"name" => "Nox Yron"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1997,
			"name" => "Chaos"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1996,
			"name" => "Dicreos"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1995,
			"name" => "Xtrum"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1994,
			"name" => "Giegandt"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1993,
			"name" => "Banzo"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1992,
			"name" => "Momeno"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1991,
			"name" => "Erta"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1990,
			"name" => "Valium MCMXC"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1989,
			"name" => "Glasnos"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1988,
			"name" => "Twiet"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1987,
			"name" => '$nel'
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1986,
			"name" => "E3"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1985,
			"name" => "Grstklmnt"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1984,
			"name" => "Boqx"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1983,
			"name" => "Nalas Buabatos"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1982,
			"name" => "Stutetenu"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1981,
			"name" => "Achonee"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1980,
			"name" => "Naselvla"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1979,
			"name" => "L'accefyth"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1978,
			"name" => "Kondidi"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1977,
			"name" => "Sindutonsin"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1976,
			"name" => "Magicojestel"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1975,
			"name" => "Neptotallos"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1974,
			"name" => "Ceysevoy"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1973,
			"name" => "Carpe Noctum"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1972,
			"name" => "Pocopace"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1971,
			"name" => "Cavetaurum"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1970,
			"name" => "Nestilartas"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1969,
			"name" => "Farosjek"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1968,
			"name" => "Samvenu"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1967,
			"name" => "Ratatoscer"
		));

		GSVnet\Users\YearGroup::create(array(
			"year" => 1966,
			"name" => "Gnoton"
		));
	}
}