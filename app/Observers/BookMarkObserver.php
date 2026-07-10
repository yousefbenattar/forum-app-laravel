<?php

namespace App\Observers;

use App\Models\BookMark;
use App\Models\Activity;

class BookMarkObserver
{
    /**
     * Handle the BookMark "created" event.
     */
    public function created(BookMark $bookmark): void
    {
        Activity::create([
            'user_id' => $bookmark->user_id,
            'subject_id' => $bookmark->id,
            'subject_type' => BookMark::class,
            'type' => 'bookmarked'

        ]);
    }

    public function updated(BookMark $bookmark): void
    {
        //
    }

    public function deleted(BookMark $bookmark): void
    {
       // Automatically wipe the activity if the post is deleted
        Activity::where('subject_id', $bookmark->id)
         ->where('subject_type', BookMark::class)
         ->delete();
    
    }

    /**
     * Handle the BookMark "restored" event.
     */
    public function restored(BookMark $bookmark): void
    {
        //
    }

    /**
     * Handle the BookMark "force deleted" event.
     */
    public function forceDeleted(BookMark $bookmark): void
    {
        //
    }
}
