
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keanggotaan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mahasiswa_id')
                ->constrained('mahasiswa')
                ->cascadeOnDelete();

            $table->foreignId('ukm_id')
                ->constrained('ukm')
                ->cascadeOnDelete();

            $table->string('jabatan');
            $table->date('bergabung_pada');

            $table->timestamps();

            $table->unique(['mahasiswa_id', 'ukm_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keanggotaan');
    }
};
