<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('terms_condition_link')->nullable();
            $table->string('about_us_link')->nullable();
            $table->string('privacy_policy_link')->nullable();

            $table->string('header_logo')->nullable();
            $table->string('footer_logo')->nullable();

            $table->string('login_banner')->nullable();
            $table->string('image_slider')->nullable();

            $table->text('title')->nullable();
            $table->longText('desc')->nullable();

            $table->longText('footer_desc')->nullable();
            $table->string('company_profile_pdf')->nullable();

            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->double('latitude')->default(0);
            $table->double('longitude')->default(0);

            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();

            $table->string('fax')->nullable();

            $table->string('android_app')->nullable();
            $table->string('ios_app')->nullable();

            $table->string('email1')->nullable();
            $table->string('email2')->nullable();

            $table->string('link')->nullable();

            $table->string('sms_user_name')->nullable();
            $table->string('sms_user_pass')->nullable();

            $table->string('sms_sender')->nullable();

            $table->string('publisher')->nullable();

            $table->string('default_language')->default('ar');
            $table->string('default_theme')->nullable();
            $table->string('offer_muted')->nullable();
            $table->integer('offer_notification')->default(1);

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('telegram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('google_plus')->nullable();
            $table->string('snapchat_ghost')->nullable();
            $table->string('whatsapp')->nullable();

            $table->longText('about_app')->nullable();

            $table->longtext('terms_condition')->nullable();

            $table->longtext('privacy_policy')->nullable();
            $table->integer('user_start_points')->default(0);
            $table->double('site_commission')->default(1);
            $table->integer('debt_limit')->default(1);

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
        Schema::dropIfExists('settings');
    }
}
