<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContaPlataformasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conta_plataformas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conta_id')->unsigned()->nullable();
            $table->bigInteger('plataforma_id')->unsigned()->nullable();
            $table->foreign('conta_id')->references('id')->on('contas');
            $table->foreign('plataforma_id')->references('id')->on('plataformas');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conta_plataformas');
    }
}
