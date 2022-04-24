<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
        'provider_id',
        'provider_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //自分のuser_idのpostを抽出（1対多）
    public function myposts()
    {
        return $this->hasMany(Post::class)->orderBy('updated_at', 'desc');
    }

    //$user->posts（多対多）
    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    //$user->profile（1対1）
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    //$user->book（1対1）
    public function book()
    {
        return $this->hasOne(Book::class);
    }

    //$user->comments（1対多）
    public function comments()
    {
        return $this->hasMany(Commment::class);
    }

    //$user->pictures（1対多）
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    //$user->logs（1対多）
    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    //$user->buddies
    public function buddies()
    {
        return $this->hasMany(Buddy::class);
    }

    //自分のuser_idのLogを抽出（1対多）
    public function mylogs()
    {
        return $this->hasMany(Log::class)->orderBy('date', 'desc');
    }


    //----3/24 livewire 移行----------------------------------------------
    //自分のuser_idのBookを抽出（1対多）
    // public function mybooks()
    // {
    //     return $this->hasMany(Book::class)->orderBy('fish_name', 'desc');
    // }

}
