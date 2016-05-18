<?php namespace GSVnet\Users;

use GSVnet\BaseTransformer;
use GSVnet\Users\ValueObjects\Gender;

class MemberTransformer extends BaseTransformer
{
    protected $defaultIncludes = ['yeargroup'];

    public function transform(User $member)
    {
        return [
            'id' => $member->id,
            'year_group_id' => $member->profile->year_group_id,
            'firstname' => $member->firstname,
            'middlename' => $member->middlename,
            'lastname' => $member->lastname,
            'email' => $member->email,
            'verified' => $member->isVerified(),
            'region' => $member->profile->region,
            'initials' => $member->profile->initials,
            'phone' => $member->profile->phone,
            'address' => $member->profile->address,
            'zip_code' => $member->profile->zip_code,
            'town' => $member->profile->town,
            'study' => $member->profile->study,
            'country' => $member->profile->country,
            'birthdate' => $member->profile->birthdate,
            'gender' => $member->profile->gender === Gender::UNKOWN ? null : ($member->profile->gender == Gender::MALE ? 'male' : 'female'),
            'student_number' => $member->profile->student_number,
            'reunist' => (bool) $member->profile->reunist,
            'inauguration_date' => $member->profile->inauguration_date,
            'resignation_date' => $member->profile->resignation_date,
            'company' => $member->profile->company,
            'profession' => $member->profile->profession,
            'business_url' => $member->profile->business_url,
            'alive' => (bool) $member->profile->alive,
        ];
    }

    public function includeYearGroup(User $member)
    {
        $group = $member->profile->yearGroup;
        
        return $this->item($group, new YearGroupTransformer);
    }
}