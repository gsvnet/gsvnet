<?php

namespace App\Helpers\Senates;

class SenatesRepository
{
    /**
     * Get by id
     */
    public function byId(int $id): Senate
    {
        return Senate::findOrFail($id);
    }

    /**
     * Get all senates
     */
    public function all(): Collection
    {
        return Senate::orderBy('start_date', 'DESC')->get();
    }

    /**
     * Get paginated senates
     */
    public function paginate(int $amount)
    {
        return Senate::with('members')->orderBy('updated_at', 'DESC')->paginate($amount);
    }

    public function members($id)
    {
        return $this->byId($id)->members;
    }

    /**
     * Create senate
     */
    public function create(array $input): Senate
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
     */
    public function update(int $id, array $input): Senate
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
     * @TODO: delete all senate members references
     */
    public function delete(int $id): Senate
    {
        $senate = $this->byId($id);
        $senate->delete();

        return $senate;
    }
}
