<?php

namespace App\Helpers\Committees\CommitteeMembership;

use App\Helpers\Committees\Committee;
use App\Helpers\Users\User;

class CommitteeMembershipRepository
{
    /**
     * Get by id
     *
     * @param  int  $id
     * @return Committee
     */
    public function byId(int $id): Committee
    {
        return CommitteeMembership::findOrFail($id);
    }

    /**
     * Create committeeMembership
     *
     * @param  array  $input
     * @return Committee
     */
    public function create(User $user, Committee $committee, array $input): Committee
    {
        $committeeMembership = new CommitteeMembership;
        $committeeMembership->user_id = $user->id;
        $committeeMembership->committee_id = $committee->id;
        $committeeMembership->start_date = $input['start_date'];
        $committeeMembership->end_date = $input['end_date'];

        $committeeMembership->save();

        return $committeeMembership;
    }

    /**
     * Update committeeMembership
     *
     * @param  int  $id
     * @param  array  $input
     * @return Committee
     */
    public function update(int $id, array $input): Committee
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
     * @param  int  $id
     * @return Committe
     * @TODO: delete all committee members references
     */
    public function delete(int $id): Committe
    {
        $committeeMembership = $this->byId($id);
        $committeeMembership->delete();

        return $committeeMembership;
    }
}
