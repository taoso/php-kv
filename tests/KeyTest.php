<?php
namespace Lvht\Key;

use PHPUnit\Framework\TestCase;

class KeyTest extends TestCase
{
    /**
     * @var Key
     */
    private $kv;

    protected function setUp()
    {
        $this->kv = Key::new("_lv_key.db");
    }

    public function testSet()
    {
        $r = $this->kv->set('a', [1, 2, 3]);
        self::assertTrue($r);
    }

    /**
     * @depends testSet
     */
    public function testGet()
    {
        $r = $this->kv->set('a', [1, 2, 3]);
        $r = $this->kv->get('a');
        self::assertEquals([1,2,3], $r);
    }

    public function testGetNull()
    {
        $r = $this->kv->get('b');
        self::assertNull($r);
    }

    protected function tearDown()
    {
        unlink("./_lv_key.db");
    }
}
