<?php namespace App\Helpers\Users;

use App\Helpers\BaseTransformer;
use App\Helpers\Users\ValueObjects\Gender;

class MemberTransformerWithoutYeargroup extends MemberTransformer
{
    protected $defaultIncludes = [];
}