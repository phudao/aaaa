<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtmlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atmlogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->date('date_working');
            $table->unsignedInteger('shift');
            $table->unsignedInteger('manager_id');
            $table->unsignedInteger('leader_id');
            //$table->string('staff_ids', 20);
            $table->string('staff_names',100);
            $table->tinyInteger('rf12_mst');
            $table->string('nb', 10);
            $table->string('cm');
            $table->string('st');
            $table->tinyInteger('rf34_mst');
            $table->string('vi');
            $table->string('tn');
            $table->string('vc');
            $table->string('bh');
            $table->string('bi');
            $table->string('bn');
            $table->tinyInteger('rf56_mst');
            $table->string('nt');
            $table->string('nh');
            $table->string('bs');
            $table->string('bo');
            $table->string('bt');
            $table->string('br');
            $table->tinyInteger('rf78_mst');
            $table->string('bv');
            $table->string('rg');
            $table->tinyInteger('ms_mst');
            $table->string('msf');
            $table->tinyInteger('sf_mst');
            $table->string('stca');
            $table->string('msaw');
            $table->string('daiw');
            $table->tinyInteger('rp_mst');
            $table->string('rec_bck');
            $table->dateTime('hd1_from', 0);
            $table->dateTime('hd1_to', 0);
            $table->dateTime('hd2_from', 0);
            $table->dateTime('hd2_to', 0);
            $table->string('backed_up');
            $table->tinyInteger('gw_mst');
            $table->string('gdo_grc');
            $table->tinyInteger('fp_mst');
            $table->string('afs');
            $table->tinyInteger('db_mst');
            $table->string('dbh');
            $table->tinyInteger('mn_mst');
            $table->string('mona');
            $table->tinyInteger('mt_mst');
            $table->string('mtcd');
            $table->tinyInteger('id_mst');
            $table->string('id_data_received');
            
            $table->string('adman_client');
            $table->string('fpl_track_met');
            $table->string('shd_dbh');
            $table->string('shd_rpb');
            $table->string('shd_ids');
            $table->string('dec');
            $table->string('clocks');
            $table->string('das_webserver');
            $table->string('das_oracledb');
            
            $table->string('lab_servers', 100)->nullable();//ca sang
            $table->string('lab_cpws', 100)->nullable();//ca sang
            $table->string('recochetA_services')->nullable();//ca sang
            $table->string('recochetB_services')->nullable();//ca sang
            $table->integer('recochetA_hd_free')->nullable();//ca sang
            $table->integer('recochetB_hd_free')->nullable();//ca sang

            $table->string('offices_cleanup')->nullable();//friday
            $table->string('corefiles_cleanup')->nullable();//friday
            $table->string('cabinet_cleanup')->nullable();//friday
            $table->string('plbvoice_working')->nullable();//friday
            $table->string('magneticdisc_cleanup')->nullable();//friday
            $table->string('compare_config_files')->nullable();//friday
            $table->string('usb_rpb_used')->nullable();//friday
            $table->string('usb_rpb_cleanup')->nullable();//friday
            $table->string('backedup_dat')->nullable();//friday
            $table->string('dbh_cluster_offline')->nullable();//tuesday
            $table->string('hn3')->nullable();//tuesday
            $table->float('nb_error', 5, 2)->nullable();//1st
            $table->float('st_error', 5, 2)->nullable();//1st
            $table->float('vi_error', 5, 2)->nullable();//1st
            $table->float('rg_error', 5, 2)->nullable();//1st

            $table->string('note', 1000)->nullable();            
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
        Schema::dropIfExists('atmlogs');
    }
}
