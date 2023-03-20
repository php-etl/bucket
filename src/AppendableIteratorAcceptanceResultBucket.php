<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type
 *
 * @implements Contract\AcceptanceResultBucketInterface<Type>
 */
final class AppendableIteratorAcceptanceResultBucket implements Contract\AcceptanceResultBucketInterface
{
    /** @var \AppendIterator<Type> */
    private readonly \AppendIterator $iterator;

    /** @param \Iterator<Contract\AcceptanceResultBucketInterface<Type>> ...$iterators */
    public function __construct(\Iterator ...$iterators)
    {
        $this->iterator = new \AppendIterator();
        foreach ($iterators as $iterator) {
            $this->iterator->append($iterator);
        }
    }

    /** @param \Iterator<Contract\AcceptanceResultBucketInterface<Type>> ...$iterators */
    public function append(\Iterator ...$iterators): void
    {
        foreach ($iterators as $iterator) {
            $this->iterator->append($iterator);
        }
    }

    /** @return iterable<Type> */
    public function walkAcceptance(): iterable
    {
        return $this->iterator;
    }
}
