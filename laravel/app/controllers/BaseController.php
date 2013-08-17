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
		}
	}

	public function __construct()
	{
		Former::framework('TwitterBootstrap3');
	}

}