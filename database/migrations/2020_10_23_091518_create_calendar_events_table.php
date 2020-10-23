<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_events', function (Blueprint $table) {
            $table->id();
            $table->string('event_title',255);
            $table->date('start_date');
            $table->date('end_date');
            $table->char('monday');
            $table->char('tuesday');
            $table->char('wednesday');
            $table->char('thursday');
            $table->char('friday');
            $table->char('saturday');
            $table->char('sunday');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_events');
    }
}
