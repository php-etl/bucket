<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type of non-empty-array<array-key, mixed>|object
 *
 * @implements Contract\ResultBucketInterface<Type>
 */
final class EmptyResultBucket implements Contract\ResultBucketInterface
{
}
