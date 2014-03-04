<?php namespace GSVnet\Senates;

class SenatesRepository {

    /**
     * Get by id
     *
     * @param int $id
     * @return Senate
     */
    public function byId($id)
    {
        return Senate::findOrFail($id);
    }

    /**
    * Get all senates
    *
    * @return Collection
    */
    public function all()
    {
        return Senate::orderBy('start_date', 'DESC')->get();
    }

    /**
     * Get paginated senates
     *
     * @param int $amount
     */
    public function paginate($amount)
    {
        return Senate::orderBy('updated_at', 'DESC')->paginate($amount);
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
        $committee->body        = $input['description'];

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
        $senate              = $this->byId($id);

        $senate->name        = $input['name'];
        $senate->body        = $input['body'];

        $senate->save();

        if (isset($input['members']))
        {
            $senate->members()->sync($input['members']);
        }
        else
        {
            $senate->members()->sync(array());
        }

        return $senate;
    }

    /**
    * Delete Senate
    *
    * @param int $id
    * @return Senate
    * @TODO: delete all senate members references
    */
    public function delete($id)
    {
        $senate = $this->byId($id);
        $senate->delete();

        return $senate;
    }
}