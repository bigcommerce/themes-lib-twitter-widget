<?php

namespace App\Libraries\BigCommerce;

use App\Libraries\BigCommerce\BigCommerceApiClient;

class BigCommerceTemplates
{
    public function __construct($context, $token)
    {
        $this->client = new BigCommerceApiClient($context, $token);
        $template = $this->updateClientTemplate();
    }

    public function getClientUuid()
    {
        $templates = $this->client->get('content/widget-templates');

        foreach ($templates as $template) {
            if ($template->schema) {
                if ($template->schema[0]->slug === 'pxu-twitter-widget') {
                    return $template->uuid;
                }
            }
        }
        return null;
    }

    private function getMostRecentTemplate()
    {
        return [
            'version' => '1',
            'template' => view('template')->render()
        ];
    }

    public function updateClientTemplate()
    {
        $clientUuid = $this->getClientUuid();
        $recentTemplate = $this->getMostRecentTemplate();

        $newClientTemplate = [
            "name"=> "Twitter Widget",
            "template"=> $recentTemplate['template'],
            "schema"=> [
                [
                    "slug" => 'pxu-twitter-widget',
                    "version"=> $recentTemplate['version']
                ]
            ]
        ];

        if ($clientUuid) {
            $response = $this->client->put('content/widget-templates/' . $clientUuid,
                ['json' => $newClientTemplate]);
        } else {
            $response = $this->client->post('content/widget-templates',
                ['json' => $newClientTemplate]);
        }

        return $response;
    }
}
