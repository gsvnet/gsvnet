<?php

namespace Admin;

use GSVnet\Extension\ExtensionFileValidator;
use Input, File;

class ExtensionController extends AdminBaseController {

    private $validator;

    public function __construct(ExtensionFileValidator $validator)
    {
        $this->validator = $validator;
    }

    public function index()
    {
        $this->authorize('extension.manage');
        return view('admin.extension.index');
    }

    public function store()
    {
        $this->authorize('extension.manage');
        $input['file'] = Input::file('file');
        $this->validator->validate($input);

        $path = storage_path('extension/');
        $fileName = 'shops.json';

        $input['file']->move($path, $fileName);
        if (File::exists($path.$fileName))
            flash()->success("Bestand opgeslagen.");
        else
            flash()->error("Er is iets misgegaan.");

        return view('admin.extension.index');
    }
}