<?php

use opensrs\backwardcompatibility\dataconversion\domains\dnszone\DnsDelete;

/**
 * @group backwardcompatibility
 * @group dataconversion
 * @group dnszone
 * @group BC_DnsDelete
 */
class BC_DnsDeleteTest extends PHPUnit_Framework_TestCase
{
    protected $validSubmission = array(
        'data' => array(
            'domain' => '',
            ),
        );

    /**
     * Valid conversion should complete with no
     * exception thrown.
     *
     *
     * @group validconversion
     */
    public function testValidDataConversion()
    {
        $data = json_decode(json_encode($this->validSubmission));

        $data->data->domain = 'phptest'.time().'.com';

        $shouldMatchNewDataObject = new \stdClass();
        $shouldMatchNewDataObject->attributes = new \stdClass();

        $shouldMatchNewDataObject->attributes->domain = $data->data->domain;

        $ns = new DnsDelete();

        $newDataObject = $ns->convertDataObject($data);

        $this->assertTrue($newDataObject == $shouldMatchNewDataObject);
    }
}
