<?php

namespace Tests\TestUtils;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Mod;

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
    public function assertRelation(string $sourceClassName, string $relationClassName, string $relationAttributeName)
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
}