<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

trigger_deprecation('php-etl/bucket', '0.2', 'The "%s" class is deprecated, use "%s" instead.', 'Kiboko\\Component\\Bucket\\AcceptanceAppendableResultBucket', AppendableIteratorAcceptanceResultBucket::class);

/**
 * @deprecated since Satellite 0.2, use Kiboko\Component\Bucket\AppendableIteratorAcceptanceResultBucket instead.
 */
class_alias(AppendableIteratorAcceptanceResultBucket::class, 'Kiboko\\Component\\Bucket\\AcceptanceAppendableResultBucket');
