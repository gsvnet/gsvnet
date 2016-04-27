<?php namespace GSVnet\Users;

use GSVnet\BaseTransformer;

class MemberTransformer extends BaseTransformer
{
    protected $availableIncludes = ['yeargroup'];

    public function transform(User $member)
    {
        return [
            'id' => $member->id,
            'year_group_id' => $member->profile->year_group_id,
            'firstname' => $member->firstname,
            'middlename' => $member->middlename,
            'lastname' => $member->lastname,
            'email' => $member->email,
            'region' => $member->profile->region,
            'initials' => $member->profile->initials,
            'phone' => $member->profile->phone,
            'address' => $member->profile->address,
            'zip_code' => $member->profile->zip_code,
            'town' => $member->profile->town,
            'study' => $member->profile->study,
            'country' => $member->profile->country,
            'birthdate' => $member->profile->birthdate,
            'church' => $member->profile->church,
            'gender' => $member->profile->gender,
            'student_number' => $member->profile->student_number,
            'reunist' => $member->profile->reunist,
            'parent_address' => $member->profile->parent_address,
            'parent_zip_code' => $member->profile->parent_zip_code,
            'parent_town' => $member->profile->parent_town,
            'parent_phone' => $member->profile->parent_phone,
            'photo_path' => $member->profile->photo_path,
            'inauguration_date' => $member->profile->inauguration_date,
            'resignation_date' => $member->profile->resignation_date,
            'company' => $member->profile->company,
            'profession' => $member->profile->profession,
            'business_url' => $member->profile->business_url,
        ];
    }

    public function includeYearGroup(User $member)
    {
        $group = $member->profile->yearGroup;
        
        return $this->item($group, new YearGroupTransformer);
    }
}