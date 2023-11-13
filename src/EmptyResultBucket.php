<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @implements Contract\AcceptanceResultBucketInterface<mixed>
 * @implements Contract\RejectionResultBucketInterface<mixed>
 */
final class EmptyResultBucket implements Contract\AcceptanceResultBucketInterface, Contract\RejectionResultBucketInterface
{
    public function reasons(): ?array
    {
        return null;
    }

    public function exceptions(): ?array
    {
        return null;
    }

    public function walkAcceptance(): iterable
    {
        return new \EmptyIterator();
    }

    public function walkRejection(): iterable
    {
        return new \EmptyIterator();
    }
}
