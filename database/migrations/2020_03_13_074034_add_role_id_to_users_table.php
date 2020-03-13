<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     * Do not modify migration due to SQLite bug
     * that prevents adding a non-null column to a
     * database that doesn't have a default value.
     * SQLite is the testing database.
     *
     * @see https://laracasts.com/discuss/channels/general-discussion/migrations-sqlite-general-error-1-cannot-add-a-not-null-column-with-default-value-null
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id')->after('id')->nullable(); // make role id nullable
            });

            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id')->nullable(false)->change(); // modify the column to not be nullable
                $table->foreign('role_id')->references('id')->on('roles'); // add foreign key constraints
            });
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
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
}
