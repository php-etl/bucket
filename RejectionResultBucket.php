<?php

namespace Kiboko\Component\ETL\Bucket;

use Kiboko\Component\ETL\Contracts\RejectionResultBucketInterface;

final class RejectionResultBucket implements RejectionResultBucketInterface
{
    /**
     * @var array
     */
    private $values;

    /**
     * @param mixed[] $values
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
