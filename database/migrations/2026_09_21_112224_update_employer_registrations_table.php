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
    Schema::table('employer_registrations', function (Blueprint $table) {
        $table->string('contact_number', 20)->nullable()->after('website');
        $table->renameColumn('company_documents', 'company_registered_certificate');
    });
}

public function down()
{
    Schema::table('employer_registrations', function (Blueprint $table) {
        $table->dropColumn('contact_number');
        $table->renameColumn('company_registered_certificate', 'company_documents');
    });
}
};
