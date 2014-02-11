<?php

use GSVnet\Files\FilesRepositoryInterface;
use GSVnet\Files\Labels\LabelsRepositoryInterface;
use GSVnet\Files\FileHandler;

class FilesController extends BaseController {

	protected $fileHandler;
	protected $files;
	protected $labels;

    public function __construct(
    	FileHandler $fileHandler,
    	FilesRepositoryInterface $files,
    	LabelsRepositoryInterface $labels)
    {
        $this->fileHandler = $fileHandler;
        $this->files = $files;
        $this->labels = $labels;

        $this->beforeFilter('files.show', ['only' => ['index', 'show']]);

        parent::__construct();
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Select all files which belong to (all of) the selected labels
		$selectedLabels = Input::get('labels');
		$filesPerPage = 10;
		$files = $this->files->paginateWhereLabels($filesPerPage, $selectedLabels);

		$labels = $this->labels->all();

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
		$file = $this->files->byId($id);

		$path = $this->fileHandler->getPath($file->file_path);

		return Response::download($path, $file->name);
	}
}
