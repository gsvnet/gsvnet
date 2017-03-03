<?php namespace GSVnet\Users;

use GSVnet\BaseTransformer;

class YearGroupTransformer extends BaseTransformer
{
    public function transform(YearGroup $group)
    {
        return [
            'id' => $group->id,
            'name' => $group->name,
            'year' => $group->year
        ];
    }
}