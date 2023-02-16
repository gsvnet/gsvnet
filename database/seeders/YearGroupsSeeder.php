<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearGroupsSeeder extends Seeder
{
    public function run()
    {
        $time = Carbon::now();

        $yearGroups = [
            [
                'year' => 2017,
                'name' => 'Qamonris',
                'created_at' => $time,
                'updated_at' => $time,
            ], [
                'year' => 2016,
                'name' => 'Kibovelta',
                'created_at' => $time,
                'updated_at' => $time,
            ], [
                'year' => 2015,
                'name' => 'Doxantilon',
                'created_at' => $time,
                'updated_at' => $time,
            ], [
                'year' => 2014,
                'name' => 'Euzaño',
                'created_at' => $time,
                'updated_at' => $time,
            ], [
                'year' => 2013,
                'name' => 'Xiudez',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 2012,
                'name' => 'Llavontar',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 2011,
                'name' => 'Marikstos',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 2010,
                'name' => 'Frinchov',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 2009,
                'name' => 'Fuaab Fnør',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 2008,
                'name' => 'Chiethon',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 2007,
                'name' => 'Syfaris',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 2006,
                'name' => 'Tayros',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 2005,
                'name' => 'Verix',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 2004,
                'name' => 'Unestra',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 2003,
                'name' => 'Capro',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 2002,
                'name' => 'Pynthras',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 2001,
                'name' => 'Frontijn',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 2000,
                'name' => 'Kicentha',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1999,
                'name' => 'Taquor',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1998,
                'name' => 'Nox Yron',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1997,
                'name' => 'Chaos',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1996,
                'name' => 'Dicreos',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1995,
                'name' => 'Xtrum',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1994,
                'name' => 'Giegandt',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1993,
                'name' => 'Banzo',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1992,
                'name' => 'Momeno',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1991,
                'name' => 'Erta',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1990,
                'name' => 'Valium MCMXC',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1989,
                'name' => 'Glasnos',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1988,
                'name' => 'Twiet',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1987,
                'name' => '$nel',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1986,
                'name' => 'E3',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1985,
                'name' => 'Grstklmnt',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1984,
                'name' => 'Boqx',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1983,
                'name' => 'Nalas Buabatos',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1982,
                'name' => 'Stutetenu',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1981,
                'name' => 'Achonee',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1980,
                'name' => 'Naselvla',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1979,
                'name' => 'L\'accefyth',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1978,
                'name' => 'Kondidi',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1977,
                'name' => 'Sindutonsin',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1976,
                'name' => 'Magicojestel',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1975,
                'name' => 'Neptotallos',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1974,
                'name' => 'Ceysevoy',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1973,
                'name' => 'Carpe Noctum',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1972,
                'name' => 'Pocopace',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1971,
                'name' => 'Cavetaurum',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1970,
                'name' => 'Nestilartas',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1969,
                'name' => 'Farosjek',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1968,
                'name' => 'Samvenu',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1967,
                'name' => 'Ratatoscer',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'year' => 1966,
                'name' => 'Gnoton',
                'created_at' => $time,
                'updated_at' => $time,
            ],
        ];

        DB::table('year_groups')->insert($yearGroups);
    }
}
