<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type
 *
 * @implements Contract\RejectionResultBucketInterface<Type>
 */
final class RejectionWithReasonResultBucket implements Contract\RejectionResultBucketInterface
{
    public function __construct(private mixed $value, private ?string $reason = null) {}

    public function reject($value, $reason): self
    {
        $this->value = $value;
        $this->reason = $reason;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    /** @return iterable<Type> */
    public function walkRejection(): iterable
    {
        return new \ArrayIterator([$this->value]);
    }
}
