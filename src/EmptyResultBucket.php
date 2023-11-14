<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type
 *
 * @implements Contract\ResultBucketInterface<Type>
 */
final class EmptyResultBucket implements Contract\ResultBucketInterface
{
}
