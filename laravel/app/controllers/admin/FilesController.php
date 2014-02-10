<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Files\FileManager;
use GSVnet\Files\FilesRepositoryInterface;
use GSVnet\Files\FileStorageException;

use GSVnet\Files\Labels\LabelsRepositoryInterface;

use GSVnet\Core\Exceptions\ValidationException;

class FilesController extends BaseController {

    protected $files;
    protected $labels;
    protected $manager;

    public function __construct(
        FilesRepositoryInterface $files,
        LabelsRepositoryInterface $labels,
        FileManager $manager)
    {
        $this->files = $files;
        $this->labels = $labels;
        $this->manager = $manager;

        $this->beforeFilter('maxUploadSize', ['only' => array('store', 'update')]);
        $this->beforeFilter('csrf', ['only' => array('store', 'update', 'delete')]);
        parent::__construct();
    }

    public function index()
    {
        $files = $this->files->paginate(10);
        $labels = $this->labels->all();

        $checked = array();
        foreach ($labels as $label)
        {
            $checked[$label->id] = '';
        }

        $this->layout->content = View::make('admin.files.index')
            ->withFiles($files)
            ->withLabels($labels)
            ->withChecked($checked);
    }

    public function store()
    {
        $input = Input::all();
        $input['file'] = Input::file('file');

        try {
            $file = $this->manager->create($input);

            $message = '<strong>' . $file->name . '</strong> is succesvol opgeslagen.';
            return Redirect::action('Admin\FilesController@index')
                ->withMessage($message);
        }
        catch (ValidationException $e)
        {
            return Redirect::action('Admin\FilesController@index')
                ->withInput()
                ->withErrors($e->getErrors());
        }
        catch (FileStorageException $e)
        {
            return Redirect::action('Admin\FilesController@index')
                ->withInput()
                ->withErrors("Er ging iets mis tijdens het uploaden, probeer het opnieuw. (misschien is het geuploade bestand te groot?)");
        }
    }

    public function edit($id)
    {
        $file = $this->files->byId($id);
        $labels = $this->labels->all();
        // Get the file's labels
        $checked = array();
        $fileIdLabels = array_pluck($file->labels->toArray(), 'id');
        foreach ($labels as $label)
        {
            $checked[$label->id] = in_array($label->id, $fileIdLabels) ? 'checked' : '';
        }

        $this->layout->content = View::make('admin.files.edit')
            ->withFile($file)
            ->withLabels($labels)
            ->withChecked($checked);
    }

    public function update($id)
    {
        $input = Input::all();
        $input['file'] = Input::file('file');

        try {
            $file = $this->manager->update($id, $input);

            $message = '<strong>' . $file->name . '</strong> is succesvol opgeslagen.';
            return Redirect::action('Admin\FilesController@index')
                ->withMessage($message);
        }
        catch (ValidationException $e)
        {
            return Redirect::action('Admin\FilesController@edit', $id)
                ->withInput()
                ->withErrors($e->getErrors());
        }
        catch (FileStorageException $e)
        {
            return Redirect::action('Admin\FilesController@edit', $id)
                ->withInput()
                ->withErrors("Er ging iets mis tijdens het uploaden, probeer het opnieuw. (misschien is het geuploade bestand te groot?)");
        }
    }

    public function destroy($id)
    {
        $file = $this->manager->destroy($id);

        $message = '<strong>' . $file->name . '</strong> is succesvol verwijderd.';
        return Redirect::action('Admin\FilesController@index')
            ->withMessage($message);
    }

}