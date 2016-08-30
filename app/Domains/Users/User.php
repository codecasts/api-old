<?php

namespace Codecasts\Domains\Users;

use Carbon\Carbon;
use Codecasts\Domains\Suggestions\Suggestion;
use Codecasts\Domains\Users\Contracts\SocialParser;
use Codecasts\Support\Subscription\SubscriptionTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SubscriptionTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'avatar',
        'url',
        'location',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param int $size
     *
     * @return string
     */
    public function getAvatarUrl($size = 30)
    {
        $size_query = '?s='.$size;

        if (isset($this->attributes['avatar'])) {
            $avatar = $this->attributes['avatar'];

            if (str_contains($avatar, '?')) {
                $size_query = '&s='.$size;
            }

            return $avatar.$size_query;
        }

        return '//www.gravatar.com/avatar/'.md5($this->email).$size_query.'&d=identicon';
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return (bool) $this->admin;
    }

    public function suggestions()
    {
        return $this->hasMany(Suggestion::class, 'user_id');
    }

    public function suggestionsVotes()
    {
        return $this->belongsToMany(Suggestion::class, 'suggestions_votes', 'user_id', 'suggestion_id');
    }

    public static function usernameAvailable($username)
    {
        $user = self::where('username', $username)->first();

        if ($user) {
            return false;
        }

        return true;
    }

    public function fillSocialData(SocialParser $parser)
    {
        if (!$this->exists) {
            $this->name = $parser->getName();
            $this->username = $parser->getUsername();
            $this->email = $parser->getEmail();
        }

        $this->avatar = $parser->getAvatar();
    }

    public function presentGuestUntil()
    {
        $dt = Carbon::createFromFormat('Y-m-d', $this->guest_until);

        return $dt->format('d/m/Y');
    }
}
