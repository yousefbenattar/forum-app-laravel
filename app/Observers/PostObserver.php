<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\Activity;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        Activity::create([
            'user_id' => $post->user_id,
            'subject_id' => $post->id,
            'subject_type' => Post::class,
            'type' => 'posted'
        ]);
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        // Activity::where('subject_id', $post->id)
        //     ->where('subject_type', Post::class)
        //     ->update(['type' => 'updated']);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        // Activity::where('subject_id', $post->id)
        //     ->where('subject_type', Post::class)
        //     ->delete();
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        // Activity::create([
        //     'user_id' => $post->user_id,
        //     'subject_id' => $post->id,
        //     'subject_type' => Post::class,
        //     'type' => 'restored'
        // ]);
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        // Activity::where('subject_id', $post->id)
        //     ->where('subject_type', Post::class)
        //     ->delete();
    }
}
