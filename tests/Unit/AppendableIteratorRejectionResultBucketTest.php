<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket\Tests\Unit;

use Kiboko\Component\Bucket\AppendableIteratorRejectionResultBucket;
use Kiboko\Contract\Bucket\RejectionResultBucketInterface;
use PHPUnit\Framework\TestCase;

final class AppendableIteratorRejectionResultBucketTest extends TestCase
{
    public function testItIsInitializable(): void
    {
        $bucket = new AppendableIteratorRejectionResultBucket();

        $this->assertInstanceOf(AppendableIteratorRejectionResultBucket::class, $bucket);
        $this->assertInstanceOf(RejectionResultBucketInterface::class, $bucket);
    }

    public function testItHasNonEmptyRejection(): void
    {
        $bucket = new AppendableIteratorRejectionResultBucket(
            new \ArrayIterator([
                new \stdClass(),
                new \stdClass(),
                new \stdClass(),
            ])
        );

        $this->assertCount(3, iterator_to_array($bucket->walkRejection()));
    }

    public function testItCanAppendRejection(): void
    {
        $bucket = new AppendableIteratorRejectionResultBucket(new \EmptyIterator());

        $bucket->append(
            new \ArrayIterator([
                new \stdClass(),
                new \stdClass(),
            ])
        );

        $bucket->append(
            new \ArrayIterator([
                new \stdClass(),
            ])
        );

        $this->assertCount(3, iterator_to_array($bucket->walkRejection()));
    }
}
