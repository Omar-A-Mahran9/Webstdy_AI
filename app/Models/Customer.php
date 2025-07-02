<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $appends = ['name', 'full_image_path'];
    protected $guarded = ["password_confirmation"];
    protected $casts   = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d', 'otp' => 'string'];

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
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function chields()
    {
        return $this->HasMany(Chield::class);
    }



    public function rates()
    {
        return $this->hasMany(Rate::class);
    }


    public function getNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function sendOTP(){
        $this->otp = rand(1111, 9999);
        $appName = setting("website_name") ?? "WebStdy";
        // $this->sendSMS("$appName: $this->otp هو رمز الحماية,لا تشارك الرمز");
        $this->save();
    }

    public function verfiedOTP($inputOtp){
        // Compare the input OTP with the stored OTP
        if ($this->otp == $inputOtp) {
            // OTP matches, verification successful
            $this->otp = null; // Set OTP to null
            $this->verified_at = now(); // Set verified_at to the current timestamp
            $this->save(); // Save the updated user object

            // Return success response using the same structure
            return true;

        } else {
            // OTP doesn't match
            return false;

        }
    }

    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'Customers', "default.svg"));
    }
}
