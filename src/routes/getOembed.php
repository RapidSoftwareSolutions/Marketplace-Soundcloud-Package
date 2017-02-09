<?php
$app->post('/api/Soundcloud/getOembed', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['link']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = 'http://soundcloud.com/oembed';
    $query['format'] = 'json';
    $query['url'] = $post_data['args']['link'];

    if (isset($post_data['args']['maxWidth'])){
        $query['maxwidth'] = $post_data['args']['maxWidth'];
    };
    if (isset($post_data['args']['maxHeight'])){
        $query['maxheight'] = $post_data['args']['maxHeight'];
    };
    if (isset($post_data['args']['color'])){
        $query['color'] = $post_data['args']['color'];
    };
    if (isset($post_data['args']['autoPlay'])){
        $query['auto_play'] = $post_data['args']['autoPlay'];
    };
    if (isset($post_data['args']['showComments'])){
        $query['show_comments'] = $post_data['args']['showComments'];
    };
    if (isset($post_data['args']['iframe'])){
        $query['iframe'] = $post_data['args']['iframe'];
    }

    //requesting remote API
    $client = new GuzzleHttp\Client();

    try {

        $resp = $client->get($query_str, [
            'query' => $query,
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