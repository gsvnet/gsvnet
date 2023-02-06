<?php namespace GSV\Helpers\Users;

use GSV\Helpers\BaseTransformer;
use GSV\Helpers\Users\ValueObjects\Gender;

class MemberTransformer extends BaseTransformer
{
    protected $defaultIncludes = ['yeargroup'];

    public function transform(User $member)
    {
        return [
            'id' => $member->id,
            'year_group_id' => $member->profile->year_group_id,
            'fullname' => $member->present()->fullName(),
            'firstname' => $member->firstname,
            'middlename' => $member->middlename,
            'lastname' => $member->lastname,
            'email' => $member->email,
            'verified' => $member->isVerified(),
            'region' => $member->profile->present()->regionName,
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
            'reunist' => (bool) $member->isReunist(),
            'inauguration_date' => $member->profile->inauguration_date,
            'resignation_date' => $member->profile->resignation_date,
            'company' => $member->profile->company,
            'profession' => $member->profile->profession,
            'business_url' => $member->profile->business_url,
            'alive' => (bool) $member->profile->alive,
            'receive_newspaper' => (bool) $member->profile->receive_newspaper,
        ];
    }

    public function includeYearGroup(User $member)
    {
        $group = $member->profile->yearGroup;
        
        return $this->item($group, new YearGroupTransformer);
    }
}