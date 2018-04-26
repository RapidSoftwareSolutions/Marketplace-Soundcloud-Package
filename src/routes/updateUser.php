<?php
$app->post('/api/Soundcloud/updateUser', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'].'/me?oauth_token='.$post_data['args']['accessToken'];

    //requesting remote API
    $client = new GuzzleHttp\Client();
    if (isset($post_data['args']['username']) && (strlen($post_data['args']['username'])>0)) {
        $body[] = [
            'name' => 'user[username]',
            'contents' => $post_data['args']['username']
        ];
    };
    if (isset($post_data['args']['description']) && (strlen($post_data['args']['description'])>0)) {
        $body[] = [
            'name' => 'user[description]',
            'contents' => $post_data['args']['description']
        ];
    }
    if (isset($post_data['args']['website']) && (strlen($post_data['args']['website'])>0)) {
        $body[] = [
            'name' => 'user[website]',
            'contents' => $post_data['args']['website']
        ];
    };
    if (isset($post_data['args']['websiteTitle']) && (strlen($post_data['args']['websiteTitle'])>0)) {
        $body[] = [
            'name' => 'user[website_title]',
            'contents' => $post_data['args']['websiteTitle']
        ];
    };
    if (isset($post_data['args']['avatar']) && (strlen($post_data['args']['avatar'])>0)) {
        $body[] = [
            'name' => 'user[avatar_data]',
            'contents' => fopen($post_data['args']['avatar'], 'r'),
            'filename' => 'avatar.jpg'
        ];
    };

    try {

        $resp = $client->request('PUT', $query_str, [
            'multipart' => $body,
            'verify' => false
        ]);

        $responseBody = $resp->getBody()->getContents();
        $rawBody = json_decode($resp->getBody());

        $all_data[] = $rawBody;
        if ($response->getStatusCode() == '200') {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($all_data) ? $all_data : json_decode($all_data);
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody();
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    } catch (GuzzleHttp\Exception\BadResponseException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    }


    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});