<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type of non-empty-array<array-key, mixed>|object
 *
 * @implements Contract\RejectionResultBucketInterface<Type>
 */
final readonly class IteratorRejectionResultBucket implements Contract\RejectionResultBucketInterface
{
    /** @param \Iterator<int, Type> $iterator */
    public function __construct(
        private string $reason,
        private ?\Throwable $exception,
        private \Iterator $iterator,
    ) {}

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

    /** @return iterable<int, Type> */
    public function walkRejection(): iterable
    {
        return $this->iterator;
    }
}
