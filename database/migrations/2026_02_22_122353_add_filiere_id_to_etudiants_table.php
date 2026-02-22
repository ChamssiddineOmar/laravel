<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('etudiants', function (Blueprint $table) {
        // On ajoute la colonne filiere_id (nullable au cas où tu as déjà des étudiants sans filière)
        $table->foreignId('filiere_id')->nullable()->constrained('filieres')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('etudiants', function (Blueprint $table) {
        $table->dropForeign(['filiere_id']);
        $table->dropColumn('filiere_id');
    });
}
};
