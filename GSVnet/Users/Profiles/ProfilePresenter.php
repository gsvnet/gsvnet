<?php namespace GSVnet\Users\Profiles;

use Laracasts\Presenter\Presenter;
use Carbon\Carbon;
use Config;
use URL;
use HTML;

class ProfilePresenter extends Presenter
{
    public function birthday()
    {
        $day = Carbon::createFromFormat('Y-m-d', $this->birthdate);
        $today = Carbon::today();

        if ($day->format('m-d') == $today->format('m-d'))
            return 'Vandaag';
        else
            return $day->formatLocalized('%e %B');
    }

    public function birthdayWithYear()
    {
        if (is_null($this->birthdate))
            return 'Op een dag';

        $day = Carbon::createFromFormat('Y-m-d', $this->birthdate);
        $today = Carbon::today();

        if ($day->format('Y-m') == $today->format('Y-m'))
            return 'Vandaag';
        else
            return $day->formatLocalized('%e %B %Y');
    }

    public function genderLocalized()
    {
        return $this->gender === null ? 'Nee' : ($this->gender == 1 ? 'Man' : 'Vrouw');
    }

    public function alumniStatus()
    {
        return $this->reunist ? 'Ja' : 'Nee';
    }

    public function xsmallProfileImage()
    {
        if ($this->photo_path != '')
            return action('MemberController@showPhoto', [$this->user->profile->id, 'x-small']);
            
        return $this->user->present()->avatar(102);
    }

    public function photo()
    {
        if ($this->photo_path != '')
            return action('MemberController@showPhoto', $this->user->profile->id);

        return $this->user->present()->avatar(120);
    }

    public function regionName()
    {
        $region = $this->user->profile->current_region;
        return $region ? 'Regio ' . $region->name : 'geen regio';
    }

    public function formerRegionLinks()
    {
        return $this->user->profile->former_regions->map(function($region, $i){
            $searchUrl = action('UserController@showUsers', ['regio' => $region->id]);
            return "<a href='". $searchUrl ."'>Regio " . $region->name . "</a>";
        })->implode(', ');
    }

    public function student_number()
    {
        $nr = $this->student_number;

        if (is_null($nr) || empty($nr))
            return 'Onbekend';

        return $nr;
    }

    public function resignationDateSimple()
    {
        if (is_null($this->resignation_date))
            return '';

        return Carbon::createFromFormat('Y-m-d', $this->entity->resignation_date)->format('d-m-Y');
    }

    public function inaugurationDateSimple()
    {
        if (is_null($this->inauguration_date))
            return '';

        return Carbon::createFromFormat('Y-m-d', $this->entity->inauguration_date)->format('d-m-Y');
    }

    public function resignationDateExpressive()
    {
        if (is_null($this->resignation_date))
            return '';

        return Carbon::createFromFormat('Y-m-d', $this->entity->resignation_date)->formatLocalized('%e %B %Y');
    }

    public function inaugurationDateExpressive()
    {
        if (is_null($this->inauguration_date))
            return '';

        return Carbon::createFromFormat('Y-m-d', $this->entity->inauguration_date)->formatLocalized('%e %B %Y');
    }
}