<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

trigger_deprecation('php-etl/bucket', '0.2', 'The "%s" class is deprecated, use "%s" instead.', 'Kiboko\\Component\\Bucket\\AcceptanceIteratorResultBucket', IteratorAcceptanceResultBucket::class);

/**
 * @deprecated since Satellite 0.2, use Kiboko\Component\Bucket\IteratorAcceptanceResultBucket instead.
 */
class_alias(IteratorAcceptanceResultBucket::class, 'Kiboko\\Component\\Bucket\\AcceptanceIteratorResultBucket');
