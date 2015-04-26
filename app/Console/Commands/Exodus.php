<?php namespace GSV\Console\Commands;

use GSVnet\Users\User;
use GSVnet\Users\YearGroup;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use GSVnet\Users\Profiles\UserProfile;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Input\InputArgument;

class Exodus extends Command {

    protected $name = 'exodus:start';
    protected $description = 'Migrates json family data to mysql.';
    private $yearIdMap;
    private $walked = 0;

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {
        $file = file_get_contents(base_path() . '/' . $this->argument('json'));
        $data = \GuzzleHttp\json_decode($file);

        $this->buildMap();

        // Begin the scary bit.
        DB::transaction(function() use ($data)
        {
            $this->walk($data->children);
            $this->info('Langs ' . $this->walked . ' kinderen gelopen');
        });
    }

    private function buildMap()
    {
        foreach(YearGroup::all() as $group)
        {
            $this->yearIdMap[$group->year] = $group->id;
        }
    }

    private function walk($children, $parent = null)
    {
        foreach ($children as $child)
        {
            $this->walked++;

            $user = $this->findPerfectMatch($child->firstname, $child->lastname, $child->year);

            if ($user)
            {
                // If the user has already parents, simply stop.
                $numParents = $user->parents()->count();

                if ($numParents > 0)
                {
                    $this->info($child->lastname . ' (' . $child->year . ') heeft al ouders');
                    continue;
                }
            } else
            {
                $user = $this->newUser($child);
            }

            // Save parent relation
            if ($parent instanceof Model)
            {
                $user->parents()->save($parent);
            }

            // Continue in depth
            $this->walk($child->children, $user);
        }
    }

    private function findPerfectMatch($firstname, $lastname, $year)
    {
        $matches = $this->getUserByLastNameAndYear($lastname, $year);

        if (count($matches) > 1)
        {
            $this->info('Specifieker zoeken naar ' . $firstname . ' ' . $lastname . ' (' . $year . ')');
            $matches = $this->getUserByFirstNameLastNameAndYear($firstname, $lastname, $year);
        }

        if( count($matches) == 0)
            return null;

        // Ga ervan uit dat voornaam + achternaam + jaar max 1 persoon geeft.
        return $matches[0];
    }

    private function getUserByLastNameAndYear($lastname, $year)
    {
        return User::where('lastname', $lastname)
            ->whereHas('profile.yearGroup', function($q) use ($year)
            {
                $q->where('year_groups.year', $year);
            })->get();
    }

    private function getUserByFirstNameLastNameAndYear($firstname, $lastname, $year)
    {
        return User::where('lastname', $lastname)
            ->where('firstname', $firstname)
            ->whereHas('profile.yearGroup', function($q) use ($year)
            {
                $q->where('year_groups.year', $year);
            })->get();
    }

    private function newUser($data)
    {
        $user = new User;
        $user->type = User::FORMERMEMBER;
        $user->firstname = $data->firstname;
        $user->middlename = $data->middlename;
        $user->lastname = $data->lastname;
        $user->username = Str::slug($data->firstname . ' ' . $data->lastname . ' ' . rand(1,100));
        $user->email = Str::slug($data->firstname . ' ' . $data->lastname . ' ' . rand(1,100)) . '@gsvnet.nl';
        $user->approved = true;
        $user->password = str_random(20);
        $user->save();

        $profile = new UserProfile;

        if(array_key_exists($data->year, $this->yearIdMap))
        {
            $profile->year_group_id = $this->yearIdMap[$data->year];
        }

        $user->profile()->save($profile);

        return $user;
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
            ['json', InputArgument::REQUIRED, 'Pad naar JSON vanaf root']
        ];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}
}
