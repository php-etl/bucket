<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket\Tests\Unit;

use Kiboko\Component\Bucket\IteratorRejectionResultBucket;
use Kiboko\Contract\Bucket\RejectionResultBucketInterface;
use PHPUnit\Framework\TestCase;

final class IteratorRejectionResultBucketTest extends TestCase
{
    public function testItIsInitializable(): void
    {
        $bucket = new IteratorRejectionResultBucket(
            'Lorem ipsum dolor sit amet',
            new \Exception('Lorem ipsum dolor sit amet'),
            new \EmptyIterator()
        );

        $this->assertInstanceOf(IteratorRejectionResultBucket::class, $bucket);
        $this->assertInstanceOf(RejectionResultBucketInterface::class, $bucket);
    }

    public function testItHasNonEmptyRejection(): void
    {
        $bucket = new IteratorRejectionResultBucket(
            'Lorem ipsum dolor sit amet',
            new \Exception('Lorem ipsum dolor sit amet'),
            new \ArrayIterator([
                new \stdClass(),
                new \stdClass(),
                new \stdClass(),
            ])
        );

        $this->assertCount(3, iterator_to_array($bucket->walkRejection()));
    }
}
