<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket\RejectionResultBucketInterface;

final class RejectionResultBucket implements RejectionResultBucketInterface
{
    /** @var array<int, mixed> */
    private $values;

    /**
     * @param array<int, mixed> $values
     */
    public function __construct(...$values)
    {
        $this->values = $values;
    }

    public function walkRejection(): iterable
    {
        return new \ArrayIterator($this->values);
    }
}
