<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type
 *
 * @implements Contract\AcceptanceResultBucketInterface<Type>
 *
 * @deprecated This class is too complex and breaks the Least-surprise principle.
 */
final readonly class AppendableIteratorAcceptanceResultBucket implements Contract\AcceptanceResultBucketInterface
{
    /** @var \AppendIterator<int, Type, \Iterator<int, Contract\AcceptanceResultBucketInterface<Type>>> */
    private \AppendIterator $iterator;

    /** @param \Iterator<int, Contract\AcceptanceResultBucketInterface<Type>> ...$iterators */
    public function __construct(\Iterator ...$iterators)
    {
        $this->iterator = new \AppendIterator();
        foreach ($iterators as $iterator) {
            $this->iterator->append($iterator);
        }
    }

    /** @param \Iterator<int, Contract\AcceptanceResultBucketInterface<Type>> ...$iterators */
    public function append(\Iterator ...$iterators): void
    {
        foreach ($iterators as $iterator) {
            $this->iterator->append($iterator);
        }
    }

    /** @return iterable<int, Type> */
    public function walkAcceptance(): iterable
    {
        return $this->iterator;
    }
}
