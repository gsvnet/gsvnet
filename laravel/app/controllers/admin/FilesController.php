<?php namespace Admin;

use View;
use Model\Photo;
use Model\Album;
use Input;
use Validator;
use Str;
use Redirect;
use File;

use GSVnet\Services\FileHandler;

class FilesController extends BaseController {

    protected $fileHandler;

    public function __construct(FileHandler $fileHandler)
    {
        $this->fileHandler = $fileHandler;
        $this->beforeFilter('csrf', ['only' => array('store', 'update', 'delete')]);
        parent::__construct();
    }

    public function index()
    {
        $files = \Model\File::paginate(10);
        $labels = \Model\Label::all();

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
        // Validate file name, file type
        $validation = Validator::make($input, \Model\File::$rules);

        if ($validation->passes())
        {
            $file = new \Model\File();
            $file->name = $input['name'];

            $filename = time() . '-' . $input['file']->getClientOriginalName();
            $input['file']->move(public_path() . '/uploads/files/', $filename);

            $file->file_path = '/uploads/files/' . $filename;
            $file->save();

            if (Input::has('labels'))
            {
                $file->labels()->sync($input['labels']);
            }

            return Redirect::action('Admin\FilesController@index')
                ->with('message', '<strong>' . $file->name . '</strong> is succesvol opgeslagen.')
                ->with('changedID', $file->id);
        }

        return Redirect::back()->withInput()->withErrors($validation);
    }

    public function edit($id)
    {
        $file = \Model\File::find($id);
        $labels = \Model\Label::all();

        $checked = array();
        $fileIdLabels = array_pluck($file->labels->toArray(), 'id');
        foreach ($labels as $label)
        {
            $checked[$label->id] = in_array($label->id, $fileIdLabels) ? 'checked' : '';
        }

        // $labels = json_encode(array_fetch($labels->toArray(), 'name'));

        $this->layout->content = View::make('admin.files.edit')
            ->withFile($file)
            ->withLabels($labels)
            ->withChecked($checked);
    }

    public function update($id)
    {
        $input = Input::all();
        $input['file'] = Input::file('file');

        // Validate file name, file type
        $validation = Validator::make($input, \Model\File::$rules);

        if ($validation->passes())
        {
            $file = \Model\File::findOrFail($id);
            $file->name = $input['name'];

            if (Input::hasFile('file'))
            {
                // Delete old file
                if (File::exists(public_path() . $photo->src_path))
                {
                    File::delete(public_path() . $photo->src_path);
                }

                $filename = time() . '-' . $input['file']->getClientOriginalName();
                $input['file']->move(public_path() . '/uploads/photos/', $filename);

                $file->file_path = '/uploads/photos/' . $filename;
            }

            if (Input::has('labels'))
            {
                $file->labels()->sync($input['labels']);
            }
            else
            {
                $file->labels()->sync(array());
            }

            $file->save();

            return Redirect::action('Admin\FilesController@index')
                ->with('message', '<strong>' . $file->name . '</strong> is succesvol bewerkt.')
                ->with('changedID', $id);
        }

        return Redirect::back()
            ->withInput()
            ->withErrors($validation);
    }

    public function destroy($id)
    {
        $file = \Model\File::find($id);

        // Delete old file
        if (File::exists(public_path() . $file->src_path))
        {
            File::delete(public_path() . $file->src_path);
        }

        $file->delete();

        return Redirect::action('Admin\FilesController@index')
            ->with('message', '<strong>' . $file->name . '</strong> is succesvol verwijderd.');
    }

}