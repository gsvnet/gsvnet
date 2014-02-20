<?php namespace GSVnet\Committees;

class CommitteesRepository {

    /**
     * Get by slug
     *
     * @param int $id
     * @return Album
     */
    public function byId($id)
    {
        return Committee::findOrFail($id);
    }

    /**
    * Get all committees
    *
    * @return Collection
    */
    public function all()
    {
        return Committee::orderBy('updated_at', 'DESC')->get();
    }

    /**
     * Get paginated committees
     *
     * @param int $amount
     */
    public function paginate($amount)
    {
        return Committee::orderBy('updated_at', 'DESC')->paginate($amount);
    }

    public function members($id)
    {
        return $this->byId($id)->members;
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
        $committee->description = $input['description'];

        $committee->save();

        if (isset($input['members']))
        {
            $committee->members()->sync($input['members']);
        }
        else
        {
            $committee->members()->sync(array());
        }

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