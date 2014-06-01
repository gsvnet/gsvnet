<?php

use GSVnet\Committees\CommitteesRepository;
use GSVnet\Senates\SenatesRepository;

class AboutController extends BaseController {


    public function __construct(CommitteesRepository $committees, SenatesRepository $senates)
    {
        $this->committees = $committees;
        $this->senates = $senates;
    }

	public function showAbout()
	{
		$this->layout->content = View::make('de-gsv.de-gsv');
        $this->layout->title = 'Over de GSV';
        $this->layout->description = 'De GSV is een christelijke studentenvereniging met een gereformeerde basis. Ze heeft zo\'n 200 leden die wekelijks bijeen komen voor bijbelstudie een biertje op soos.';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->activeSubMenuItem = 'over-de-gsv';
    }

    public function showCommittees()
    {
        $committees = $this->committees->all();

        $this->layout->bodyID = 'committees-page';
        $this->layout->title = 'Commissies van de GSV';
        $this->layout->description = 'Binnen de GSV zijn er veel verschillende commissies die samen de vereniging tot een bruisend geheel maken door allerlei activiteiten te organiseren en belangrijke taken te vervullen.';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->activeSubMenuItem = 'commissies';
        $this->layout->content = View::make('de-gsv.committees.index')
            ->with('committees', $committees);
    }

    public function showCommittee($slug)
    {
        $committee = $this->committees->bySlug($slug);
        $committees = $this->committees->all();
        $activeMembers = $committee->activeMembers;

        $this->layout->bodyID = 'committee-page';
        $this->layout->title = $committee->name . ' - Commissies van de GSV';
        $this->layout->description = $committee->description;
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->activeSubMenuItem = 'commissies';
        $this->layout->content = View::make('de-gsv.committees.show')
            ->with('committee', $committee)
            ->with('committees', $committees)
            ->with('activeMembers', $activeMembers);
    }

    public function showSenates()
    {
        $senates = $this->senates->all();

        $this->layout->bodyID = 'senates-page';
        $this->layout->title = 'Senaten';
        $this->layout->description = 'De GSV wordt bestuurd door een senaat die bestaat uit een vijftal functies: praeses, abactis, fiscus, assessor primus en assessor secundus.';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->activeSubMenuItem = 'senaten';
        $this->layout->content = View::make('de-gsv.senates.index')
            ->with('senates', $senates);
    }

    public function showSenate($id)
    {
        $senates = $this->senates->all();
        $senate = $this->senates->byId($id);
        $members = $senate->members()->get();
        
        $this->layout->bodyID = 'senate-page';
        $this->layout->title = 'Senaat ' . $senate->name;
        $this->layout->description = 'Senaat ' . $senate->name;
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->activeSubMenuItem = 'senaten';
        $this->layout->content = View::make('de-gsv.senates.single')
            ->with('currentSenate', $senate)
            ->with('senates', $senates)
            ->with('members', $members);
    }

    public function showContact()
    {
        $this->layout->bodyID = 'contact-page';
        $this->layout->title = 'Contact';
        $this->layout->description = 'Op deze pagina kunt u de contactgegevens van het abactiaat en het sociëteitspand van de GSV vinden';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->activeSubMenuItem = 'contact';
        $this->layout->content = View::make('de-gsv.contact');
    }

    public function showPillars()
    {
        $this->layout->bodyID = 'pillars-page';
        $this->layout->title = 'Pijlers';
        $this->layout->description = 'De GSV kent vier pijlers: christelijk, intellectueel, sociaal en studentikoos.';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->activeSubMenuItem = 'pijlers';
        $this->layout->content = View::make('de-gsv.pillars');
    }

    public function showHistory()
    {
        $this->layout->bodyID = 'history-page';
        $this->layout->title = 'Geschiedenis';
        $this->layout->description = 'De Gereformeerde Studenten Vereniging werd opgericht op 23 juni 1966 en was verbonden aan de Gereformeerde Kerken (Vrijgemaakt). Sinds 2004 is de GSV een zelfstandige organisatie met een duidelijke gereformeerde identiteit.';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->activeSubMenuItem = 'geschiedenis';
        $this->layout->content = View::make('de-gsv.history');
    }
}