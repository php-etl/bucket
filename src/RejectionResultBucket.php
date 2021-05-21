<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket\RejectionResultBucketInterface;

final class RejectionResultBucket implements RejectionResultBucketInterface
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
    public function reject(...$values): self
    {
        array_push($this->values, ...$values);

        return $this;
    }

    public function walkRejection(): iterable
    {
        return new \ArrayIterator($this->values);
    }
}
