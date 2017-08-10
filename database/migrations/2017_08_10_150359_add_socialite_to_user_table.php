<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialiteToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('register_source')->nullable()->after('remember_token');
            $table->integer('github_id')->nullable()->index()->after('register_source');
            $table->string('github_url')->nullable()->index()->after('github_id');
            $table->string('wechat_openid')->nullable()->index()->after('github_url');
            $table->string('wechat_unionid')->nullable()->index()->after('wechat_openid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('register_source');
            $table->dropColumn('github_id');
            $table->dropColumn('github_url');
            $table->dropColumn('wechat_openid');
            $table->dropColumn('wechat_unionid');
        });
    }
}
