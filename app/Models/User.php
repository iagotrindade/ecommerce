<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Laravel\Sanctum\HasApiTokens;
use App\Models\PermissionGroups;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ResetPasswordNotification;
use App\Models\PasswordResetTokens;
use App\Models\Favorite;
use App\Models\Adresses;
use App\Models\Orders;

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
        'image_id',
        'username',
        'cpf',
        'customer_id',
        'phone',
        'permission_id',
        'email',
        'status',
        'password',
        'login_hash',
        'expiration_time'
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
        'password' => 'hashed',
    ];

    public function sendPasswordResetNotification($token): void
     {
        $url = url('/change_password?token='.$token);

        $resetList = PasswordResetToken::all();

        foreach ($resetList as $data) {
            if(Hash::check($token, $data->token)) {
                $user = User::where('email', $data->email)->first();
            }
        }

        $this->notify(new ResetPasswordNotification($url, $user->name));
     }

    public function getImage() {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function permission() {
        return $this->hasOne(PermissionGroups::class, 'id', 'permission_id');
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function address()
    {
        return $this->hasMany(Adresses::class, 'user_id');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'user_id');
    }
}
