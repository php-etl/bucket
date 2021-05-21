<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;

final class AcceptanceResultBucket implements AcceptanceResultBucketInterface
{
    /** @var array<mixed> */
    private iterable $values;

    /**
     * @param array<mixed> $values
     */
    public function __construct(...$values)
    {
        $this->values = $values;
    }

    /**
     * @param array<mixed> $values
     */
    public function accept(...$values): self
    {
        array_push($this->values, ...$values);

        return $this;
    }

    public function walkAcceptance(): iterable
    {
        return new \ArrayIterator($this->values);
    }
}
