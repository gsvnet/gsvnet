<?php namespace GSVnet\Committees;

use GSVnet\Users\User;

class CommitteesRepository {

    /**
     * Get by id
     *
     * @param int $id
     * @return Committee
     */
    public function byId($id)
    {
        return Committee::findOrFail($id);
    }

    /**
     * Get by slug
     *
     * @param string $slug
     * @return Committee
     */
    public function bySlug($slug)
    {
        return Committee::where('unique_name', '=', $slug)->firstOrFail();
    }

    public function byUserOrderByRecent(User $user)
    {
        return $user->committees()->orderBy('end_date', 'DESC')->get();
    }

    /**
    * Get all committees
    *
    * @return Collection
    */
    public function all()
    {
        return Committee::orderBy('name', 'ASC')->get();
    }

    /**
     * Get paginated committees
     *
     * @param int $amount
     */
    public function paginate($amount)
    {
        return Committee::orderBy('name', 'ASC')->paginate($amount);
    }

    public function members($id)
    {
        return $this->byId($id)->members()->orderBy('start_date', 'DESC')->paginate(50);
    }

    /**
    * Create committee
    *
    * @param array $input
    * @return Committee
    */
    public function create(array $input)
    {
        $committee              = new Committee();
        $committee->name        = $input['name'];
        $committee->unique_name = $input['unique_name'];
        $committee->description = $input['description'];

        $committee->save();

        return $committee;
    }

    /**
    * Update committee
    *
    * @param int $id
    * @param array $input
    * @return Committee
    */
    public function update($id, array $input)
    {
        $committee              = $this->byId($id);

        $committee->name        = $input['name'];
        $committee->unique_name = $input['unique_name'];
        $committee->description = $input['description'];

        $committee->save();

        return $committee;
    }

    /**
    * Delete Committee
    *
    * @param int $id
    * @return Committe
    * @TODO: delete all committee members references
    */
    public function delete($id)
    {
        $committee = $this->byId($id);
        $committee->delete();

        return $committee;
    }
}