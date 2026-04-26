<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Restructure users table for financial/village banking context.
 */
class RestructureUsersForVillageBanking extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // -- Employment fields --
            if (!Schema::hasColumn('users', 'employment_status')) {
                $table->string('employment_status', 50)->nullable();
            }
            if (!Schema::hasColumn('users', 'company_name')) {
                $table->string('company_name')->nullable();
            }
            if (!Schema::hasColumn('users', 'company_location')) {
                $table->string('company_location')->nullable();
            }

            // -- Identity fields --
            if (!Schema::hasColumn('users', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable();
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender', 20)->nullable();
            }
            if (!Schema::hasColumn('users', 'national_id')) {
                $table->string('national_id', 50)->nullable();
            }

            // -- Address fields --
            if (!Schema::hasColumn('users', 'country')) {
                $table->string('country', 100)->nullable();
            }
            if (!Schema::hasColumn('users', 'province')) {
                $table->string('province', 100)->nullable();
            }
            if (!Schema::hasColumn('users', 'city')) {
                $table->string('city', 100)->nullable();
            }
            if (!Schema::hasColumn('users', 'home_address')) {
                $table->text('home_address')->nullable();
            }

            // -- Next of Kin fields --
            if (!Schema::hasColumn('users', 'nok_name')) {
                $table->string('nok_name')->nullable();
            }
            if (!Schema::hasColumn('users', 'nok_relationship')) {
                $table->string('nok_relationship', 100)->nullable();
            }
            if (!Schema::hasColumn('users', 'nok_contact')) {
                $table->string('nok_contact', 50)->nullable();
            }
            if (!Schema::hasColumn('users', 'nok_address')) {
                $table->text('nok_address')->nullable();
            }
        });

        // Migrate old data if present
        if (Schema::hasColumn('users', 'user_unit')) {
            DB::table('users')
                ->whereNotNull('user_unit')->where('user_unit', '!=', '')
                ->whereNull('company_name')
                ->update(['company_name' => DB::raw('user_unit')]);
        }
        if (Schema::hasColumn('users', 'directorate')) {
            DB::table('users')
                ->whereNotNull('directorate')->where('directorate', '!=', '')
                ->whereNull('company_location')
                ->update(['company_location' => DB::raw('directorate')]);
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'employment_status', 'company_name', 'company_location',
                'date_of_birth', 'gender', 'national_id',
                'country', 'province', 'city', 'home_address',
                'nok_name', 'nok_relationship', 'nok_contact', 'nok_address',
            ];

            $existing = array_filter($columns, fn ($col) => Schema::hasColumn('users', $col));
            if (!empty($existing)) {
                $table->dropColumn($existing);
            }
        });
    }
}
