<?php

class BaseController extends Controller {
    /**
     * The layout that should be used for responses.
     */
    protected $layout = 'layouts.default';

    public function __construct()
    {
        Former::framework('TwitterBootstrap3');
    }
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        $this->layout = View::make($this->layout);
        $this->layout->title = 'GSVnet';
        $this->layout->description = '';
        $this->layout->keywords = '';
        $this->layout->bodyID = '';
        $this->layout->activeMenuItem = '';

        $this->currentUser = \Auth::user();
        View::share('currentUser', $this->currentUser);
    }

    protected function view($path, $data = [])
    {
        $this->layout->title = $this->title;
        $this->layout->content = View::make($path, $data);
    }

    protected function redirectTo($url, $statusCode = 302)
    {
        return Redirect::to($url, $statusCode);
    }

    protected function redirectAction($action, $data = [])
    {
        return Redirect::action($action, $data);
    }

    protected function redirectRoute($route, $data = [])
    {
        return Redirect::route($route, $data);
    }

    protected function redirectBack($data = [])
    {
        return Redirect::back()->withInput()->with($data);
    }

    protected function redirectIntended($default = null)
    {
        $intended = Session::get('auth.intended_redirect_url');
        if ($intended) {
            return $this->redirectTo($intended);
        }
        return Redirect::to($default);
    }


}