<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateKeyWordsTable extends Migration
{
    private $data;

    public function __construct()
    {
        $this->data = [
            [
                'title' => 'Php'
            ],
            [
                'title' => 'Laravel'
            ],
            [
                'title' => 'Yii'
            ],
            [
                'title' => 'Symfony'
            ],
            [
                'title' => 'Drupal'
            ],
            [
                'title' => 'Zend'
            ],
            [
                'title' => 'CodeIgniter'
            ],
            [
                'title' => 'CakePHP'
            ],
            [
                'title' => 'Kohana'
            ],
            [
                'title' => 'Lumen'
            ],
            [
                'title' => 'Phalcon'
            ],
            [
                'title' => 'Python'
            ],
            [
                'title' => 'Django'
            ],
            [
                'title' => 'Flask'
            ],
            [
                'title' => 'Express.js'
            ],
            [
                'title' => 'Meteor'
            ],
            [
                'title' => 'Koa'
            ],
            [
                'title' => 'Nest.js'
            ],
            [
                'title' => 'Beego'
            ],
            [
                'title' => 'Java'
            ],
            [
                'title' => 'Spring'
            ],
            [
                'title' => 'Swing'
            ],
            [
                'title' => 'Java FX'
            ],
            [
                'title' => 'Ruby'
            ],
            [
                'title' => 'Ruby on Rails'
            ],
            [
                'title' => '.NET'
            ],
            [
                'title' => 'C#'
            ],
            [
                'title' => 'ASP.NET'
            ],
            [
                'title' => 'Entity'
            ],
            [
                'title' => 'NuGet'
            ],
            [
                'title' => 'C++'
            ],
            [
                'title' => 'QT'
            ],
            [
                'title' => 'Node.js'
            ],
            [
                'title' => 'Nuxt.js'
            ],
            [
                'title' => 'Gatsby.js'
            ],
            [
                'title' => 'Next.js'
            ],
            [
                'title' => 'Database'
            ],
            [
                'title' => 'Redis'
            ],
            [
                'title' => 'PostgreSQL'
            ],
            [
                'title' => 'MongoDB'
            ],
            [
                'title' => 'MariaDB'
            ],
            [
                'title' => 'MySQL'
            ],
            [
                'title' => 'SQLite'
            ],
            [
                'title' => 'RabbitMQ'
            ],
            [
                'title' => 'Scala'
            ],
            [
                'title' => 'Joomla'
            ],
            [
                'title' => 'OpenCart'
            ],
            [
                'title' => 'Shopify'
            ],
            [
                'title' => 'WordPress'
            ],
            [
                'title' => 'Magento'
            ],
            [
                'title' => 'ModX'
            ],
            [
                'title' => 'Netcat'
            ],
            [
                'title' => 'Delphi'
            ],
            [
                'title' => 'ExpressionEngine'
            ],
            [
                'title' => 'PrestaShop'
            ],
            [
                'title' => 'ELEMENTOR'
            ],
            [
                'title' => 'Responsive'
            ],
            [
                'title' => 'WooCommerce'
            ],
            [
                'title' => 'Frontend'
            ],
            [
                'title' => 'JavaScript'
            ],
            [
                'title' => 'Vue'
            ],
            [
                'title' => 'React'
            ],
            [
                'title' => 'jQuery'
            ],
            [
                'title' => 'Ember.js'
            ],
            [
                'title' => 'Backbone'
            ],
            [
                'title' => 'Redux'
            ],
            [
                'title' => 'Alpine'
            ],
            [
                'title' => 'TypeScript'
            ],
            [
                'title' => 'Angular'
            ],
            [
                'title' => 'Markup'
            ],
            [
                'title' => 'HTML'
            ],
            [
                'title' => 'CSS'
            ],
            [
                'title' => 'Bootstrap'
            ],
            [
                'title' => 'Tailwind'
            ],
            [
                'title' => 'Kendo'
            ],
            [
                'title' => 'Telerik'
            ],
            [
                'title' => 'Flexbox'
            ],
            [
                'title' => 'Canvas'
            ],
            [
                'title' => 'Tilda'
            ],
            [
                'title' => 'Webpack'
            ],
            [
                'title' => 'Handlebars'
            ],
            [
                'title' => 'Gulp'
            ],
            [
                'title' => 'Liquid'
            ],
            [
                'title' => 'Webix'
            ],
            [
                'title' => 'VueX'
            ],
            [
                'title' => 'GSAP'
            ],
            [
                'title' => 'Parallax'
            ],
            [
                'title' => 'Vuetify'
            ],
            [
                'title' => 'Website'
            ],
            [
                'title' => 'Developer'
            ],
            [
                'title' => 'Development'
            ],
            [
                'title' => 'Online'
            ],
            [
                'title' => 'Platform'
            ],
            [
                'title' => 'API'
            ],
            [
                'title' => 'System'
            ],
            [
                'title' => 'Store'
            ],
            [
                'title' => 'Divi'
            ],
            [
                'title' => 'Template'
            ],
            [
                'title' => 'ERP'
            ],
            [
                'title' => 'Integration'
            ],
            [
                'title' => 'Real estate'
            ],
            [
                'title' => 'Backend'
            ],
            [
                'title' => 'AWS'
            ],
            [
                'title' => 'CRM'
            ],
            [
                'title' => 'B2B'
            ],
            [
                'title' => 'Marketplace'
            ],
            [
                'title' => 'Plugins'
            ],
            [
                'title' => 'CMS'
            ],
            [
                'title' => 'SalesForce'
            ],
            [
                'title' => 'Full-Stack'
            ],
            [
                'title' => 'LMS'
            ],
            [
                'title' => 'Bakery'
            ],
            [
                'title' => 'Learndash'
            ],
            [
                'title' => 'Avada'
            ],
            [
                'title' => 'Axios'
            ],
            [
                'title' => 'UII'
            ],
            [
                'title' => 'NATIVE'
            ],
            [
                'title' => 'iOS'
            ],
            [
                'title' => 'Swift'
            ],
            [
                'title' => 'Objective-C'
            ],
            [
                'title' => 'Android'
            ],
            [
                'title' => 'Kotlin'
            ],
            [
                'title' => 'CROSS-PLATFORM'
            ],
            [
                'title' => 'React Native'
            ],
            [
                'title' => 'Flutter'
            ],
            [
                'title' => 'Dart'
            ],
            [
                'title' => 'NativeScript'
            ],
            [
                'title' => 'Ionic'
            ],
            [
                'title' => 'Xamarin'
            ],
            [
                'title' => 'Cordova'
            ],
            [
                'title' => 'Unity'
            ],
            [
                'title' => 'PhoneGap'
            ],
            [
                'title' => 'NativeScript'
            ],
            [
                'title' => 'Dojo'
            ],
            [
                'title' => 'Kivy'
            ],
            [
                'title' => 'Corona'
            ],
            [
                'title' => 'Mobile'
            ],
            [
                'title' => 'Application'
            ],
        ];
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_words', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        DB::table('key_words')->insert($this->data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('key_words');
    }
}
