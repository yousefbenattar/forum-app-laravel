<?php

namespace App\Observers;

use App\Models\Like;
use App\Models\Activity;

class LikeObserver
{
    /**
     * Handle the Like "created" event.
     */
    public function created(Like $like): void
    {
        Activity::create([
            'user_id' => $like->user_id,
            'subject_id' => $like->id,
            'subject_type' => Like::class,
            'type' => 'liked'
        ]);
    }

    /**
     * Handle the Like "updated" event.
     */
    public function updated(Like $like): void
    {
        //
    }

    /**
     * Handle the Like "deleted" event.
     */
    public function deleted(Like $like): void
    {
        // Activity::where('subject_id', $like->id)->where('subject_type',Like::class)->delete();
    }

    /**
     * Handle the Like "restored" event.
     */
    public function restored(Like $like): void
    {
        //
    }

    /**
     * Handle the Like "force deleted" event.
     */
    public function forceDeleted(Like $like): void
    {
        //
    }
}
