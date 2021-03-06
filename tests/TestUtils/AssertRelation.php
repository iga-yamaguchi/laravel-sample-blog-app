<?php

namespace Tests\TestUtils;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait AssertRelation
{
    abstract public function assertEquals($expected, $actual, $message = '', $delta = 0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false);

    /**
     * Assert a model relation.
     *
     * @param string $sourceClassName
     * @param string $relationClassName
     * @param string $relationAttributeName
     */
    public function assertHasMany(string $sourceClassName, string $relationClassName, string $relationAttributeName)
    {
        /** @var Collection $relationTargets */
        $relationTargets = factory($relationClassName, 3)->create();
        /** @var Model $source */
        $source = factory($sourceClassName)->create();

        $source->$relationAttributeName()->saveMany($relationTargets);

        $this->assertEquals($relationTargets->count(), $source->$relationAttributeName->count());

        /**
         * @var int   $key
         * @var Model $relation
         */
        foreach ($source->$relationAttributeName as $key => $relation) {
            $args = $relationTargets[$key]->toArray();

            $this->assertEquals($relation->toArray(), $args);
        }
    }

    /**
     * Assert a model relation.
     *
     * @param string $sourceClassName
     * @param string $relationClassName
     * @param string $relationAttributeName
     */
    public function assertBelongsToMany(string $sourceClassName, string $relationClassName, string $relationAttributeName)
    {
        /** @var Collection $relationTargets */
        $relationTargets = factory($relationClassName, 3)->create();
        /** @var Model $source */
        $source = factory($sourceClassName)->create();

        $ids = $relationTargets->pluck('id');
        $source->$relationAttributeName()->attach($ids);

        $this->assertEquals($relationTargets->count(), $source->$relationAttributeName->count());

        /**
         * @var int   $key
         * @var Model $relation
         */
        foreach ($source->$relationAttributeName as $key => $relation) {
            $args = $relationTargets[$key]->toArray();

            $this->assertEquals($relation->toArray(), $args);
        }

    }

    /**
     * Assert a model relation.
     *
     * @param string $sourceClassName
     * @param string $relationClassName
     * @param string $relationAttributeName
     */
    public function assertBelongsTo(string $sourceClassName, string $relationClassName, string $relationAttributeName)
    {
        /** @var Model $relationTarget */
        $relationTarget = factory($relationClassName)->create();
        /** @var Model $source */
        $source = factory($sourceClassName)->create();

        $source->$relationAttributeName()->associate($relationTarget);
        $source->save();

        $this->assertTrue($relationTarget->is($source->$relationAttributeName));
    }
}