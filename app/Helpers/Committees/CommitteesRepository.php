<?php

namespace App\Helpers\Committees;

use App\Helpers\Users\User;

class CommitteesRepository
{
    /**
     * Get by id
     */
    public function byId(int $id): Committee
    {
        return Committee::findOrFail($id);
    }

    /**
     * Get by slug
     */
    public function bySlug(string $slug): Committee
    {
        return Committee::where('unique_name', '=', $slug)->firstOrFail();
    }

    public function byUserOrderByRecent(User $user)
    {
        return $user->committees()->orderBy(\DB::raw('end_date IS NULL'), 'desc')->orderBy('end_date', 'DESC')->get();
    }

    /**
     * Get all committees
     */
    public function all(): Collection
    {
        return Committee::orderBy('name', 'ASC')->public()->get();
    }

    /**
     * Get paginated committees
     */
    public function paginate(int $amount)
    {
        return Committee::orderBy('name', 'ASC')->paginate($amount);
    }

    public function members($id)
    {
        return $this->byId($id)->members()->orderBy('start_date', 'DESC')->paginate(50);
    }

    /**
     * Create committee
     */
    public function create(array $input): Committee
    {
        $committee = new Committee();
        $committee->name = $input['name'];
        $committee->unique_name = $input['unique_name'];
        $committee->description = $input['description'];
        $committee->public = $input['public'];

        $committee->save();

        return $committee;
    }

    /**
     * Update committee
     */
    public function update(int $id, array $input): Committee
    {
        $committee = $this->byId($id);

        $committee->name = $input['name'];
        $committee->unique_name = $input['unique_name'];
        $committee->description = $input['description'];
        $committee->public = $input['public'];

        $committee->save();

        return $committee;
    }

    /**
     * Delete Committee
     *
     * @TODO: delete all committee members references
     */
    public function delete(int $id): Committe
    {
        $committee = $this->byId($id);
        $committee->delete();

        return $committee;
    }
}
