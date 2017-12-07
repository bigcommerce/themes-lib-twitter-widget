<?php
namespace App\Libraries\BigCommerce;

use App\Libraries\BigCommerce\BigCommerceApiClient;
use App\Libraries\BigCommerce\BigCommerceQueries;
use App\Libraries\BigCommerce\BigCommerceTemplates;

class BigCommerceWidgets
{
    public function __construct($context, $token)
    {
        $this->client = new BigCommerceApiClient($context, $token);
        $templates = new BigCommerceTemplates($context, $token);
        $this->templateID = $templates->getClientUuid();
        $queries = new BigCommerceQueries();
        $this->user = $queries->getUser($context);
    }

    public function createWidget()
    {
        $deletedWidgetCount = $this->deleteWidgets();

        $widget = $this->client->post('content/widgets', ['json'=>[
            'name'=> 'Twitter Widget',
            'widget_template_uuid'=> $this->templateID,
            'widget_configuration' => [
                'handle' => $this->user->twitter_handle,
                'maxTweets' => $this->user->number_posts
            ]
        ]]);

        $placement = $this->client->post('content/placements', ['json'=>[
            'widget_uuid'=>$widget->uuid,
            'region'=>'home_above_footer',
            'template_file'=>'pages/home',
            'status'=>'active'
        ]]);

        return [
            'deletedWidgetCount' => $deletedWidgetCount,
            'newWidget' => $widget,
            'newPlacement' => $placement
        ];
    }

    private function deleteWidgets()
    {
        $widgets = $this->client->get('content/widgets');
        $deletedWidgetCount = 0;
        foreach ($widgets as $widget) {
            if ($widget->widget_template->uuid === $this->templateID) {
                $this->client->delete('content/widgets/' . $widget->uuid);
                $deletedWidgetCount++;
            }
        }

        return $deletedWidgetCount;
    }
}
