<?php

use App\Models\KeyWord;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateKeyWordsTable extends Migration
{
    private $primary;
    private $php;
    private $python;
    private $java;
    private $ruby;
    private $dotnet;
    private $cplusplus;
    private $databases;
    private $js;
    private $typescript;
    private $frontend;
    private $native;
    private $crossPlatform;
    private $development;

    public function __construct()
    {
        $this->primary = [
            [
                'title' => 'Php',
                'is_primary' => true,
                'parent_id' => null
            ],
            [
                'title' => 'Python',
                'is_primary' => true,
                'parent_id' => null
            ],
            [
                'title' => 'Java',
                'is_primary' => true,
                'parent_id' => null
            ],
            [
                'title' => 'Ruby',
                'is_primary' => true,
                'parent_id' => null
            ],
            [
                'title' => '.NET',
                'is_primary' => true,
                'parent_id' => null
            ],
            [
                'title' => 'C++',
                'is_primary' => true,
                'parent_id' => null
            ],
            [
                'title' => 'Database',
                'is_primary' => true,
                'parent_id' => null
            ],
            [
                'title' => 'JavaScript',
                'is_primary' => true,
                'parent_id' => null
            ],
            [
                'title' => 'TypeScript',
                'is_primary' => true,
                'parent_id' => null
            ],
            [
                'title' => 'Frontend',
                'is_primary' => true,
                'parent_id' => null
            ],
            [
                'title' => 'Native',
                'is_primary' => true,
                'parent_id' => null
            ],
            [
                'title' => 'Cross-Platform',
                'is_primary' => true,
                'parent_id' => null
            ],
            [
                'title' => 'Development',
                'is_primary' => true,
                'parent_id' => null
            ],
        ];
        $this->php = [
            [
                'title' => 'Laravel',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Yii',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Symfony',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Drupal',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Zend',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'CodeIgniter',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'CakePHP',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Kohana',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Lumen',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Phalcon',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Joomla',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'OpenCart',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Shopify',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'WordPress',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Magento',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'ModX',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'ExpressionEngine',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'PrestaShop',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'ELEMENTOR',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'WooCommerce',
                'is_primary' => false,
                'parent_id' => 1
            ],
        ];
        $this->python = [
            [
                'title' => 'Django',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Flask',
                'is_primary' => false,
                'parent_id' => 1
            ],
        ];
        $this->java = [
            [
                'title' => 'Spring',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Swing',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Java FX',
                'is_primary' => false,
                'parent_id' => 1
            ],
        ];
        $this->ruby = [
            [
                'title' => 'Ruby on Rails',
                'is_primary' => false,
                'parent_id' => 1
            ],
        ];
        $this->dotnet = [
            [
                'title' => 'C#',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'ASP.NET',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Entity',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'NuGet',
                'is_primary' => false,
                'parent_id' => 1
            ],
        ];
        $this->cplusplus = [
            [
                'title' => 'QT',
                'is_primary' => false,
                'parent_id' => 1
            ],
        ];
        $this->databases = [
            [
                'title' => 'Redis',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'PostgreSQL',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'MongoDB',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'MariaDB',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'MySQL',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'SQLite',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'RabbitMQ',
                'is_primary' => false,
                'parent_id' => 1
            ],
        ];
        $this->js = [
            [
                'title' => 'Express.js',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Meteor',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Koa',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Nest.js',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Node.js',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Nuxt.js',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Gatsby.js',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Next.js',
                'is_primary' => false,
                'parent_id' => 1
            ],
        ];
        $this->typescript = [
            [
                'title' => 'Angular',
                'is_primary' => false,
                'parent_id' => 1
            ],
        ];
        $this->frontend = [
            [
                'title' => 'Markup',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Responsive',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Vue',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'React',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'jQuery',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Ember.js',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Backbone',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Redux',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Alpine',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'HTML',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'CSS',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Bootstrap',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Tailwind',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Kendo',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Telerik',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Flexbox',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Canvas',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Tilda',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Webpack',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Handlebars',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Gulp',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Liquid',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Webix',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'VueX',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Axios',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'GSAP',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Parallax',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Vuetify',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Website',
                'is_primary' => false,
                'parent_id' => 1
            ],
        ];
        $this->native = [
            [
                'title' => 'iOS',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Swift',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Objective-C',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Android',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Kotlin',
                'is_primary' => false,
                'parent_id' => 1
            ],
        ];
        $this->crossPlatform = [
            [
                'title' => 'React Native',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Flutter',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Dart',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'NativeScript',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Ionic',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Xamarin',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Cordova',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Unity',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'PhoneGap',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'NativeScript',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Dojo',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Kivy',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Corona',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Mobile',
                'is_primary' => false,
                'parent_id' => 1
            ],
        ];
        $this->development = [
            [
                'title' => 'Beego',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Scala',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Netcat',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Delphi',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Developer',
                'is_primary' => false,
                'parent_id' => 1
            ],

            [
                'title' => 'Online',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Platform',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'API',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'System',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Store',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Divi',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Template',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'ERP',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Integration',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Real estate',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Backend',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'AWS',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'CRM',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'B2B',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Marketplace',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Plugins',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'CMS',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'SalesForce',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Full-Stack',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'LMS',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Bakery',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Learndash',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Avada',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'UII',
                'is_primary' => false,
                'parent_id' => 1
            ],
            [
                'title' => 'Application',
                'is_primary' => false,
                'parent_id' => 1
            ],
        ];
    }
    public function storePrimary()
    {
        KeyWord::insert($this->primary);
    }
    public function storePhp()
    {
        $primaryId = KeyWord::where('title', 'Php')->pluck('id')[0];
        $data = [];
        foreach ($this->php as $word) {
            $word['parent_id'] = $primaryId;
            array_push($data, $word);
        }
        KeyWord::insert($data);
    }
    public function storePython()
    {
        $primaryId = KeyWord::where('title', 'Python')->pluck('id')[0];
        $data = [];
        foreach ($this->python as $word) {
            $word['parent_id'] = $primaryId;
            array_push($data, $word);
        }
        KeyWord::insert($data);
    }
    public function storeJava()
    {
        $primaryId = KeyWord::where('title', 'Java')->pluck('id')[0];
        $data = [];
        foreach ($this->java as $word) {
            $word['parent_id'] = $primaryId;
            array_push($data, $word);
        }
        KeyWord::insert($data);
    }
    public function storeRuby()
    {
        $primaryId = KeyWord::where('title', 'Ruby')->pluck('id')[0];
        $data = [];
        foreach ($this->ruby as $word) {
            $word['parent_id'] = $primaryId;
            array_push($data, $word);
        }
        KeyWord::insert($data);
    }
    public function storeDotNet()
    {
        $primaryId = KeyWord::where('title', '.Net')->pluck('id')[0];
        $data = [];
        foreach ($this->dotnet as $word) {
            $word['parent_id'] = $primaryId;
            array_push($data, $word);
        }
        KeyWord::insert($data);
    }
    public function storeCPlusPlus()
    {
        $primaryId = KeyWord::where('title', 'C++')->pluck('id')[0];
        $data = [];
        foreach ($this->cplusplus as $word) {
            $word['parent_id'] = $primaryId;
            array_push($data, $word);
        }
        KeyWord::insert($data);
    }
    public function storeDatabase()
    {
        $primaryId = KeyWord::where('title', 'Database')->pluck('id')[0];
        $data = [];
        foreach ($this->databases as $word) {
            $word['parent_id'] = $primaryId;
            array_push($data, $word);
        }
        KeyWord::insert($data);
    }
    public function storeJs()
    {
        $primaryId = KeyWord::where('title', 'JavaScript')->pluck('id')[0];
        $data = [];
        foreach ($this->js as $word) {
            $word['parent_id'] = $primaryId;
            array_push($data, $word);
        }
        KeyWord::insert($data);
    }
    public function storeTypeScript()
    {
        $primaryId = KeyWord::where('title', 'TypeScript')->pluck('id')[0];
        $data = [];
        foreach ($this->typescript as $word) {
            $word['parent_id'] = $primaryId;
            array_push($data, $word);
        }
        KeyWord::insert($data);
    }
    public function storeFrontend()
    {
        $primaryId = KeyWord::where('title', 'Frontend')->pluck('id')[0];
        $data = [];
        foreach ($this->frontend as $word) {
            $word['parent_id'] = $primaryId;
            array_push($data, $word);
        }
        KeyWord::insert($data);
    }
    public function storeNative()
    {
        $primaryId = KeyWord::where('title', 'Native')->pluck('id')[0];
        $data = [];
        foreach ($this->native as $word) {
            $word['parent_id'] = $primaryId;
            array_push($data, $word);
        }
        KeyWord::insert($data);
    }
    public function storeCrossPlatform()
    {
        $primaryId = KeyWord::where('title', 'Cross-Platform')->pluck('id')[0];
        $data = [];
        foreach ($this->crossPlatform as $word) {
            $word['parent_id'] = $primaryId;
            array_push($data, $word);
        }
        KeyWord::insert($data);
    }
    public function storeDevelopment()
    {
        $primaryId = KeyWord::where('title', 'Development')->pluck('id')[0];
        $data = [];
        foreach ($this->development as $word) {
            $word['parent_id'] = $primaryId;
            array_push($data, $word);
        }
        KeyWord::insert($data);
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
            $table->boolean('is_primary')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
        });

        $this->storePrimary();
        $this->storePhp();
        $this->storeJs();
        $this->storeFrontend();
        $this->storeDatabase();
        $this->storePython();
        $this->storeRuby();
        $this->storeTypeScript();
        $this->storeNative();
        $this->storeCrossPlatform();
        $this->storeJava();
        $this->storeDotNet();
        $this->storeCPlusPlus();
        $this->storeDevelopment();
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
