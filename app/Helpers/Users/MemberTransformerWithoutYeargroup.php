<?php namespace GSV\Helpers\Users;

use GSV\Helpers\BaseTransformer;
use GSV\Helpers\Users\ValueObjects\Gender;

class MemberTransformerWithoutYeargroup extends MemberTransformer
{
    protected $defaultIncludes = [];
}