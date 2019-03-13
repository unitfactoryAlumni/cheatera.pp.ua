<p align="center">
    <a href="https://cheatera.pp.ua" target="_blank">
        <img src="https://cheatera.pp.ua/icon_uf.png" height="100px">
    </a>
    <h1 align="center">Cheatera Project</h1>
    <br>
</p>

Cheatera Yii 2
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      common/messages     contains translations files
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.2.0.


DEVELOP TEAM CHAT
-----------------

Please write in telegram @omentes for add you to develop chat


INSTALLATION
------------

### Install  (UNIT Factory)

Install docker https://forum.intra.42.fr/topics/19933/messages/last

    cp .env.example .env

Register new 42 API app and fill Oauth42 in .env

    docker-compose up -d --build
    
You can then access the application through the following URL:

    http://192.168.99.100:8888

If after installation you see fatal error `require()`:

	docker-compose exec web bash
    chown www-data:www-data runtime web/assets
	composer update

Automation import DB from file (write @apakhomo in Slack, or @omentes in Telegram) 
Put file schema.sql on project dir.

PhpMyAdmin
    
    http://192.168.99.100:8080

Login with user `yii2` and pass `yii2`, select `yii2`
    
**TEST AUTH:** 
- Press 'Login' at nav bar


XDEBUG with PHPStorm
-------

1. Start docker and open website, and check IP in menu
2. Open PhpStorm settings PHP > Debug
3. Debug Port 9999
4. All marks is checked (xDebug Section)
5. Open  PHP > Debug > DBGp Proxy and write `PHPStorm`, IP from menu, `9999`
6. Open PHP > Servers and add mapping `/var/www/html` - Absolute path on server for project files
7. Open PHP > Debug and press 'Validate', add /web for project path and website adn press Validate
8. Install https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc
9. Enjoy!

TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).
By default there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
vendor/bin/codecept run
```

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 


### Running  acceptance tests

To execute acceptance tests do the following:  

1. Rename `tests/acceptance.suite.yml.example` to `tests/acceptance.suite.yml` to enable suite configuration

2. Replace `codeception/base` package in `composer.json` with `codeception/codeception` to install full featured
   version of Codeception

3. Update dependencies with Composer 

    ```
    composer update  
    ```

4. Download [Selenium Server](http://www.seleniumhq.org/download/) and launch it:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ```

    In case of using Selenium Server 3.0 with Firefox browser since v48 or Google Chrome since v53 you must download [GeckoDriver](https://github.com/mozilla/geckodriver/releases) or [ChromeDriver](https://sites.google.com/a/chromium.org/chromedriver/downloads) and launch Selenium with it:

    ```
    # for Firefox
    java -jar -Dwebdriver.gecko.driver=~/geckodriver ~/selenium-server-standalone-3.xx.x.jar
    
    # for Google Chrome
    java -jar -Dwebdriver.chrome.driver=~/chromedriver ~/selenium-server-standalone-3.xx.x.jar
    ``` 
    
    As an alternative way you can use already configured Docker container with older versions of Selenium and Firefox:
    
    ```
    docker run --net=host selenium/standalone-firefox:2.53.0
    ```

5. (Optional) Create `yii2_basic_tests` database and update it by applying migrations if you have them.

   ```
   tests/bin/yii migrate
   ```

   The database configuration can be found at `config/test_db.php`.


6. Start web server:

    ```
    tests/bin/yii serve
    ```

7. Now you can run all available tests

   ```
   # run all available tests
   vendor/bin/codecept run

   # run acceptance tests
   vendor/bin/codecept run acceptance

   # run only unit and functional tests
   vendor/bin/codecept run unit,functional
   ```

### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```
#collect coverage for all tests
vendor/bin/codecept run -- --coverage-html --coverage-xml

#collect coverage only for unit tests
vendor/bin/codecept run unit -- --coverage-html --coverage-xml

#collect coverage for unit and functional tests
vendor/bin/codecept run functional,unit -- --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.
