<?php

namespace spec\Kiboko\Component\Bucket;

use Kiboko\Component\Bucket\RejectionResultBucket;
use Kiboko\Contract\Bucket\RejectionResultBucketInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RejectionResultBucketSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RejectionResultBucket::class);
        $this->shouldBeAnInstanceOf(RejectionResultBucketInterface::class);
    }

    function it_has_non_empty_rejection()
    {
        $this->beConstructedWith(
            new \stdClass(),
            new \stdClass(),
            new \stdClass()
        );

        $this->walkRejection()->shouldHaveCount(3);
    }
}
