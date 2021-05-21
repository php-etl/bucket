<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

trigger_deprecation('php-etl/bucket', '0.2', 'The "%s" class is deprecated, use "%s" instead.', 'Kiboko\\Component\\Bucket\\RejectionAppendableResultBucket', AppendableIteratorRejectionResultBucket::class);

/**
 * @deprecated since Satellite 0.2, use Kiboko\Component\Bucket\AppendableIteratorRejectionResultBucket instead.
 */
class_alias(AppendableIteratorRejectionResultBucket::class, 'Kiboko\\Component\\Bucket\\RejectionAppendableResultBucket');
