<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type of non-empty-array<array-key, mixed>|object
 *
 * @implements Contract\AcceptanceResultBucketInterface<Type>
 */
final class AcceptanceResultBucket implements Contract\AcceptanceResultBucketInterface
{
    /** @var array<int, Type> */
    private array $values;

    /** @param Type ...$values */
    public function __construct(...$values)
    {
        $this->values = array_values($values);
    }

    /**
     * @param Type ...$values
     *
     * @return AcceptanceResultBucket<Type>
     */
    public function accept(...$values): self
    {
        array_push($this->values, ...$values);

        return $this;
    }

    /** @return iterable<Type> */
    public function walkAcceptance(): iterable
    {
        return new \ArrayIterator($this->values);
    }
}
