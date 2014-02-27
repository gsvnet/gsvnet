<?php namespace Admin;

use View;
use Log;

class AdminController extends BaseController {

    public function index()
    {
        $this->layout->content =  View::make('admin.index');
    }

    public function log()
    {
        // $monolog = Log::getMonolog();
        // dd($monolog);
        $logs = [];
        $this->layout->content = View::make('admin.log')->withLogs($logs);
    }
}