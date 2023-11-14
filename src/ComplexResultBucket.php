<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type
 *
 * @implements Contract\AcceptanceResultBucketInterface<Type>
 * @implements Contract\RejectionResultBucketInterface<Type>
 */
final class ComplexResultBucket implements Contract\AcceptanceResultBucketInterface, Contract\RejectionResultBucketInterface
{
    /** @var array<Contract\AcceptanceResultBucketInterface<Type>> */
    private array $acceptances;
    /** @var array<Contract\RejectionResultBucketInterface<Type>> */
    private array $rejections;

    /** @param Contract\AcceptanceResultBucketInterface<Type>|Contract\RejectionResultBucketInterface<Type> ...$buckets */
    public function __construct(Contract\AcceptanceResultBucketInterface|Contract\RejectionResultBucketInterface ...$buckets)
    {
        $this->acceptances = array_filter(
            $buckets,
            fn (Contract\ResultBucketInterface $bucket) => $bucket instanceof Contract\AcceptanceResultBucketInterface
        );

        $this->rejections = array_filter(
            $buckets,
            fn (Contract\ResultBucketInterface $bucket) => $bucket instanceof Contract\RejectionResultBucketInterface
        );
    }

    /** @param Type ...$values */
    public function accept(...$values): void
    {
        $this->acceptances[] = new AcceptanceResultBucket(...$values);
    }

    /** @param Type ...$values */
    public function reject(string $reason, \Throwable $exception, ...$values): void
    {
        $this->rejections[] = new RejectionResultBucket($reason, $exception, ...$values);
    }

    public function reasons(): ?array
    {
        return array_reduce(
            array_map(
                fn (Contract\RejectionResultBucketInterface $rejection): ?array => $rejection->reasons(),
                $this->rejections
            ),
            function (array $carry, ?array $item): array {
                if (null !== $item) {
                    array_push($carry, ...$item);
                }

                return $carry;
            },
            []
        );
    }

    public function exceptions(): ?array
    {
        return array_reduce(
            array_map(
                fn (Contract\RejectionResultBucketInterface $rejection): ?array => $rejection->exceptions(),
                $this->rejections
            ),
            function (array $carry, ?array $item): array {
                if (null !== $item) {
                    array_push($carry, ...$item);
                }

                return $carry;
            },
            []
        );
    }

    public function walkAcceptance(): iterable
    {
        $iterator = new \AppendIterator();
        foreach ($this->acceptances as $child) {
            /** @var array<Type>|\Traversable<Type> $acceptance */
            $acceptance = $child->walkAcceptance();
            if ($acceptance instanceof \Iterator) {
                $iterator->append($acceptance);
            } elseif (\is_array($acceptance)) {
                $iterator->append(new \ArrayIterator($acceptance));
            } else {
                $iterator->append(new \IteratorIterator($acceptance));
            }
        }

        return $iterator;
    }

    public function walkRejection(): iterable
    {
        $iterator = new \AppendIterator();
        foreach ($this->rejections as $child) {
            /** @var array<Type>|\Traversable<Type> $rejection */
            $rejection = $child->walkRejection();
            if ($rejection instanceof \Iterator) {
                $iterator->append($rejection);
            } elseif (\is_array($rejection)) {
                $iterator->append(new \ArrayIterator($rejection));
            } else {
                $iterator->append(new \IteratorIterator($rejection));
            }
        }

        return $iterator;
    }
}
