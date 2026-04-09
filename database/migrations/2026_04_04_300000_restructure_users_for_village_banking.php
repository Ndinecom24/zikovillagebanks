<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Restructure users table for financial/village banking context.
 *
 * REMOVES (repurposed):
 *   - user_unit → replaced by company_name
 *   - directorate → replaced by company_location
 *
 * ADDS:
 *   Employment:   employment_status, company_name, company_location
 *   Address:      country, province, city, home_address
 *   Next of Kin:  nok_name, nok_contact, nok_relationship, nok_address
 *   Identity:     date_of_birth, gender, national_id
 */
class RestructureUsersForVillageBanking extends Migration
{
    public function up()
    {
        // -- Employment fields --
        if (!Schema::hasColumn('users', 'employment_status')) {
            DB::statement("ALTER TABLE users ADD COLUMN employment_status VARCHAR(50) NULL AFTER phone");
        }
        // Rename user_unit → company_name (keep column, just add new one)
        if (!Schema::hasColumn('users', 'company_name')) {
            DB::statement("ALTER TABLE users ADD COLUMN company_name VARCHAR(255) NULL AFTER employment_status");
        }
        if (!Schema::hasColumn('users', 'company_location')) {
            DB::statement("ALTER TABLE users ADD COLUMN company_location VARCHAR(255) NULL AFTER company_name");
        }

        // -- Identity fields --
        if (!Schema::hasColumn('users', 'date_of_birth')) {
            DB::statement("ALTER TABLE users ADD COLUMN date_of_birth DATE NULL AFTER company_location");
        }
        if (!Schema::hasColumn('users', 'gender')) {
            DB::statement("ALTER TABLE users ADD COLUMN gender VARCHAR(20) NULL AFTER date_of_birth");
        }
        if (!Schema::hasColumn('users', 'national_id')) {
            DB::statement("ALTER TABLE users ADD COLUMN national_id VARCHAR(50) NULL AFTER gender");
        }

        // -- Address fields --
        if (!Schema::hasColumn('users', 'country')) {
            DB::statement("ALTER TABLE users ADD COLUMN country VARCHAR(100) NULL AFTER national_id");
        }
        if (!Schema::hasColumn('users', 'province')) {
            DB::statement("ALTER TABLE users ADD COLUMN province VARCHAR(100) NULL AFTER country");
        }
        if (!Schema::hasColumn('users', 'city')) {
            DB::statement("ALTER TABLE users ADD COLUMN city VARCHAR(100) NULL AFTER province");
        }
        if (!Schema::hasColumn('users', 'home_address')) {
            DB::statement("ALTER TABLE users ADD COLUMN home_address TEXT NULL AFTER city");
        }

        // -- Next of Kin fields --
        if (!Schema::hasColumn('users', 'nok_name')) {
            DB::statement("ALTER TABLE users ADD COLUMN nok_name VARCHAR(255) NULL AFTER home_address");
        }
        if (!Schema::hasColumn('users', 'nok_relationship')) {
            DB::statement("ALTER TABLE users ADD COLUMN nok_relationship VARCHAR(100) NULL AFTER nok_name");
        }
        if (!Schema::hasColumn('users', 'nok_contact')) {
            DB::statement("ALTER TABLE users ADD COLUMN nok_contact VARCHAR(50) NULL AFTER nok_relationship");
        }
        if (!Schema::hasColumn('users', 'nok_address')) {
            DB::statement("ALTER TABLE users ADD COLUMN nok_address TEXT NULL AFTER nok_contact");
        }

        // Migrate old data if present:  user_unit → company_name, directorate → company_location
        DB::statement("UPDATE users SET company_name = user_unit WHERE user_unit IS NOT NULL AND user_unit != '' AND company_name IS NULL");
        DB::statement("UPDATE users SET company_location = directorate WHERE directorate IS NOT NULL AND directorate != '' AND company_location IS NULL");
    }

    public function down()
    {
        $columns = [
            'employment_status', 'company_name', 'company_location',
            'date_of_birth', 'gender', 'national_id',
            'country', 'province', 'city', 'home_address',
            'nok_name', 'nok_relationship', 'nok_contact', 'nok_address',
        ];

        foreach ($columns as $col) {
            if (Schema::hasColumn('users', $col)) {
                DB::statement("ALTER TABLE users DROP COLUMN {$col}");
            }
        }
    }
}
