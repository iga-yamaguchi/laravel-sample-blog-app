<?php

namespace Tests\TestUtils;


trait TestRelation
{
    abstract public function assertEquals($expected, $actual, $message = '', $delta = 0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false);

    public function assertRelation(string $sourceClassName, string $relationClassName, string $relationAttributeName)
    {
        $relationTargets = factory($relationClassName, 3)->create();
        $source          = factory($sourceClassName)->create();

        $ids = $relationTargets->pluck('id');
        $source->$relationAttributeName()->attach($ids);

        $this->assertEquals($relationTargets->count(), $source->$relationAttributeName->count());

        foreach ($source->$relationAttributeName as $key => $relation) {
            $args = $relationTargets[$key]->toArray();

            $this->assertEquals($relation->toArray(), $args);
        }

    }
}