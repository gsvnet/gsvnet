<?php

class CommitteesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('committees')->truncate();

	    Model\Committee::create(array(
            'name' => 'Amicaal bezoekcommissie',
            'description' => 'Amicaal bezoekcommissie',
        ));
        Model\Committee::create(array(
            'name' => 'Archivaris',
            'description' => 'Archivaris',
        ));
        Model\Committee::create(array(
            'name' => 'Barspeechcommissaris',
            'description' => 'Barspeechcommissaris',
        ));
        Model\Committee::create(array(
            'name' => 'BASIC',
            'description' => 'BASIC',
        ));
        Model\Committee::create(array(
            'name' => 'Bezinningsweekendcommissie',
            'description' => 'Bezinningsweekendcommissie',
        ));
        Model\Committee::create(array(
            'name' => 'Bijbelkringcoaches',
            'description' => 'Bijbelkringcoaches',
        ));
        Model\Committee::create(array(
            'name' => 'Bügeltrofeegroep',
            'description' => 'Bügeltrofeegroep',
        ));
        Model\Committee::create(array(
            'name' => 'Bullen- en lintencommissie',
            'description' => 'Bullen- en lintencommissie',
        ));
        Model\Committee::create(array(
            'name' => 'College van Mores en Advies',
            'description' => 'College van Mores en Advies',
        ));
        Model\Committee::create(array(
            'name' => 'Commercie',
            'description' => 'Commercie',
        ));
        Model\Committee::create(array(
            'name' => 'Concert- en Kleinkunstcommissie',
            'description' => 'Concert- en Kleinkunstcommissie',
        ));
        Model\Committee::create(array(
            'name' => 'Diescommissie',
            'description' => 'Diescommissie',
        ));
        Model\Committee::create(array(
            'name' => 'DrEC',
            'description' => 'DrEC',
        ));
        Model\Committee::create(array(
            'name' => 'GerGem',
            'description' => 'GerGem',
        ));
        Model\Committee::create(array(
            'name' => 'GoeDoecie',
            'description' => 'GoeDoecie',
        ));
        Model\Committee::create(array(
            'name' => 'Jaarbundelcommissie',
            'description' => 'Jaarbundelcommissie',
        ));
        Model\Committee::create(array(
            'name' => 'Kascontrolecommisie',
            'description' => 'Kascontrolecommisie',
        ));
        Model\Committee::create(array(
            'name' => 'Keicommissie',
            'description' => 'Keicommissie',
        ));
        Model\Committee::create(array(
            'name' => 'Le Dûc',
            'description' => 'Le Dûc',
        ));
        Model\Committee::create(array(
            'name' => 'MALversacie',
            'description' => 'MALversacie',
        ));
        Model\Committee::create(array(
            'name' => 'Ministers van de Senaat',
            'description' => 'Ministers van de Senaat',
        ));
        Model\Committee::create(array(
            'name' => 'Novitiaatscommissie',
            'description' => 'Novitiaatscommissie',
        ));
        Model\Committee::create(array(
            'name' => 'OV-Commissie',
            'description' => 'OV-Commissie',
        ));
        Model\Committee::create(array(
            'name' => 'PRescie',
            'description' => 'PRescie',
        ));
        Model\Committee::create(array(
            'name' => 'Ramcie',
            'description' => 'Ramcie',
        ));
        Model\Committee::create(array(
            'name' => 'Reebocie',
            'description' => 'Reebocie',
        ));
        Model\Committee::create(array(
            'name' => 'Regiocommissie regio 1',
            'description' => 'Regiocommissie regio 1',
        ));
        Model\Committee::create(array(
            'name' => 'Regiocommissie regio 2',
            'description' => 'Regiocommissie regio 2',
        ));
        Model\Committee::create(array(
            'name' => 'Regiocommissie regio 3',
            'description' => 'Regiocommissie regio 3',
        ));
        Model\Committee::create(array(
            'name' => 'Regiocommissie regio 4',
            'description' => 'Regiocommissie regio 4',
        ));
        Model\Committee::create(array(
            'name' => 'SIC Verzender',
            'description' => 'SIC Verzender',
        ));
        Model\Committee::create(array(
            'name' => 'SICredactie',
            'description' => 'SICredactie',
        ));
        Model\Committee::create(array(
            'name' => 'Sooscie',
            'description' => 'Sooscie',
        ));
        Model\Committee::create(array(
            'name' => 'SPAC',
            'description' => 'SPAC',
        ));
        Model\Committee::create(array(
            'name' => 'Vaandeldragers',
            'description' => 'Vaandeldragers',
        ));
        Model\Committee::create(array(
            'name' => 'Vertrouwenspersonen',
            'description' => 'Vertrouwenspersonen',
        ));
        Model\Committee::create(array(
            'name' => 'VGSE',
            'description' => 'VGSE',
        ));
        Model\Committee::create(array(
            'name' => 'Vlagcommissie',
            'description' => 'Vlagcommissie',
        ));
        Model\Committee::create(array(
            'name' => 'Webcie',
            'description' => 'Webcie',
        ));
	}

}
