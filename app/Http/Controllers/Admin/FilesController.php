<?php

namespace Admin;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Helpers\Files\FileManager;
use App\Helpers\Files\FilesRepository;
use App\Helpers\Files\Labels\LabelsRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;

class FilesController extends AdminBaseController
{
    protected $files;

    protected $labels;

    protected $manager;

    public function __construct(FilesRepository $files, LabelsRepository $labels, FileManager $manager)
    {
        $this->files = $files;
        $this->labels = $labels;
        $this->manager = $manager;

        $this->authorize('docs.manage');

        parent::__construct();
    }

    public function index(): View
    {
        $files = $this->files->paginate(10, false);
        $labels = $this->labels->all();

        $checked = [];

        foreach ($labels as $label) {
            $checked[$label->id] = '';
        }

        return view('admin.files.index')
            ->with('files', $files)
            ->with('labels', $labels)
            ->with('checked', $checked);
    }

    public function store(): RedirectResponse
    {
        $input = Request::all();
        $input['file'] = Request::file('file');
        $input['published'] = Request::get('published', false);

        $file = $this->manager->create($input);

        flash()->success("{$file->name} is succesvol opgeslagen");

        return redirect()->action([\App\Http\Controllers\Admin\FilesController::class, 'index']);
    }

    public function edit($id): View
    {
        $file = $this->files->byId($id);
        $labels = $this->labels->all();

        // Get the file's labels
        $checked = [];
        $fileIdLabels = Arr::pluck($file->labels->toArray(), 'id');
        foreach ($labels as $label) {
            $checked[$label->id] = in_array($label->id, $fileIdLabels) ? 'checked' : '';
        }

        return view('admin.files.edit')
            ->with('file', $file)
            ->with('labels', $labels)
            ->with('checked', $checked);
    }

    public function update($id): RedirectResponse
    {
        $input = Request::except('published');
        $input['file'] = Request::file('file');
        $input['published'] = Request::get('published', false) == '1';

        $file = $this->manager->update($id, $input);

        flash()->success("{$file->name} is succesvol bijgewerkt.");

        return redirect()->action([\App\Http\Controllers\Admin\FilesController::class, 'index']);
    }

    public function destroy($id): RedirectResponse
    {
        $file = $this->manager->destroy($id);

        flash()->success("{$file->name} is succesvol verwijderd.");

        return redirect()->action([\App\Http\Controllers\Admin\FilesController::class, 'index']);
    }
}
