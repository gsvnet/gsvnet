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
            'unique_name' => 'abc'
        ));
        Committee::create(array(
            'name' => 'Archivaris',
            'description' => 'Archivaris',
            'unique_name' => 'archivaris'
        ));
        Committee::create(array(
            'name' => 'Barspeechcommissaris',
            'description' => 'Barspeechcommissaris',
            'unique_name' => 'barspeech'
        ));
        Committee::create(array(
            'name' => 'BASIC',
            'description' => 'BASIC',
            'unique_name' => 'basic'
        ));
        Committee::create(array(
            'name' => 'Bezinningsweekendcommissie',
            'description' => 'Bezinningsweekendcommissie',
            'unique_name' => 'bezwicie'
        ));
        Committee::create(array(
            'name' => 'Bijbelkringcoaches',
            'description' => 'Bijbelkringcoaches',
            'unique_name' => 'bijbelkringcoaches'
        ));
        Committee::create(array(
            'name' => 'Bügeltrofeegroep',
            'description' => 'Bügeltrofeegroep',
            'unique_name' => 'bugeltrofee'
        ));
        Committee::create(array(
            'name' => 'Bullen- en lintencommissie',
            'description' => 'Bullen- en lintencommissie',
            'unique_name' => 'lullen-en-binten'
        ));
        Committee::create(array(
            'name' => 'College van Mores en Advies',
            'description' => 'College van Mores en Advies',
            'unique_name' => 'mores-en-advies'
        ));
        Committee::create(array(
            'name' => 'Commercie',
            'description' => 'Commercie',
            'unique_name' => 'commercie'
        ));
        Committee::create(array(
            'name' => 'Concert- en Kleinkunstcommissie',
            'description' => 'Concert- en Kleinkunstcommissie',
            'unique_name' => 'ckc'
        ));
        Committee::create(array(
            'name' => 'Diescommissie',
            'description' => 'Diescommissie',
            'unique_name' => 'diescie'
        ));
        Committee::create(array(
            'name' => 'DrEC',
            'description' => 'DrEC',
            'unique_name' => 'drec'
        ));
        Committee::create(array(
            'name' => 'GerGem',
            'description' => 'GerGem',
            'unique_name' => 'gergem'
        ));
        Committee::create(array(
            'name' => 'GoeDoecie',
            'description' => 'GoeDoecie',
            'unique_name' => 'goedoecie'
        ));
        Committee::create(array(
            'name' => 'Jaarbundelcommissie',
            'description' => 'Jaarbundelcommissie',
            'unique_name' => 'jaarbundelcommissie'
        ));
        Committee::create(array(
            'name' => 'Kascontrolecommisie',
            'description' => 'Kascontrolecommisie',
            'unique_name' => 'kascontrolecommisie'
        ));
        Committee::create(array(
            'name' => 'Keicommissie',
            'description' => 'Keicommissie',
            'unique_name' => 'keicie'
        ));
        Committee::create(array(
            'name' => 'Le Dûc',
            'description' => 'Le Dûc',
            'unique_name' => 'le-duc'
        ));
        Committee::create(array(
            'name' => 'MALversacie',
            'description' => 'MALversacie',
            'unique_name' => 'malversacie'
        ));
        Committee::create(array(
            'name' => 'Ministers van de Senaat',
            'description' => 'Ministers van de Senaat',
            'unique_name' => 'minister-van-de-senaat'
        ));
        Committee::create(array(
            'name' => 'Novitiaatscommissie',
            'description' => 'Novitiaatscommissie',
            'unique_name' => 'novcie'
        ));
        Committee::create(array(
            'name' => 'OV-Commissie',
            'description' => 'OV-Commissie',
            'unique_name' => 'ovcie'
        ));
        Committee::create(array(
            'name' => 'PRescie',
            'description' => 'PRescie',
            'unique_name' => 'prescie'
        ));
        Committee::create(array(
            'name' => 'Ramcie',
            'description' => 'Ramcie',
            'unique_name' => 'ramcie'
        ));
        Committee::create(array(
            'name' => 'Reebocie',
            'description' => 'Reebocie',
            'unique_name' => 'reebocie'
        ));
        Committee::create(array(
            'name' => 'Regiocommissie regio 1',
            'description' => 'Regiocommissie regio 1',
            'unique_name' => 'regio-1'
        ));
        Committee::create(array(
            'name' => 'Regiocommissie regio 2',
            'description' => 'Regiocommissie regio 2',
            'unique_name' => 'regio-2'
        ));
        Committee::create(array(
            'name' => 'Regiocommissie regio 3',
            'description' => 'Regiocommissie regio 3',
            'unique_name' => 'regio-3'
        ));
        Committee::create(array(
            'name' => 'Regiocommissie regio 4',
            'description' => 'Regiocommissie regio 4',
            'unique_name' => 'regio-4'
        ));
        Committee::create(array(
            'name' => 'SIC Verzender',
            'description' => 'SIC Verzender',
            'unique_name' => 'sic-verzender'
        ));
        Committee::create(array(
            'name' => 'SICredactie',
            'description' => 'SICredactie',
            'unique_name' => 'sic-redactie'
        ));
        Committee::create(array(
            'name' => 'Sooscie',
            'description' => 'Sooscie',
            'unique_name' => 'sooscie'
        ));
        Committee::create(array(
            'name' => 'SPAC',
            'description' => 'SPAC',
            'unique_name' => 'spac'
        ));
        Committee::create(array(
            'name' => 'Vaandeldragers',
            'description' => 'Vaandeldragers',
            'unique_name' => 'vaandeldragers'
        ));
        Committee::create(array(
            'name' => 'Vertrouwenspersonen',
            'description' => 'Vertrouwenspersonen',
            'unique_name' => 'vertrouwenspersonen'
        ));
        Committee::create(array(
            'name' => 'VGSE',
            'description' => 'VGSE',
            'unique_name' => 'vgse'
        ));
        Committee::create(array(
            'name' => 'Vlagcommissie',
            'description' => 'Vlagcommissie',
            'unique_name' => 'vlagcommissie'
        ));
        Committee::create(array(
            'name' => 'Webcie',
            'description' => 'Webcie',
            'unique_name' => 'webcie'
        ));
    }

}
