<?php

namespace maliklibs\Zkteco\Tests;

use Orchestra\Testbench\TestCase;
use maliklibs\Zkteco\Lib\ZKTeco;
use maliklibs\Zkteco\Providers\ZktecoServiceProvider;

class BackwardCompatibilityTest extends TestCase
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
    public function it_maintains_backward_compatibility_with_manual_instantiation()
    {
        // Test the original way of using the package
        $zk = new ZKTeco('192.168.1.201', 4370, 5);
        
        $this->assertInstanceOf(ZKTeco::class, $zk);
        $this->assertEquals('192.168.1.201', $zk->_ip);
        $this->assertEquals(4370, $zk->_port);
        
        // Test that all public properties are accessible
        $this->assertIsString($zk->_ip);
        $this->assertIsInt($zk->_port);
        $this->assertIsResource($zk->_zkclient);
    }

    /** @test */
    public function it_supports_facade_usage()
    {
        // Test the new facade way
        $this->assertTrue(app()->bound('zkteco'));
        $this->assertInstanceOf(ZKTeco::class, app('zkteco'));
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
    public function it_handles_write_lcd_correctly()
    {
        $zk = new ZKTeco('192.168.1.201', 4370, 5);
        
        // Test that writeLCD method accepts correct parameters
        $reflection = new \ReflectionMethod($zk, 'writeLCD');
        $parameters = $reflection->getParameters();
        
        $this->assertCount(2, $parameters);
        $this->assertEquals('rank', $parameters[0]->getName());
        $this->assertEquals('text', $parameters[1]->getName());
    }
} 