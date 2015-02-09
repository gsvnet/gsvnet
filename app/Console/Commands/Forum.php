<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use GSVnet\Forum\Threads\Thread;

class Forum extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'forum:slugs';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update slugs.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//

		$threads = Thread::all();
		foreach($threads as $thread)
		{
			$thread->slug = $thread->generateNewSlug();
			$thread->timestamps = false;
			$thread->save();
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
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
