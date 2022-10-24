<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Trusthub\V1\TrustProducts;

use Twilio\Http\Response;
use Twilio\Page;
use Twilio\Version;

class TrustProductsEvaluationsPage extends Page {
    /**
     * @param Version $version Version that contains the resource
     * @param Response $response Response from the API
     * @param array $solution The context solution
     */
    public function __construct(Version $version, Response $response, array $solution) {
        parent::__construct($version, $response);

        // Path Solution
        $this->solution = $solution;
    }

    /**
     * @param array $payload Payload response from the API
     * @return TrustProductsEvaluationsInstance \Twilio\Rest\Trusthub\V1\TrustProducts\TrustProductsEvaluationsInstance
     */
    public function buildInstance(array $payload): TrustProductsEvaluationsInstance {
        return new TrustProductsEvaluationsInstance(
            $this->version,
            $payload,
            $this->solution['trustProductSid']
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Trusthub.V1.TrustProductsEvaluationsPage]';
    }
}