<?php

namespace StructureValidator\Test;

use StructureValidator\Analyzer;
use PHPUnit\Framework\TestCase;

class AnalyzerTest extends TestCase
{
    public function testGetErrors()
    {
        $analyzer = new Analyzer();
        $this->assertCount(0, $analyzer->getErrors());
    }

    public function testValidStructure()
    {
        $jsonStructure = '{
            "id": 1,
            "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit"
        }';

        $structure = json_decode($jsonStructure, true);
        $structureMap = [
            'id'    => 'integer',
            'title' => 'string'
        ];

        $analyzer = new Analyzer();
        $isValid = $analyzer->isValidStructure($structure, $structureMap);

        $this->assertTrue($isValid);
    }

    public function testValidNestedStructure()
    {
        $jsonStructure = '{
            "id": 42,
            "metadData": {
                "title": "provident occaecati",
                "details_id": 123
            }
        }';

        $structure = json_decode($jsonStructure, true);
        $structureMap = [
            'id'        => 'integer',
            'metadData' => 'array',
            'details_id'=> 'integer'
        ];

        $analyzer = new Analyzer();
        $isValid = $analyzer->isValidStructure($structure, $structureMap);

        $this->assertTrue($isValid);
    }

    public function testInvalidStructure()
    {
        $jsonStructure = '{
            "title": 1
        }';

        $structure = json_decode($jsonStructure, true);
        $structureMap = [
            'id'    => 'integer',
            'title' => 'string'
        ];

        $analyzer = new Analyzer();
        $isValid = $analyzer->isValidStructure($structure, $structureMap);

        $this->assertFalse($isValid);

        $this->assertArrayHasKey(
            Analyzer::TYPE_KEY_UNDERFLOW,
            $analyzer->getErrors()
        );

        $this->assertArrayHasKey(
            Analyzer::TYPE_UNEXPECTED_VALUE_TYPE,
            $analyzer->getErrors()
        );
    }
}
