<?php

namespace App\Observers;

use App\Models\News;
use App\Models\AdminLog;
class NewsObserver
{
    public function created(News $news): void
    {
        AdminLog::create([
            'user_id' => $news->user_id,
            'target_id' => $news->id,
            'target_type' => News::class,
            'action' => 'نشر خبر جديد: ' . $news->title,
            'reason' => 'لم يتم إضافة سبب',
        ]);
    }
}
