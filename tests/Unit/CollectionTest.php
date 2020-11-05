<?php

namespace Tests\Unit;

use App\Collection;
use Tests\TestCase;

class CollectionTest extends TestCase
{
    /** @test */
    public function it_can_iterate_over_its_values()
    {
        // Arrange
        $collection = Collection::fromArray([1, 2, 3]);
        $sum = 0;
        $expectedSum = 6;

        // Act
        foreach ($collection as $number) {
            $sum += $number;
        }

        // Assert
        $this->assertEquals($expectedSum, $sum);
    }

    /** @test */
    public function it_can_use_map_to_create_a_new_collection_based_the_given_callback()
    {
        // Arrange
        $originalValues = Collection::fromArray([1, 2, 3]);
        $expectedValues = Collection::fromArray([4, 5, 6]);

        // Act
        $resultingCollection = $originalValues->map(fn ($val) => $val + 3);

        // Assert
        $this->assertEquals($expectedValues, $resultingCollection);
    }

    /** @test */
    public function it_reduces_the_collection_to_a_single_value_using_the_callback()
    {
        // Arrange
        $originalValues = Collection::fromArray([1, 2, 3]);
        $expectedValue = 6;

        // Act
        $resultingValue = $originalValues->reduce(fn ($acc, $val) => $acc + $val, 0);

        // Assert
        $this->assertEquals($expectedValue, $resultingValue);
    }
}
