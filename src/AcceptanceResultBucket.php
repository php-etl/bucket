<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;

final class AcceptanceResultBucket implements AcceptanceResultBucketInterface
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

    public function walkAcceptance(): iterable
    {
        return new \ArrayIterator($this->values);
    }
}
