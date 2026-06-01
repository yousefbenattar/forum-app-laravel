<?php

namespace App\Observers;

use App\Models\Bookmark;
use App\Models\Activity;

class BookMarkObserver
{
    /**
     * Handle the BookMark "created" event.
     */
    public function created(Bookmark $bookmark): void
    {
        Activity::create([
            'user_id' => $bookmark->user_id,
            'subject_id' => $bookmark->id,
            'subject_type' => Bookmark::class,
        ]);
    }

    public function updated(Bookmark $bookmark): void
    {
        //
    }

    public function deleted(Bookmark $bookmark): void
    {
       // Automatically wipe the activity if the post is deleted
        Activity::where('subject_id', $bookmark->id)
         ->where('subject_type', Bookmark::class)
         ->delete();
    
    }

    /**
     * Handle the BookMark "restored" event.
     */
    public function restored(Bookmark $bookmark): void
    {
        //
    }

    /**
     * Handle the BookMark "force deleted" event.
     */
    public function forceDeleted(Bookmark $bookmark): void
    {
        //
    }
}
