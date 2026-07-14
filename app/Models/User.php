<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Post;
use App\HasGamification;
use App\Models\Comment;
use Laravel\Ai\Concerns\HasConversations; // Add this line
use Illuminate\Notifications\Messages\MailMessage;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasConversations, HasRoles, HasGamification;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new class extends \Illuminate\Auth\Notifications\VerifyEmail {
            public function toMail($notifiable)
            {
                $verificationUrl = $this->verificationUrl($notifiable);

                return (new MailMessage)
                    ->subject('تأكيد البريد الإلكتروني - التاريخ البديل')
                    ->greeting('مرحباً ' . $notifiable->name . '!')
                    ->line('شكرًا لتسجيلك في موقعنا. يرجى الضغط على الزر أدناه لتفعيل حسابك وتأكيد بريدك الإلكتروني.')
                    ->action('تأكيد الحساب', $verificationUrl)
                    ->line('إذا لم تقم بإنشاء حساب، فلا داعي لاتخاذ أي إجراء آخر.')
                    ->salutation('أطيب التحيات،' . "\n" . config('app.name'));
            }
        });
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar',
        'bio'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function hasLiked(Post $post)
    {
        return $this->likes()->where('post_id', $post->id)->exists();
    }
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')->withTimestamps();
    }
    public function follower()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')->withTimestamps();
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function bookmarkedPosts()
    {
        return $this->belongsToMany(Post::class, 'bookmarks', 'user_id', 'post_id');
    }
    public function conversation()
    {
        return $this->hasMany(Conversation::class, 'sender_id')->orWhere('receiver_id', $this->id);
    }
    public function reports(){
        return $this->hasMany(Report::class);
    }
}
