<?php

namespace Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Endpoint;

class GetTest extends \Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Runtime\Client\BaseEndpoint implements \Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Runtime\Client\Endpoint
{
    use \Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return '/test';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     *
     * @return null|\Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Model\DateTimeModel
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Model\DateTimeModel', 'json');
        }
    }
    public function getAuthenticationScopes(): array
    {
        return [];
    }
}