<?php namespace GSVnet\Committees;

interface CommitteesRepositoryInterface {
    public function byId($id);
    public function paginate($amount);
    public function usersByCommitteIdAndPaginate($id, $amount);

    public function create(array $input);
    public function update($id, array $input);
    public function delete($id);
}