<?php

class ExtensionApiController extends BaseController {

    public function show()
    {
        $path = storage_path('extension/shops.json');

        if (!File::exists($path))
            return response("file not found", 404, ['Content-Type' => 'text/plain']);

        return response()->file($path, ['Content-Type' => 'application/json']);
    }
}