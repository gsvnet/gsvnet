<?php
use GSVnet\Committees\Committee;

class CommitteesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('committees')->truncate();

	    Committee::create(array(
            'name' => 'Amicaal bezoekcommissie',
            'description' => 'Amicaal bezoekcommissie',
        ));
        Committee::create(array(
            'name' => 'Archivaris',
            'description' => 'Archivaris',
        ));
        Committee::create(array(
            'name' => 'Barspeechcommissaris',
            'description' => 'Barspeechcommissaris',
        ));
        Committee::create(array(
            'name' => 'BASIC',
            'description' => 'BASIC',
        ));
        Committee::create(array(
            'name' => 'Bezinningsweekendcommissie',
            'description' => 'Bezinningsweekendcommissie',
        ));
        Committee::create(array(
            'name' => 'Bijbelkringcoaches',
            'description' => 'Bijbelkringcoaches',
        ));
        Committee::create(array(
            'name' => 'Bügeltrofeegroep',
            'description' => 'Bügeltrofeegroep',
        ));
        Committee::create(array(
            'name' => 'Bullen- en lintencommissie',
            'description' => 'Bullen- en lintencommissie',
        ));
        Committee::create(array(
            'name' => 'College van Mores en Advies',
            'description' => 'College van Mores en Advies',
        ));
        Committee::create(array(
            'name' => 'Commercie',
            'description' => 'Commercie',
        ));
        Committee::create(array(
            'name' => 'Concert- en Kleinkunstcommissie',
            'description' => 'Concert- en Kleinkunstcommissie',
        ));
        Committee::create(array(
            'name' => 'Diescommissie',
            'description' => 'Diescommissie',
        ));
        Committee::create(array(
            'name' => 'DrEC',
            'description' => 'DrEC',
        ));
        Committee::create(array(
            'name' => 'GerGem',
            'description' => 'GerGem',
        ));
        Committee::create(array(
            'name' => 'GoeDoecie',
            'description' => 'GoeDoecie',
        ));
        Committee::create(array(
            'name' => 'Jaarbundelcommissie',
            'description' => 'Jaarbundelcommissie',
        ));
        Committee::create(array(
            'name' => 'Kascontrolecommisie',
            'description' => 'Kascontrolecommisie',
        ));
        Committee::create(array(
            'name' => 'Keicommissie',
            'description' => 'Keicommissie',
        ));
        Committee::create(array(
            'name' => 'Le Dûc',
            'description' => 'Le Dûc',
        ));
        Committee::create(array(
            'name' => 'MALversacie',
            'description' => 'MALversacie',
        ));
        Committee::create(array(
            'name' => 'Ministers van de Senaat',
            'description' => 'Ministers van de Senaat',
        ));
        Committee::create(array(
            'name' => 'Novitiaatscommissie',
            'description' => 'Novitiaatscommissie',
        ));
        Committee::create(array(
            'name' => 'OV-Commissie',
            'description' => 'OV-Commissie',
        ));
        Committee::create(array(
            'name' => 'PRescie',
            'description' => 'PRescie',
        ));
        Committee::create(array(
            'name' => 'Ramcie',
            'description' => 'Ramcie',
        ));
        Committee::create(array(
            'name' => 'Reebocie',
            'description' => 'Reebocie',
        ));
        Committee::create(array(
            'name' => 'Regiocommissie regio 1',
            'description' => 'Regiocommissie regio 1',
        ));
        Committee::create(array(
            'name' => 'Regiocommissie regio 2',
            'description' => 'Regiocommissie regio 2',
        ));
        Committee::create(array(
            'name' => 'Regiocommissie regio 3',
            'description' => 'Regiocommissie regio 3',
        ));
        Committee::create(array(
            'name' => 'Regiocommissie regio 4',
            'description' => 'Regiocommissie regio 4',
        ));
        Committee::create(array(
            'name' => 'SIC Verzender',
            'description' => 'SIC Verzender',
        ));
        Committee::create(array(
            'name' => 'SICredactie',
            'description' => 'SICredactie',
        ));
        Committee::create(array(
            'name' => 'Sooscie',
            'description' => 'Sooscie',
        ));
        Committee::create(array(
            'name' => 'SPAC',
            'description' => 'SPAC',
        ));
        Committee::create(array(
            'name' => 'Vaandeldragers',
            'description' => 'Vaandeldragers',
        ));
        Committee::create(array(
            'name' => 'Vertrouwenspersonen',
            'description' => 'Vertrouwenspersonen',
        ));
        Committee::create(array(
            'name' => 'VGSE',
            'description' => 'VGSE',
        ));
        Committee::create(array(
            'name' => 'Vlagcommissie',
            'description' => 'Vlagcommissie',
        ));
        Committee::create(array(
            'name' => 'Webcie',
            'description' => 'Webcie',
        ));
	}

}
