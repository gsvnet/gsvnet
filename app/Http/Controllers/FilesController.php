<?php

use App\Helpers\Files\FilesRepository;
use App\Helpers\Files\Labels\LabelsRepository;
use App\Helpers\Files\FileHandler;
use Illuminate\Http\Request;

class FilesController extends BaseController
{

    protected $fileHandler;
    protected $files;
    protected $labels;

    public function __construct(FilesRepository $files)
    {
        $this->files = $files;
        $this->authorize('docs.show');

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param LabelsRepository $labelsRepository
     * @return
     */
    public function index(Request $request, LabelsRepository $labelsRepository)
    {
        // Select all files which belong to (all of) the selected labels
        $selectedLabels = $request->get('labels');
        $search = $request->get('search');
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
     * @param  int $id
     * @param FileHandler $fileHandler
     * @return \Illuminate\Http\Response
     */
    public function show($id, FileHandler $fileHandler)
    {
        $file = $this->files->byId($id);

        $path = $fileHandler->getPath($file->file_path);

        return response()->download($path, $file->name . $file->type);
    }
}
