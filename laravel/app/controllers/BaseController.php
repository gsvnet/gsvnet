<?php

class BaseController extends Controller {
    /**
     * The layout that should be used for responses.
     */
    protected $layout = 'layouts.default';

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
            $this->layout->title = 'GSVnet';
            $this->layout->description = '';
            $this->layout->keywords = '';
        }
    }

    public function __construct()
    {
        Former::framework('Nude');
    }

}