<?php

namespace App\Http\Controllers;

use App\Helpers\Files\FileHandler;
use App\Helpers\Files\FilesRepository;
use App\Helpers\Files\Labels\LabelsRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

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
     * @return
     */
    public function index(Request $request, LabelsRepository $labelsRepository): View
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
            ->with('files', $files)
            ->with('labels', $labels);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, FileHandler $fileHandler): Response
    {
        $file = $this->files->byId($id);

        $path = $fileHandler->getPath($file->file_path);

        return response()->download($path, $file->name.$file->type);
    }
}
