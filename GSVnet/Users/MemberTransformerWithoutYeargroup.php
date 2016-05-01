<?php namespace GSVnet\Users;

use GSVnet\BaseTransformer;
use GSVnet\Users\ValueObjects\Gender;

class MemberTransformerWithoutYeargroup extends MemberTransformer
{
    protected $defaultIncludes = [];
}