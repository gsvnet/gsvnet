<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Files\FileManager;
use GSVnet\Files\FilesRepository;

use GSVnet\Files\Labels\LabelsRepository;

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

    public function index()
    {
        $files = $this->files->paginate(10, false);
        $labels = $this->labels->all();

        $checked = array();

        foreach ($labels as $label)
            $checked[$label->id] = '';

        return view('admin.files.index')
            ->withFiles($files)
            ->withLabels($labels)
            ->withChecked($checked);
    }

    public function store()
    {
        $input = Input::all();
        $input['file'] = Input::file('file');
        $input['published'] = Input::get('published', false);

        $file = $this->manager->create($input);

        flash()->success("{$file->name} is succesvol opgeslagen");

        return redirect()->action('Admin\FilesController@index');
    }

    public function edit($id)
    {
        $file = $this->files->byId($id);
        $labels = $this->labels->all();

        // Get the file's labels
        $checked = array();
        $fileIdLabels = array_pluck($file->labels->toArray(), 'id');
        foreach ($labels as $label) {
            $checked[$label->id] = in_array($label->id, $fileIdLabels) ? 'checked' : '';
        }

        return view('admin.files.edit')
            ->withFile($file)
            ->withLabels($labels)
            ->withChecked($checked);
    }

    public function update($id)
    {
        $input = Input::except('published');
        $input['file'] = Input::file('file');
        $input['published'] = Input::get('published', false) == '1';

        $file = $this->manager->update($id, $input);

        flash()->success("{$file->name} is succesvol bijgewerkt.");

        return redirect()->action('Admin\FilesController@index');
    }

    public function destroy($id)
    {
        $file = $this->manager->destroy($id);

        flash()->success("{$file->name} is succesvol verwijderd.");

        return redirect()->action('Admin\FilesController@index');
    }

}