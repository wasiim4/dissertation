<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->enum('title', ['Monsieur','Madame','Mademoiselle'])->default("Monsieur");
            $table->string('contactnum')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->date('dob');
            $table->integer('birthCertificateNumber')->unique();
            $table->enum('districtIssued', ['Port Louis','Moka','Plaine Wilhems','Pamplemousses','Grand Port','Savanne','Flacq','Rivière du Rempart','Rivière Noire'])->default("Port Louis");
            $table->string('placeOfBirth');
            $table->enum('gender', ['Male','Female'])->default("Male");
            $table->string('address');
            $table->string('nic')->unique();
            $table->enum('marriageStatus', ['Célibataire','Mariés','Divorcés','Veuve','Veuf'])->default("Célibataire");
            $table->enum('roles', ['acquéreur','vendeurs','Buyer_Spouse','Seller_Spouse','Children','Partegeant','co_partageants'])->default("acquéreur");
            $table->string('profession');
            $table->enum('spouseTitle', ['Monsieur','Madame'])->nullable()->default("Madame");
            $table->string('spouseFirstname')->nullable();
            $table->string('spouseLastname')->nullable();
            $table->date('spouseDob')->nullable();
            $table->integer('spouseBCNum')->unique()->nullable();
            $table->enum('spouseBCdistrictIssued', ['Port Louis','Moka','Plaine Wilhems','Pamplemousses','Grand Port','Savanne','Flacq','Rivière du Rempart','Rivière Noire'])->default("Port Louis");
            $table->string('spousePlaceOfBirth')->nullable();
            $table->enum('spouseGender', ['Male','Female'])->default("Male");
            $table->string('spouseNic')->unique()->nullable();
            $table->date('marriageDate')->nullable();
            $table->integer('MCNumber')->unique()->nullable();
            $table->enum('MCdistrictIssued', ['Port Louis','Moka','Plaine Wilhems','Pamplemousses','Grand Port','Savanne','Flacq','Rivière du Rempart','Ri->nullabvière Noire'])->default("Port Louis");
            $table->string('spouseProfession')->nullable();
            $table->string('img_path')->nullable()->default('profilePic.jpg');
            $table->integer('noOfChildren')->nullable();
            $table->integer('parentId')->nullable();
            $table->integer('spouseDCNum')->unique()->nullable();
            $table->date('DeathDate')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('immovableProperty', function (Blueprint $table) {
            $table->increments('propertyId');
            $table->integer('clientId');
            $table->string('address');
            $table->string('priceInFigures');
            $table->string('priceInWords');
            $table->enum('propertyType', ['Land','Company','Hotel','House'])->default("Land");
            $table->integer('sizeInMSFigures');
            $table->string('sizeInMSWords');
            $table->string('sizeInPerchWords');
            $table->integer('taxDuty')->nullable();
            $table->string('transcriptionVol')->nullable();
            $table->string('secTranscriptionVol')->nullable();
            $table->integer('pinNum')->nullable();
            $table->string('regNumLSReport')->nullable();
            $table->enum('surveyorTitle', ['Monsieur','Madame','Mademoiselle'])->default("Monsieur");
            $table->string('surveyorFN')->nullable();
            $table->string('surveyorLN')->nullable();
            $table->date('surveyorDate')->nullable();
            $table->date('firstDeedRegistration')->nullable();
            $table->string('secDeedRegistration')->nullable();
            $table->date('firstDeedGeneration')->nullable();
            //$table->date('secDeedGeneration')->nullable();
            $table->string('previousNotaryFN')->nullable();
            $table->string('previousNotaryLN')->nullable();
            $table->enum('previousNotaryTitle', ['Monsieur','Madame','Mademoiselle'])->default("Monsieur");
            $table->enum('districtSituated', ['Port Louis','Moka','Plaine Wilhems','Pamplemousses','Grand Port','Savanne','Flacq','Rivière du Rempart','Rivière Noire'])->default("Port Louis");
            $table->string('img_path')->nullable()->default('profilePic.jpg');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('title', ['Monsieur','Madame','Mademoiselle'])->default("Monsieur");
            $table->enum('roles', ['Notary','Notary Assistant'])->default("Notary");
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('dob');
            $table->string('nic')->unique();
            $table->string('contactnum')->unique();
            $table->enum('gender', ['Male','Female'])->default("Male");
            $table->string('img_path')->nullable()->default('profilePic.jpg');
            $table->rememberToken();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('rgds', function (Blueprint $table) {
            $table->increments('id');
           // $table->enum('title', ['Monsieur','Madame','Mademoiselle'])->default("Monsieur");
            $table->enum('roles', ['RGD'])->default("RGD");
            $table->string('name');
            //$table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            //$table->date('dob');
           // $table->string('nic')->unique();
            $table->string('contactnum')->unique();
           // $table->enum('gender', ['Male','Female'])->default("Male");
            $table->string('img_path')->nullable()->default('profilePic.jpg');
            $table->rememberToken();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clientId');
            $table->string('name');
            $table->string('mime');
            // $table->integer('staffId');
            // $table->integer('propertyId');
            // $table->integer('fees');
            // $table->enum('transactionType', ['SOIP1','SOIP2','ALOTO2'])->default("SOIP1");
            $table->binary('generatedContract');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
       
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partyId');
            $table->string('meetingReason');
            $table->datetime('startTime');
            $table->datetime('endTime');
            $table->string('meetingStatus');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
