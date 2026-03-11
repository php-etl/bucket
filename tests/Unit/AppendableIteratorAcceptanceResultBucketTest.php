<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket\Tests\Unit;

use Kiboko\Component\Bucket\AppendableIteratorAcceptanceResultBucket;
use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;
use PHPUnit\Framework\TestCase;

final class AppendableIteratorAcceptanceResultBucketTest extends TestCase
{
    public function testItIsInitializable(): void
    {
        $bucket = new AppendableIteratorAcceptanceResultBucket();

        $this->assertInstanceOf(AppendableIteratorAcceptanceResultBucket::class, $bucket);
        $this->assertInstanceOf(AcceptanceResultBucketInterface::class, $bucket);
    }

    public function testItHasNonEmptyAcceptance(): void
    {
        $bucket = new AppendableIteratorAcceptanceResultBucket(
            new \ArrayIterator([
                new \stdClass(),
                new \stdClass(),
                new \stdClass(),
            ])
        );

        $this->assertCount(3, iterator_to_array($bucket->walkAcceptance()));
    }

    public function testItCanAppendAcceptance(): void
    {
        $bucket = new AppendableIteratorAcceptanceResultBucket(new \EmptyIterator());

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

        $this->assertCount(3, iterator_to_array($bucket->walkAcceptance()));
    }
}
