<?php

namespace App\Events\Members;

use Carbon\Carbon;
use Illuminate\Queue\SerializesModels;

class MemberFileWasCreated
{
    use SerializesModels;

    private $at;

    private $filePath;

    public function __construct($filePath)
    {
        $this->at = Carbon::now();
        $this->filePath = $filePath;
    }

    public function getAt()
    {
        return $this->at;
    }

    public function getFilePath()
    {
        return $this->filePath;
    }
}
