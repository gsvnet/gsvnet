<?php

class CommitteesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('committees')->truncate();

		$committees = array(
            array(
                'name' => 'Amicaal bezoekcommissie',
                'description' => 'Amicaal bezoekcommissie',
            ),
            array(
                'name' => 'Archivaris',
                'description' => 'Archivaris',
            ),
            array(
                'name' => 'Barspeechcommissaris',
                'description' => 'Barspeechcommissaris',
            ),
            array(
                'name' => 'BASIC',
                'description' => 'BASIC',
            ),
            array(
                'name' => 'Bezinningsweekendcommissie',
                'description' => 'Bezinningsweekendcommissie',
            ),
            array(
                'name' => 'Bijbelkringcoaches',
                'description' => 'Bijbelkringcoaches',
            ),
            array(
                'name' => 'Bügeltrofeegroep',
                'description' => 'Bügeltrofeegroep',
            ),
            array(
                'name' => 'Bullen- en lintencommissie',
                'description' => 'Bullen- en lintencommissie',
            ),
            array(
                'name' => 'College van Mores en Advies',
                'description' => 'College van Mores en Advies',
            ),
            array(
                'name' => 'Commercie',
                'description' => 'Commercie',
            ),
            array(
                'name' => 'Concert- en Kleinkunstcommissie',
                'description' => 'Concert- en Kleinkunstcommissie',
            ),
            array(
                'name' => 'Diescommissie',
                'description' => 'Diescommissie',
            ),
            array(
                'name' => 'DrEC',
                'description' => 'DrEC',
            ),
            array(
                'name' => 'GerGem',
                'description' => 'GerGem',
            ),
            array(
                'name' => 'GoeDoecie',
                'description' => 'GoeDoecie',
            ),
            array(
                'name' => 'Jaarbundelcommissie',
                'description' => 'Jaarbundelcommissie',
            ),
            array(
                'name' => 'Kascontrolecommisie',
                'description' => 'Kascontrolecommisie',
            ),
            array(
                'name' => 'Keicommissie',
                'description' => 'Keicommissie',
            ),
            array(
                'name' => 'Le Dûc',
                'description' => 'Le Dûc',
            ),
            array(
                'name' => 'MALversacie',
                'description' => 'MALversacie',
            ),
            array(
                'name' => 'Ministers van de Senaat',
                'description' => 'Ministers van de Senaat',
            ),
            array(
                'name' => 'Novitiaatscommissie',
                'description' => 'Novitiaatscommissie',
            ),
            array(
                'name' => 'OV-Commissie',
                'description' => 'OV-Commissie',
            ),
            array(
                'name' => 'PRescie',
                'description' => 'PRescie',
            ),
            array(
                'name' => 'Ramcie',
                'description' => 'Ramcie',
            ),
            array(
                'name' => 'Reebocie',
                'description' => 'Reebocie',
            ),
            array(
                'name' => 'Regiocommissie regio 1',
                'description' => 'Regiocommissie regio 1',
            ),
            array(
                'name' => 'Regiocommissie regio 2',
                'description' => 'Regiocommissie regio 2',
            ),
            array(
                'name' => 'Regiocommissie regio 3',
                'description' => 'Regiocommissie regio 3',
            ),
            array(
                'name' => 'Regiocommissie regio 4',
                'description' => 'Regiocommissie regio 4',
            ),
            array(
                'name' => 'SIC Verzender',
                'description' => 'SIC Verzender',
            ),
            array(
                'name' => 'SICredactie',
                'description' => 'SICredactie',
            ),
            array(
                'name' => 'Sooscie',
                'description' => 'Sooscie',
            ),
            array(
                'name' => 'SPAC',
                'description' => 'SPAC',
            ),
            array(
                'name' => 'Vaandeldragers',
                'description' => 'Vaandeldragers',
            ),
            array(
                'name' => 'Vertrouwenspersonen',
                'description' => 'Vertrouwenspersonen',
            ),
            array(
                'name' => 'VGSE',
                'description' => 'VGSE',
            ),
            array(
                'name' => 'Vlagcommissie',
                'description' => 'Vlagcommissie',
            ),
            array(
                'name' => 'Webcie',
                'description' => 'Webcie',
            ),
		);

		// Uncomment the below to run the seeder
		DB::table('committees')->insert($committees);
	}

}
