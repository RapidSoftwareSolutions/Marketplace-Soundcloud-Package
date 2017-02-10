<?php
$app->post('/api/Soundcloud/searchTracks', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['clientId']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] . '/tracks?client_id=' . $post_data['args']['clientId'];

    //optional search parameters
    if (isset($post_data['args']['searchString'])) {
        $query_str .= '&q=' . $post_data['args']['searchString'];
    };
    if (isset($post_data['args']['tags'])) {
        $query_str .= '&tags=' . $post_data['args']['tags'];
    };
    if (isset($post_data['args']['filter'])) {
        $query_str .= '&filter=' . $post_data['args']['filter'];
    };
    if (isset($post_data['args']['license'])) {
        $query_str .= '&license=' . $post_data['args']['license'];
    };
    if (isset($post_data['args']['bpm[from]'])) {
        $query_str .= '&bpm[from]=' . $post_data['args']['bpmFrom'];
    };
    if (isset($post_data['args']['bpm[to]'])) {
        $query_str .= '&bpm[to]=' . $post_data['args']['bpmTo'];
    };
    if (isset($post_data['args']['duration[from]'])) {
        $query_str .= '&duration[from]=' . $post_data['args']['durationFrom'];
    };
    if (isset($post_data['args']['duration[to]'])) {
        $query_str .= '&duration[to]=' . $post_data['args']['durationTo'];
    };
    if (isset($post_data['args']['created_at[from]'])) {
        $query_str .= '&created_at[from]=' . $post_data['args']['createdAtFrom'];
    };
    if (isset($post_data['args']['created_at[to]'])) {
        $query_str .= '&created_at[to]=' . $post_data['args']['createdAtTo'];
    };
    if (isset($post_data['args']['ids'])) {
        $query_str .= '&ids=' . $post_data['args']['ids'];
    };
    if (isset($post_data['args']['genres'])) {
        $query_str .= '&genres=' . $post_data['args']['genres'];
    };
    if (isset($post_data['args']['types'])) {
        $query_str .= '&types=' . $post_data['args']['types'];
    };

    //requesting remote API
    $client = new GuzzleHttp\Client();

    try {

        $resp = $client->get($query_str, [
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