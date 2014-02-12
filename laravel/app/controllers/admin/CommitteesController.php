<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Committees\CommitteesRepositoryInterface;
use GSVnet\Committees\CommitteeValidator;

use GSVnet\Core\Exceptions\ValidationException;

class CommitteeController extends BaseController {

    protected $committees;
    protected $validator;

    public function __construct(
        CommitteesRepositoryInterface $committees,
        CommitteeValidator $validator)
    {
        $this->committees = $committees;
        $this->validator = $validator;

        $this->beforeFilter('csrf', ['only' => ['store', 'update', 'delete']]);
        $this->beforeFilter('committees.create', ['on' => 'store']);
        $this->beforeFilter('committees.update', ['only' => ['update', 'edit']]);
        $this->beforeFilter('committees.delete', ['on' => 'destroy']);

        parent::__construct();
    }

    public function index()
    {
        $committees = $this->committees->paginate(10);

        $this->layout->content = View::make('admin.committees.index')->with('committees', $committees);
    }

    public function store()
    {
        $input = Input::all();
        $input['public'] = Input::get('public', false);

        try
        {
            $this->validator->validate($input);
            $committee = $this->committees->create($input);

            $message = '<strong>' . $committee->name . '</strong> is succesvol opgeslagen.';
            return Redirect::action('Admin\CommitteeController@index')
                ->withMessage($message);
        }
        catch (ValidationException $e)
        {
            return Redirect::action('Admin\CommitteeController@index')
                ->withInput()
                ->withErrors($e->getErrors());
        }
    }

    public function show($id)
    {
        $committee = $this->committees->byId($id);

        $usersPerPage = 10;
        $users = $this->committees->usersByCommitteIdAndPaginate($id, $usersPerPage);

        $this->layout->content = View::make('admin.committees.show')
            ->withCommittee($committee)
            ->withUsers($users);
    }

    public function edit($id)
    {
        $committee = $this->committees->byId($id);

        $this->layout->content = View::make('admin.committees.edit')
            ->withCommittee($committee);
    }

    public function update($id)
    {
        $input = Input::all();

        try
        {
            $this->validator->validate($input);
            $committee1 = $this->committees->update($id, $input);

            $message = '<strong>' . $committee->name . '</strong> is succesvol bewerkt.';
            return Redirect::action('Admin\CommitteeController@show', $id)
                ->withMessage($message);
        }
        catch (ValidationException $e)
        {
            return Redirect::action('Admin\CommitteeController@edit', $id)
                ->withInput()
                ->withErrors($e->getErrors());
        }
    }

    public function destroy($id)
    {
        $committee = $this->committees->delete($id);

        return Redirect::action('Admin\CommitteeController@index')
            ->with('message', '<strong>' . $committee->name . '</strong> is succesvol verwijderd.');
    }
}