<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefregionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refregion', function (Blueprint $table) {
            $table->id();
            $table->string('psgcCode')->nullable();
            $table->text('regDesc');
            $table->string('regCode')->nullable();
            $table->timestamps();
        });

        // Insert records into refregion
        DB::table('refregion')->insert([
            ['psgcCode' => '010000000', 'regDesc' => 'REGION I (ILOCOS REGION)', 'regCode' => '01'],
            ['psgcCode' => '020000000', 'regDesc' => 'REGION II (CAGAYAN VALLEY)', 'regCode' => '02'],
            ['psgcCode' => '030000000', 'regDesc' => 'REGION III (CENTRAL LUZON)', 'regCode' => '03'],
            ['psgcCode' => '040000000', 'regDesc' => 'REGION IV-A (CALABARZON)', 'regCode' => '04'],
            ['psgcCode' => '170000000', 'regDesc' => 'REGION IV-B (MIMAROPA)', 'regCode' => '17'],
            ['psgcCode' => '050000000', 'regDesc' => 'REGION V (BICOL REGION)', 'regCode' => '05'],
            ['psgcCode' => '060000000', 'regDesc' => 'REGION VI (WESTERN VISAYAS)', 'regCode' => '06'],
            ['psgcCode' => '070000000', 'regDesc' => 'REGION VII (CENTRAL VISAYAS)', 'regCode' => '07'],
            ['psgcCode' => '080000000', 'regDesc' => 'REGION VIII (EASTERN VISAYAS)', 'regCode' => '08'],
            ['psgcCode' => '090000000', 'regDesc' => 'REGION IX (ZAMBOANGA PENINSULA)', 'regCode' => '09'],
            ['psgcCode' => '100000000', 'regDesc' => 'REGION X (NORTHERN MINDANAO)', 'regCode' => '10'],
            ['psgcCode' => '110000000', 'regDesc' => 'REGION XI (DAVAO REGION)', 'regCode' => '11'],
            ['psgcCode' => '120000000', 'regDesc' => 'REGION XII (SOCCSKSARGEN)', 'regCode' => '12'],
            ['psgcCode' => '130000000', 'regDesc' => 'NATIONAL CAPITAL REGION (NCR)', 'regCode' => '13'],
            ['psgcCode' => '140000000', 'regDesc' => 'CORDILLERA ADMINISTRATIVE REGION (CAR)', 'regCode' => '14'],
            ['psgcCode' => '150000000', 'regDesc' => 'AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)', 'regCode' => '15'],
            ['psgcCode' => '160000000', 'regDesc' => 'REGION XIII (Caraga)', 'regCode' => '16'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refregion');
    }
}
