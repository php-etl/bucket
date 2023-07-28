<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;
use Kiboko\Contract\Pipeline\Rejection;

/**
 * @template Type
 *
 * @implements Contract\RejectionResultBucketInterface<Type>
 */
final class RejectionResultBucket implements Contract\RejectionResultBucketInterface
{
    /** @var array<int, Type> */
    private array $values;

    /** @param Type ...$values */
    public function __construct(Rejection|array ...$values)
    {
        $this->values = $values;
    }

    /**
     * @param Type ...$values
     *
     * @return RejectionResultBucket<Type>
     */
    public function reject(Rejection|array ...$values): self
    {
        array_push($this->values, ...$values);

        return $this;
    }

    /** @return iterable<Type> */
    public function walkRejection(): iterable
    {
        return new \ArrayIterator($this->values);
    }
}
