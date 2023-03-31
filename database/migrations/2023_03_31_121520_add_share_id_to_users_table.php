<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('share_id')->unique()->nullable();
    });
    Schema::create('share_id_users', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('share_id')->unique();
        $table->timestamps();
    });
    
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('share_id');
    });
}

public function register(Request $request)
{
    // validasi form
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // membuat user baru
    $user = new User([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'share_id' => Str::random(10), // menghasilkan string random 10 karakter sebagai share_id
    ]);
    $user->save();

    // redirect ke halaman dashboard
    return redirect('/dashboard');
}

public function scopeByShareId($query, $share_id)
{
    return $query->where('share_id', $share_id);
}
public function shareIds()
{
    return $this->hasMany(ShareIdUser::class);
}

public static function generateShareId()
{
    do {
        $shareId = Str::random(10);
    } while (self::where('share_id', $shareId)->exists());

    return $shareId;
}

public function createShareId()
{
    $user = auth()->user();

    $shareId = ShareIdUser::generateShareId();

    $user->shareIds()->create([
        'share_id' => $shareId,
    ]);

    return $shareId;
}


};
