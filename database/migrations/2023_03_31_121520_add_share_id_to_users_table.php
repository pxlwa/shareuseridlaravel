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

};
