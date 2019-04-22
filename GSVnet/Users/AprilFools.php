<?php

namespace GSVnet\Users;

use Illuminate\Database\Eloquent\Model;
use GSVnet\Users\User;

class AprilFools extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'april_fools';

    /**
     * Fillable fields
     * @var array
     */
    protected $guarded = [];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNameColor()
    {
        $credits = $this->credits_earned;
        if($credits >= 500) return "#910202"; // Dark red
        if($credits >= 400) return "#ce0404"; // Red
        if($credits >= 375) return "#f27171"; // Light red
        if($credits >= 350) return "#152c8c"; // Dark blue
        if($credits >= 325) return "#405ed6"; // Blue
        if($credits >= 300) return "#8ee4f9"; // Light blue
        if($credits >= 275) return "#ad0569"; // Dark pink
        if($credits >= 250) return "#f95cba"; // Pink
        if($credits >= 225) return "#ffafdf"; // Light pink
        if($credits >= 200) return "#c47b0d"; // Dark orange
        if($credits >= 175) return "#efa028"; // Orange
        if($credits >= 150) return "#f2ca8e"; // Light orange
        if($credits >= 125) return "#d5d811"; // Dark yellow
        if($credits >= 100) return "#f1f43f"; // Yellow
        if($credits >= 75) return "#f2f475"; // Light yellow
        if($credits >= 50) return "#24771f"; // Dark green
        if($credits >= 25) return "#35a82d"; // Green
        if($credits >= 10) return "#4ef442"; // Light green
        return $this;
    }

    public function getProfileBackground() {
        if($this->profile_background) return $this->profile_background;
        return "#FFF";
    }

    public function getProfileText() {
        if($this->profile_text) return $this->profile_text;
        return "#444";
    }

    public function creditBalance()
    {
        return $this->credits_earned - $this->credits_spent;
    }

    public function receiveLike()
    {
        $this->credits_earned += 5;
        $this->save();
    }

    public function removeLike()
    {
        $this->credits_earned -= 5;
        $this->save();
    }

    public function visitThread()
    {
        $this->credits_earned += 1;
        $this->save();
    }

    // Keeping rewards for posting low in a futile attempt to prevent spamming
    // N.b.: you also get the visitThread reward for creating a thread.
    public function createThread()
    {
        $this->credits_earned += 2;
        $this->save();
    }

    // Keeping rewards for posting low in a futile attempt to prevent spamming
    public function postReply()
    {
        $this->credits_earned += 2;
        $this->save();
    }

    public function purchaseBundle($id)
    {
        $bundles = [5,10,15];
        $this->donator = true;
        $this->credits_earned += $bundles[$id];
        $this->save();
    }

    public function spendOnBgColor($color)
    {
        if($this->creditBalance() < 10) {
            return;
        }
        
        $this->profile_background = $color;
        $this->credits_spent += 10;
        $this->save();
    }

    public function spendOnTextColor($color)
    {
        if($this->creditBalance() < 10) {
            return;
        }
        
        $this->profile_text = $color;
        $this->credits_spent += 10;
        $this->save();
    }

    public function spendOnSpecialMenu()
    {
        if($this->creditBalance() < 50) {
            return;
        }

        $this->special_menu = true;
        $this->credits_spent += 50;
        $this->save();
    }
}
