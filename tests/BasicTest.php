<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class BasicTest extends TestCase
{
    /**
     * Проверка наличия критически важных файлов, описанных в ТЗ.
     */
    public function testFileCheck(): void
    {
        $this->assertFileExists(__DIR__ . '/../public/index.php');
        $this->assertFileExists(__DIR__ . '/../src/settings.php');
    }
}
