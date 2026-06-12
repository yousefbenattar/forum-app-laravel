<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Activity;
use App\Notifications\NewCommentNotification;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        Activity::create([
            'user_id' => $comment->user_id,
            'subject_id' => $comment->id,
            'subject_type' => Comment::class,
            'type' => 'commented'
        ]);
        // Get the author of the post being commented on
        $postOwner = $comment->post->user;

        // Optional: Avoid notifying yourself if you comment on your own post
        if ($postOwner->id !== $comment->user_id) {
            $postOwner->notify(new NewCommentNotification($comment));
        }
    }

    /**
     * Handle the Comment "updated" event.
     */
    public function updated(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "deleted" event.
     */
    public function deleted(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "restored" event.
     */
    public function restored(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     */
    public function forceDeleted(Comment $comment): void
    {
        //
    }
}
