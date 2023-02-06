<?php namespace App\Helpers\Users;

use App\Helpers\BaseTransformer;

class YearGroupTransformer extends BaseTransformer
{
    public function transform(YearGroup $group = null)
    {
        if ($group) {
            return [
                'id' => $group->id,
                'name' => $group->name,
                'year' => $group->year
            ];
        }

        return ['id' => 0, 'name' => 'onbekend', 'year' => 0];
    }
}