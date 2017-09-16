<?php

namespace StructureValidator;

/**
 * Class Analyzer
 *
 * @package StructureValidator
 */
class Analyzer
{
    /**
     * Error types
     */
    const TYPE_UNEXPECTED_VALUE_TYPE = 'unexpected_value_type';
    const TYPE_KEY_UNDERFLOW         = 'key_underflow';

    /**
     * Collection of errors
     *
     * @var array
     */
    private $errorBucket = [];

    /**
     * Method validates structure and responds if it's incorrect as expected in mapping.
     *
     * Structure can be invalid if:
     * Expected key value contains incorrect type
     * Expected key in structure is missed
     *
     * @param array $structure Simple or nested array
     * @param array $mapping Simple list of keys and value types
     *
     * @return bool
     */
    public function isValidStructure(array $structure, array $mapping): bool
    {
        $isValid = true;

        // Create copy of mapping
        $checkList = $mapping;

        // While analyzing given structure, checked keys will be removed from checklist(mapping)
        $this->analyze($structure, $checkList);

        // Some mandatory objects missed in structure, must be empty if structure correct as expected
        if (count($checkList) !== 0) {
            $this->addError(
                self::TYPE_KEY_UNDERFLOW,
                'Structure invalid, mandatory filed(s) not found: ' . implode(', ', array_keys($checkList))
            );

            $isValid = false;
        }

        return $isValid;
    }

    /**
     * Returns all founded errors while analyzing structure with mapping
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errorBucket;
    }

    /**
     * Lookup given structure, compare the check list and collect the errors
     *
     * @param array $structure
     * @param array $checkList
     */
    private function analyze(array $structure, array &$checkList)
    {
        foreach ($structure as $key => $val) { // Walk structure and compare with check list
            // Dive in if current key are nested structure
            if (is_array($val)) {
                $this->analyze($val, $checkList);
            }

            // If key not contains in check list, then it's not mandatory key, move to next
            if (false === isset($checkList[$key])) {
                continue;
            }

            $existType = gettype($val);
            $expectedType = $checkList[$key];

            // Compare value in given structure with expected in mapping
            if ($expectedType !== $existType) {
                $error = sprintf(
                    'Unexpected type: (%s) of key: (%s), expected to be: (%s)',
                    $existType,
                    $key,
                    $expectedType
                );
                $this->addError(self::TYPE_UNEXPECTED_VALUE_TYPE, $error);
            }

            unset($checkList[$key]); // Remove checked key from list
        }
    }

    /**
     * Adds error to bucket
     *
     * @param string $type
     * @param string $error
     *
     * @internal param array $errorBucket
     */
    private function addError(string $type, string $error)
    {
        $this->errorBucket[$type][] = $error;
    }
}
