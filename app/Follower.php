<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
/* أنا الان في جدول متابعين وسجلت بأني انتمي لجدول المستخدمين اذا يمكني اربط بينهم بسهولة تامة وابحث عن العمود الذي 
اشتية سوى كان في مستخدمين او المتابعين  */

    public function from_user()
    {
        return $this->belongsTo(User::class,'from_user_id');
    }

    public function to_user()
    {
        return $this->belongsTo(User::class,'to_user_id');
    }
}
