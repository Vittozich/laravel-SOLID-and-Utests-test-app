<?php
namespace App\Models\Traits;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

trait LikeabilityTrait
{

    public function like()
    {
        $like = new Like(['user_id' => Auth::id()]);
        $this->likes()->save($like);
    }

    public function unlike()
    {
        $this->likes()->where('user_id', Auth::id())->delete();
    }

    public function toggle()
    {
        if ($this->isLiked()){
            return $this->unlike();
        }
        return $this->like();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function isLiked()
    {
        return $this->likes()->where('user_id', Auth::id())->exists();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}
