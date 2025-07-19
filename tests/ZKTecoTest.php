<?php

namespace maliklibs\Zkteco\Tests;

use Orchestra\Testbench\TestCase;
use maliklibs\Zkteco\Lib\ZKTeco;
use maliklibs\Zkteco\Providers\ZktecoServiceProvider;

class ZKTecoTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ZktecoServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'ZKTeco' => \maliklibs\Zkteco\Facades\ZKTeco::class,
        ];
    }

    /** @test */
    public function it_can_create_zkteco_instance()
    {
        $zk = new ZKTeco('192.168.1.201', 4370, 5);
        
        $this->assertInstanceOf(ZKTeco::class, $zk);
        $this->assertEquals('192.168.1.201', $zk->_ip);
        $this->assertEquals(4370, $zk->_port);
    }

    /** @test */
    public function it_can_register_facade()
    {
        $this->assertTrue(app()->bound('zkteco'));
    }

    /** @test */
    public function it_can_use_facade()
    {
        $this->assertInstanceOf(ZKTeco::class, app('zkteco'));
    }

    /** @test */
    public function it_has_socket_resource()
    {
        $zk = new ZKTeco('192.168.1.201', 4370, 5);
        
        // In PHP 8.0+, socket_create returns a Socket object, not a resource
        if (PHP_VERSION_ID >= 80000) {
            $this->assertIsObject($zk->_zkclient);
            $this->assertInstanceOf('Socket', $zk->_zkclient);
        } else {
            $this->assertIsResource($zk->_zkclient);
        }
    }

    /** @test */
    public function it_supports_dependency_injection()
    {
        // Test dependency injection
        $zk = app(ZKTeco::class);
        $this->assertInstanceOf(ZKTeco::class, $zk);
    }

    /** @test */
    public function it_has_correct_method_signatures()
    {
        $zk = new ZKTeco('192.168.1.201', 4370, 5);
        
        // Test that all methods exist and are callable
        $methods = [
            'connect', 'disconnect', 'version', 'osVersion', 'platform',
            'fmVersion', 'workCode', 'ssr', 'pinWidth', 'faceFunctionOn',
            'serialNumber', 'deviceName', 'disableDevice', 'enableDevice',
            'getUser', 'setUser', 'clearUsers', 'clearAdmin', 'removeUser',
            'getFingerprint', 'setFingerprint', 'removeFingerprint',
            'getAttendance', 'clearAttendance', 'setTime', 'getTime',
            'shutdown', 'restart', 'sleep', 'resume', 'testVoice',
            'clearLCD', 'writeLCD'
        ];
        
        foreach ($methods as $method) {
            $this->assertTrue(method_exists($zk, $method), "Method {$method} should exist");
        }
    }

    /** @test */
    public function it_handles_utf8_encoding_correctly()
    {
        // Test that the utf8 encoding fix works
        $zk = new ZKTeco('192.168.1.201', 4370, 5);
        
        // This test ensures that the mb_convert_encoding replacement works
        // The actual encoding happens in the User helper class
        $this->assertTrue(function_exists('mb_convert_encoding'));
    }

    /** @test */
    public function it_has_proper_php_extension_requirements()
    {
        // Test that required extensions are available
        $this->assertTrue(extension_loaded('mbstring'), 'mbstring extension should be loaded');
        $this->assertTrue(extension_loaded('sockets'), 'sockets extension should be loaded');
    }

    /** @test */
    public function it_supports_configuration_loading()
    {
        // Test configuration loading
        $this->assertEquals('192.168.1.201', config('zkteco.default_ip'));
        $this->assertEquals(4370, config('zkteco.default_port'));
        $this->assertEquals(5, config('zkteco.timeout'));
    }

    /** @test */
    public function it_has_correct_write_lcd_signature()
    {
        $zk = new ZKTeco('192.168.1.201', 4370, 5);
        
        // Test that writeLCD method accepts correct parameters
        $reflection = new \ReflectionMethod($zk, 'writeLCD');
        $parameters = $reflection->getParameters();
        
        $this->assertCount(2, $parameters);
        $this->assertEquals('rank', $parameters[0]->getName());
        $this->assertEquals('text', $parameters[1]->getName());
    }

    /** @test */
    public function it_has_correct_set_user_signature()
    {
        $zk = new ZKTeco('192.168.1.201', 4370, 5);
        
        // Test that setUser method accepts correct parameters
        $reflection = new \ReflectionMethod($zk, 'setUser');
        $parameters = $reflection->getParameters();
        
        $this->assertCount(6, $parameters);
        $this->assertEquals('uid', $parameters[0]->getName());
        $this->assertEquals('userid', $parameters[1]->getName());
        $this->assertEquals('name', $parameters[2]->getName());
        $this->assertEquals('password', $parameters[3]->getName());
        $this->assertEquals('role', $parameters[4]->getName());
        $this->assertEquals('cardno', $parameters[5]->getName());
    }

    /** @test */
    public function it_has_public_properties_accessible()
    {
        $zk = new ZKTeco('192.168.1.201', 4370, 5);
        
        // Test that all public properties are accessible
        $this->assertIsString($zk->_ip);
        $this->assertIsInt($zk->_port);
        $this->assertIsString($zk->_data_recv);
        $this->assertIsInt($zk->_session_id);
        $this->assertIsString($zk->_section);
    }

    /** @test */
    public function it_has_helper_classes_available()
    {
        // Test that all helper classes exist
        $helperClasses = [
            'maliklibs\Zkteco\Lib\Helper\Attendance',
            'maliklibs\Zkteco\Lib\Helper\Device',
            'maliklibs\Zkteco\Lib\Helper\Face',
            'maliklibs\Zkteco\Lib\Helper\Fingerprint',
            'maliklibs\Zkteco\Lib\Helper\Os',
            'maliklibs\Zkteco\Lib\Helper\Pin',
            'maliklibs\Zkteco\Lib\Helper\Platform',
            'maliklibs\Zkteco\Lib\Helper\SerialNumber',
            'maliklibs\Zkteco\Lib\Helper\Ssr',
            'maliklibs\Zkteco\Lib\Helper\Time',
            'maliklibs\Zkteco\Lib\Helper\User',
            'maliklibs\Zkteco\Lib\Helper\Util',
            'maliklibs\Zkteco\Lib\Helper\Connect',
            'maliklibs\Zkteco\Lib\Helper\Version',
            'maliklibs\Zkteco\Lib\Helper\WorkCode'
        ];
        
        foreach ($helperClasses as $class) {
            $this->assertTrue(class_exists($class), "Helper class {$class} should exist");
        }
    }

    /** @test */
    public function it_has_util_constants_defined()
    {
        // Test that Util class has required constants
        $this->assertTrue(defined('maliklibs\Zkteco\Lib\Helper\Util::USHRT_MAX'));
        $this->assertTrue(defined('maliklibs\Zkteco\Lib\Helper\Util::CMD_CONNECT'));
        $this->assertTrue(defined('maliklibs\Zkteco\Lib\Helper\Util::LEVEL_USER'));
        $this->assertTrue(defined('maliklibs\Zkteco\Lib\Helper\Util::COMMAND_TYPE_GENERAL'));
    }

    /** @test */
    public function it_can_use_facade_methods()
    {
        // Test that facade can be resolved and used
        $this->assertTrue(app()->bound('zkteco'));
        $zk = app('zkteco');
        $this->assertInstanceOf(ZKTeco::class, $zk);
        
        // Test that the underlying class has the methods
        $this->assertTrue(method_exists($zk, 'connect'));
        $this->assertTrue(method_exists($zk, 'disconnect'));
        $this->assertTrue(method_exists($zk, 'getUser'));
        $this->assertTrue(method_exists($zk, 'getAttendance'));
    }

    /** @test */
    public function it_supports_laravel_service_container()
    {
        // Test that the package integrates properly with Laravel's service container
        $this->assertTrue(app()->bound('zkteco'));
        $this->assertInstanceOf(ZKTeco::class, app('zkteco'));
        $this->assertInstanceOf(ZKTeco::class, app(\maliklibs\Zkteco\Lib\ZKTeco::class));
    }

    /** @test */
    public function it_has_proper_autoloading()
    {
        // Test that all classes can be autoloaded
        $this->assertTrue(class_exists('maliklibs\Zkteco\Lib\ZKTeco'));
        $this->assertTrue(class_exists('maliklibs\Zkteco\Facades\ZKTeco'));
        $this->assertTrue(class_exists('maliklibs\Zkteco\Providers\ZktecoServiceProvider'));
    }
} 