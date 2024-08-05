<?php

namespace Dmr\PhpToJs\Tests;

use PHPUnit\Framework\Attributes\Test;

class ConfigTest extends TestCase
{
    #[Test]
    public function it_defines_a_namespace()
    {
        $config = include __DIR__ . '/../config/phptojs.php';

        $this->assertArrayHasKey('namespace', $config);
        $this->assertIsString($config['namespace']);
    }
}
