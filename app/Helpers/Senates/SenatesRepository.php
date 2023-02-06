<?php

namespace App\Helpers\Senates;

class SenatesRepository
{
    /**
     * Get by id
     *
     * @param  int  $id
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
     * @param  int  $amount
     */
    public function paginate($amount)
    {
        return Senate::with('members')->orderBy('updated_at', 'DESC')->paginate($amount);
    }

    public function members($id)
    {
        return $this->byId($id)->members;
    }

    /**
     * Create senate
     *
     * @param  array  $input
     * @return Senate
     */
    public function create(array $input)
    {
        $senate = new Senate();
        $senate->name = $input['name'];
        $senate->body = $input['body'];
        $senate->start_date = $input['start_date'];
        $senate->end_date = $input['end_date'];

        $senate->save();

        return $senate;
    }

    /**
     * Update committee
     *
     * @param  int  $id
     * @param  array  $input
     * @return Senate
     */
    public function update($id, array $input)
    {
        $senate = $this->byId($id);

        $senate->name = $input['name'];
        $senate->body = $input['body'];
        $senate->start_date = $input['start_date'];
        $senate->end_date = $input['end_date'];

        $senate->save();

        if (isset($input['members'])) {
            $senate->members()->sync($input['members']);
        }

        return $senate;
    }

    /**
     * Delete Senate
     *
     * @param  int  $id
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
