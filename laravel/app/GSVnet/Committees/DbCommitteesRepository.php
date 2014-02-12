<?php namespace GSVnet\Committees;

use Model\Committee;

class DbCommitteesRepository implements CommitteesRepositoryInterface {


    /**
     * Get paginated committees
     *
     * @param int $amount
     */
    public function paginate($amount)
    {
        return Committee::orderBy('updated_at', 'DESC')->paginate($amount);
    }

    public function usersByCommitteIdAndPaginate($id, $amount)
    {
        return $this->byId($id)->users;
    }

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