<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Traits\HasUUID;

class GenerateUUIDTest extends TestCase
{
    use HasUUID;

    public function testGenerateUUID()
    {
        $generated = $this->generateUUID();
        $this->assertRegExp('/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i', $generated);
    }
}
