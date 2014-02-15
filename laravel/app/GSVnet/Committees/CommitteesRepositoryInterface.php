<?php namespace GSVnet\Committees;

interface CommitteesRepositoryInterface {
    public function byId($id);

    public function all();
    public function paginate($amount);
    public function members($id);

    public function create(array $input);
    public function update($id, array $input);
    public function delete($id);
}