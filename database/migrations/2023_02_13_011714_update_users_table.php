<?php

use App\Models\Orbat\Company;
use App\Models\Orbat\Fireteam;
use App\Models\Orbat\Platoon;
use App\Models\Orbat\Squad;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(Company::class)
                ->nullable()
                ->default(null)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Platoon::class)
                ->nullable()
                ->default(null)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Squad::class)
                ->nullable()
                ->default(null)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Fireteam::class)
                ->nullable()
                ->default(null)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
