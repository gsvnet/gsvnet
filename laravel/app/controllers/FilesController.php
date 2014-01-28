<?php

use GSVnet\Services\FileHandler;

class FilesController extends BaseController {

	protected $fileHandler;

    public function __construct(FileHandler $fileHandler)
    {
        $this->fileHandler = $fileHandler;
        parent::__construct();
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
		// Select all files which belong to (all of) the selected labels
		if (Input::has('labels'))
		{
			$selected_labels = Input::get('labels');
			$count = count($selected_labels);

			$file_ids = DB::table('file_label')
				->whereIn('label_id', $selected_labels)
				->groupBy('file_id')
				->havingRaw('count(*) = ' . $count)
				->lists('file_id');

			$files = \Model\File::whereIn('id', $file_ids)->paginate(10);
		}
		else
		{
			$files = \Model\File::paginate(10);
		}

		$labels = \Model\Label::all();

        $this->layout->content =  View::make('files.index')
        	->withFiles($files)
        	->withLabels($labels);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return $this->download($id);
		// $file = \Model\File::find($id);

		// return Response::download($file->file);
	}

	public function download($id)
	{
		$file = \Model\File::find($id);

		$file = $this->fileHandler->getPath($file->file_path);

		return Response::download($file);
	}
}
