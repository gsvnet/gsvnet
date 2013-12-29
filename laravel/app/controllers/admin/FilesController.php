<?php namespace Admin;

use View;
use Model\Photo;
use Model\Album;
use Input;
use Validator;
use Str;
use Redirect;
use File;

class FilesController extends BaseController {
    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => array('store', 'update', 'delete')]);
        parent::__construct();
    }

    public function index()
    {
        $files = \Model\File::paginate(10);
        $labels = \Model\Label::all();

        $this->layout->content = View::make('admin.files.index')
            ->withFiles($files)
            ->withLabels($labels);
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
            $input['file']->move(public_path() . '/uploads/photos/', $filename);

            $file->file_path = '/uploads/photos/' . $filename;
            $file->save();


            return Redirect::action('Admin\FilesController@index')
                ->with('message', '<strong>' . $file->name . '</strong> is succesvol opgeslagen.')
                ->with('changedID', $file->id);
        }

        return Redirect::back()->withInput()->withErrors($validation);
    }

    public function show($id)
    {
        $file = \Model\File::find($id);
        $labels = \Model\Label::all();
        // $labels = json_encode(array_fetch($labels->toArray(), 'name'));

        $this->layout->content = View::make('admin.files.show')
            ->withFile($file)
            ->withLabels($labels);
    }

    public function update($id)
    {

    }

    public function destroy($id)
    {

    }

}