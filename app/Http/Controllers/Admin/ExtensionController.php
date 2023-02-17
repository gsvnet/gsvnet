<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Extension\ExtensionFileValidator;
use File;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class ExtensionController extends AdminBaseController
{
    private $validator;

    public function __construct(ExtensionFileValidator $validator)
    {
        $this->validator = $validator;
    }

    public function index(): View
    {
        $this->authorize('extension.manage');

        return view('admin.extension.index');
    }

    public function store(): View
    {
        $this->authorize('extension.manage');
        $input['file'] = Request::file('file');
        $this->validator->validate($input);

        $path = storage_path('extension/');
        $fileName = 'shops.json';

        $input['file']->move($path, $fileName);
        if (File::exists($path.$fileName)) {
            flash()->success('Bestand opgeslagen.');
        } else {
            flash()->error('Er is iets misgegaan.');
        }

        return view('admin.extension.index');
    }
}
