<?php

namespace spec\Kiboko\Component\ETL\Bucket;

use Kiboko\Component\ETL\Bucket\EmptyresultBucket;
use Kiboko\Component\ETL\Contracts\AcceptanceResultBucketInterface;
use Kiboko\Component\ETL\Contracts\RejectionResultBucketInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmptyResultBucketSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EmptyresultBucket::class);
        $this->shouldBeAnInstanceOf(AcceptanceResultBucketInterface::class);
        $this->shouldBeAnInstanceOf(RejectionResultBucketInterface::class);
    }

    function it_has_empty_acceptance()
    {
        $this->walkAcceptance()->shouldHaveCount(0);
    }

    function it_has_empty_rejection()
    {
        $this->walkRejection()->shouldHaveCount(0);
    }
}
