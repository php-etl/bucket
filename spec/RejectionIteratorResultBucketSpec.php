<?php

namespace spec\Kiboko\Component\ETL\Bucket;

use Kiboko\Component\ETL\Bucket\RejectionIteratorResultBucket;
use Kiboko\Component\ETL\Contracts\RejectionResultBucketInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RejectionIteratorResultBucketSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(new \EmptyIterator());

        $this->shouldHaveType(RejectionIteratorResultBucket::class);
        $this->shouldBeAnInstanceOf(RejectionResultBucketInterface::class);
    }

    function it_has_non_empty_rejection()
    {
        $this->beConstructedWith(
            new \ArrayIterator([
                new \stdClass(),
                new \stdClass(),
                new \stdClass(),
            ])
        );

        $this->walkRejection()->shouldHaveCount(3);
    }
}
