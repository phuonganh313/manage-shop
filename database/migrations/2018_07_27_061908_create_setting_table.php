<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_shop')->unsigned()->index();
            $table->string('icon_color');
            $table->string('text_color');
            $table->enum('font_family', ['Arial','Verdana','Times New Roman','Calibri','sans-serif']);
            $table->enum('font_style', ['normal','italic','oblique','bold','bolder','lighter','100','200','300','500','600','700','800','900']);
            $table->enum('position', ['up','down','left','upleft']);
            $table->enum('animation', ['slide','fade','pop','popFade','none']);
            $table->enum('shape', ['circle','rectangle']);
            $table->enum('flicker_timing', ['1','2','3','5']);
            $table->enum('sound_effect', ['off','chimedingdong.mp3','dingdong.mp3','slowdingdong.mp3','tubulardingdong.mp3']);
            $table->enum('repeat', ['1','2','3','5']);
            $table->enum('frequency', ['1','2','3','5']);
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
        Schema::dropIfExists('setting');
    }
}
