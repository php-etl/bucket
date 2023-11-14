<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type
 *
 * @implements Contract\RejectionResultBucketInterface<Type>
 *
 * @deprecated this class is too complex and breaks the Least-surprise principle
 */
final readonly class AppendableIteratorRejectionResultBucket implements Contract\RejectionResultBucketInterface
{
    /** @var \AppendIterator<int, Type, \Iterator<int, Contract\RejectionResultBucketInterface<Type>>> */
    private \AppendIterator $iterator;

    /** @param \Iterator<int, Contract\RejectionResultBucketInterface<Type>> ...$iterators */
    public function __construct(\Iterator ...$iterators)
    {
        $this->iterator = new \AppendIterator();
        foreach ($iterators as $iterator) {
            $this->iterator->append($iterator);
        }
    }

    public function reasons(): ?array
    {
        return null;
    }

    public function exceptions(): ?array
    {
        return null;
    }

    /** @param \Iterator<int, Contract\RejectionResultBucketInterface<Type>> ...$iterators */
    public function append(\Iterator ...$iterators): void
    {
        foreach ($iterators as $iterator) {
            $this->iterator->append($iterator);
        }
    }

    /** @return iterable<Type> */
    public function walkRejection(): iterable
    {
        return $this->iterator;
    }
}
