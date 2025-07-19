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
} 