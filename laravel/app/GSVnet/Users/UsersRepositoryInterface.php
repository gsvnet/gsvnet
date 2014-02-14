<?php namespace GSVnet\Users;

interface UsersRepositoryInterface {
    public function byId($id);
    public function search($search);

    public function all();
    public function paginate($amount);

    public function create(array $input);
    public function update($id, array $input);
    public function delete($id);
}