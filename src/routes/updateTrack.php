<?php
$app->post('/api/Soundcloud/updateTrack', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'trackId']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] . '/tracks/'.$post_data['args']['trackId'].'?oauth_token=' . $post_data['args']['accessToken'];
    $body[] = [
        'name' => 'track[title]',
        'contents' => $post_data['args']['trackTitle']
    ];
    $body[] = [
        'name' => 'track[sharing]',
        'contents' => $post_data['args']['trackSharing']
    ];
    $body[] = [
        'name' => 'track[embeddable_by]',
        'contents' => $post_data['args']['embeddableBy']
    ];
    $body[] = [
        'name' => 'track[purchase_url]',
        'contents' => $post_data['args']['purchaseUrl']
    ];
    $body[] = [
        'name' => 'track[description]',
        'contents' => $post_data['args']['trackDescription']
    ];
    $body[] = [
        'name' => 'track[genre]',
        'contents' => $post_data['args']['genre']
    ];
    $body[] = [
        'name' => 'track[tag_list]',
        'contents' => $post_data['args']['tagList']
    ];
    $body[] = [
        'name' => 'track[label_id]',
        'contents' => $post_data['args']['labelId']
    ];
    $body[] = [
        'name' => 'track[label_name]',
        'contents' => $post_data['args']['labelName']
    ];
    $body[] = [
        'name' => 'track[release]',
        'contents' => $post_data['args']['releaseNumber']
    ];
    $body[] = [
        'name' => 'track[release_day]',
        'contents' => $post_data['args']['releaseDay']
    ];
    $body[] = [
        'name' => 'track[release_month]',
        'contents' => $post_data['args']['releaseMonth']
    ];
    $body[] = [
        'name' => 'track[release_year]',
        'contents' => $post_data['args']['releaseYear']
    ];
    $body[] = [
        'name' => 'track[streamable]',
        'contents' => $post_data['args']['streamable']
    ];
    $body[] = [
        'name' => 'track[downloadable]',
        'contents' => $post_data['args']['downloadable']
    ];
    $body[] = [
        'name' => 'track[license]',
        'contents' => $post_data['args']['license']
    ];
    $body[] = [
        'name' => 'track[track_type]',
        'contents' => $post_data['args']['trackType']
    ];
    $body[] = [
        'name' => 'track[bpm]',
        'contents' => $post_data['args']['bpm']
    ];
    $body[] = [
        'name' => 'track[commentable]',
        'contents' => $post_data['args']['commentable']
    ];
    $body[] = [
        'name' => 'track[isrc]',
        'contents' => $post_data['args']['isrc']
    ];
    $body[] = [
        'name' => 'track[key_signature]',
        'contents' => $post_data['args']['keySignature']
    ];

    $body[] =
        [
            'name' => 'track[asset_data]',
            'contents' => fopen($post_data['args']['trackFile'], 'r'),
            'filename' => $post_data['args']['trackTitle'].'.mp3'
        ];

    //requesting remote API
    $client = new GuzzleHttp\Client();

    try {

        $resp = $client->request('PUT', $query_str, [
            'headers' => ['Content-Length' => '1'],
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