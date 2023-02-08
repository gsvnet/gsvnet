<?php

namespace App\Helpers\Committees\CommitteeMembership;

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;

class CommitteeMembershipPresenter extends Presenter
{
    public function startSanitized()
    {
        $start = Carbon::createFromFormat('Y-m-d H:i:s', $this->start_date);

        return $start->format('Y-m-d');
    }

    public function endSanitized()
    {
        if (! $this->end_date) {
            return '';
        }

        $end = Carbon::createFromFormat('Y-m-d H:i:s', $this->end_date);

        return $end->format('Y-m-d');
    }
}
