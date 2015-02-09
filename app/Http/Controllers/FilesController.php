<?php

use GSVnet\Files\FilesRepository;
use GSVnet\Files\Labels\LabelsRepository;
use GSVnet\Files\FileHandler;

class FilesController extends BaseController {

	protected $fileHandler;
	protected $files;
	protected $labels;

    public function __construct(FilesRepository $files)
    {
        $this->files = $files;

        $this->beforeFilter('files.show', ['only' => ['index', 'show']]);

        parent::__construct();
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @param LabelsRepository $labelsRepository
	 * @return Response
	 */
	public function index(LabelsRepository $labelsRepository)
	{
		// Select all files which belong to (all of) the selected labels
		$selectedLabels = Input::get('labels');
        $search = Input::get('search');
		$filesPerPage = 10;

		$files = $this->files->getPublishedAndSearchWithLabelsAndPaginate(
            $search, $selectedLabels, $filesPerPage
        );

		$labels = $labelsRepository->all();

        return view('files.index')
        	->withFiles($files)
        	->withLabels($labels);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, FileHandler $fileHandler)
	{
		$file = $this->files->byId($id);

		$path = $fileHandler->getPath($file->file_path);

		return Response::download($path, $file->name);
	}
}
