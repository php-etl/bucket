<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket\Tests\Unit;

use Kiboko\Component\Bucket\IteratorAcceptanceResultBucket;
use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;
use PHPUnit\Framework\TestCase;

final class IteratorAcceptanceResultBucketTest extends TestCase
{
    public function testItIsInitializable(): void
    {
        $bucket = new IteratorAcceptanceResultBucket(new \EmptyIterator());

        $this->assertInstanceOf(IteratorAcceptanceResultBucket::class, $bucket);
        $this->assertInstanceOf(AcceptanceResultBucketInterface::class, $bucket);
    }

    public function testItHasNonEmptyAcceptance(): void
    {
        $bucket = new IteratorAcceptanceResultBucket(
            new \ArrayIterator([
                new \stdClass(),
                new \stdClass(),
                new \stdClass(),
            ])
        );

        $this->assertCount(3, iterator_to_array($bucket->walkAcceptance()));
    }
}
