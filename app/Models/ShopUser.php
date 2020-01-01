<?php

namespace App\Models;

use App\Models\ShopEmailTemplate;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ShopUser extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'shop_user';
    protected $guarded = [];
    private static $getList = null;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $appends = [
        'name',
    ];
    public function orders()
    {
        return $this->hasMany(ShopOrder::class, 'user_id', 'id');
    }

    public static function getList()
    {
        if (self::$getList == null) {
            self::$getList = self::get()->keyBy('id');
        }
        return self::$getList;
    }

    /**
     * Send email reset password
     * @param  [type] $token [description]
     * @return [type]        [description]
     */
    public function sendPasswordResetNotification($token)
    {
        $checkContent = (new ShopEmailTemplate)->where('group', 'forgot_password')->where('status', 1)->first();
        if ($checkContent) {
            $content = $checkContent->text;
            $dataFind = [
                '/\{\{\$title\}\}/',
                '/\{\{\$reason_sednmail\}\}/',
                '/\{\{\$note_sendmail\}\}/',
                '/\{\{\$note_access_link\}\}/',
                '/\{\{\$reset_link\}\}/',
                '/\{\{\$reset_button\}\}/',
            ];
            $dataReplace = [
                trans('email.forgot_password.title'),
                trans('email.forgot_password.reason_sednmail'),
                trans('email.forgot_password.note_sendmail', ['site_admin' => config('mail.from.name')]),
                trans('email.forgot_password.note_access_link', ['reset_button' => trans('email.forgot_password.reset_button')]),
                route('password.reset', ['token' => $token]),
                trans('email.forgot_password.reset_button'),
            ];
            $content = preg_replace($dataFind, $dataReplace, $content);
            $data = [
                'content' => $content,
            ];

            $config = [
                'to' => $this->getEmailForPasswordReset(),
                'subject' => trans('email.forgot_password.reset_button'),
            ];

            sc_send_mail('mail.forgot_password', $data, $config, []);
        }

    }

    /*
    Full name
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;

    }

/**
 * Update info customer
 * @param  [array] $dataUpdate
 * @param  [int] $id
 */
    public static function updateInfo($dataUpdate, $id)
    {
        $dataUpdate = sc_clean($dataUpdate, 'password');
        $obj = self::find($id);
        return $obj->update($dataUpdate);
    }

/**
 * Create new customer
 * @return [type] [description]
 */
    public static function createCustomer($dataInsert)
    {
        $dataUpdate = sc_clean($dataInsert, 'password');
        return self::create($dataUpdate);
    }
}
