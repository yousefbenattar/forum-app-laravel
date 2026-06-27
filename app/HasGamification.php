<?php

namespace App;

trait HasGamification
{
    public function addXp(int $amount)
    {
        $this->increment('xp', $amount);
        $this->checkLevelUp();
    }

    protected function checkLevelUp()
    {
        // Example formula: Level 2 needs 100 XP, Level 3 needs 200 XP, etc.
        // Or use a hardcoded lookup array/table
        $nextLevel = $this->level + 1;
        $xpNeeded = $nextLevel * 100; 

        if ($this->xp >= $xpNeeded) {
            $this->increment('level');
            
            // Fire an event to trigger announcements, popups, or log rewards
           // event(new \App\Events\UserLeveledUp($this, $this->level));
        }
    }
}