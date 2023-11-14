<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type of non-empty-array<array-key, mixed>|object
 *
 * @implements Contract\RejectionResultBucketInterface<Type>
 */
final class RejectionResultBucket implements Contract\RejectionResultBucketInterface
{
    /** @var array<int, Type> */
    private array $values;

    /** @param Type ...$values */
    public function __construct(
        private readonly string $reason,
        private readonly ?\Throwable $exception,
        ...$values,
    ) {
        $this->values = array_values($values);
    }

    public function reasons(): ?array
    {
        return [$this->reason];
    }

    public function exceptions(): ?array
    {
        if ($this->exception === null) {
            return null;
        }

        return [$this->exception];
    }

    /**
     * @param Type ...$values
     *
     * @return RejectionResultBucket<Type>
     */
    public function reject(...$values): self
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
