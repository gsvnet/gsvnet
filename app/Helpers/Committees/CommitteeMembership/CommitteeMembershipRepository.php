<?php namespace GSV\Helpers\Committees\CommitteeMembership;

use GSV\Helpers\Users\User;
use GSV\Helpers\Committees\Committee;

class CommitteeMembershipRepository {

    /**
     * Get by id
     *
     * @param int $id
     * @return Committee
     */
    public function byId($id)
    {
        return CommitteeMembership::findOrFail($id);
    }

    /**
    * Create committeeMembership
    *
    * @param array $input
    * @return Committee
    */
    public function create(User $user, Committee $committee, $input)
    {
        $committeeMembership = new CommitteeMembership;
        $committeeMembership->user_id  = $user->id;
        $committeeMembership->committee_id = $committee->id;
        $committeeMembership->start_date = $input['start_date'];
        $committeeMembership->end_date = $input['end_date'];

        $committeeMembership->save();

        return $committeeMembership;
    }

    /**
    * Update committeeMembership
    *
    * @param int $id
    * @param array $input
    * @return Committee
    */
    public function update($id, array $input)
    {
        $committeeMembership = $this->byId($id);

        $committeeMembership->start_date = $input['start_date'];
        $committeeMembership->end_date = $input['end_date'];

        $committeeMembership->save();

        return $committeeMembership;
    }

    /**
    * Delete committeeMembership
    *
    * @param int $id
    * @return Committe
    * @TODO: delete all committee members references
    */
    public function delete($id)
    {
        $committeeMembership = $this->byId($id);
        $committeeMembership->delete();

        return $committeeMembership;
    }
}