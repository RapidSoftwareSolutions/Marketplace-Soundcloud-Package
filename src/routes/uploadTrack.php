<?php
$app->post('/api/Soundcloud/uploadTrack', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'trackTitle', 'trackFile']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] . '/tracks?oauth_token=' . $post_data['args']['accessToken'];
    $body[] = [
        'name' => 'track[title]',
        'contents' => $post_data['args']['trackTitle']
    ];
    if (isset($post_data['args']['trackSharing']) && (strlen($post_data['args']['trackSharing']) > 0)) {
        $body[] = [
            'name' => 'track[sharing]',
            'contents' => $post_data['args']['trackSharing']
        ];
    };
    if (isset($post_data['args']['embeddableBy']) && (strlen($post_data['args']['embeddableBy']) > 0)) {
        $body[] = [
            'name' => 'track[embeddable_by]',
            'contents' => $post_data['args']['embeddableBy']
        ];
    };
    if (isset($post_data['args']['purchaseUrl']) && (strlen($post_data['args']['purchaseUrl']) > 0)) {

        $body[] = [
            'name' => 'track[purchase_url]',
            'contents' => $post_data['args']['purchaseUrl']
        ];
    };
    if (isset($post_data['args']['trackDescription']) && (strlen($post_data['args']['trackDescription']) > 0)) {
        $body[] = [
            'name' => 'track[description]',
            'contents' => $post_data['args']['trackDescription']
        ];
    };
    if (isset($post_data['args']['genre']) && (strlen($post_data['args']['genre']) > 0)) {
        $body[] = [
            'name' => 'track[genre]',
            'contents' => $post_data['args']['genre']
        ];
    };
    if (isset($post_data['args']['tagList']) && (strlen($post_data['args']['tagList']) > 0)) {

        if (is_array($post_data['args']['tagList'])) {
            $body[] = [
                'name' => 'track[tag_list]',
                'contents' => implode(',', $post_data['args']['tagList'])
            ];
        } else {
            $body[] = [
                'name' => 'track[tag_list]',
                'contents' => $post_data['args']['tagList']
            ];
        }

    };
    if (isset($post_data['args']['labelId']) && (strlen($post_data['args']['labelId']) > 0)) {
        $body[] = [
            'name' => 'track[label_id]',
            'contents' => $post_data['args']['labelId']
        ];
    };
    if (isset($post_data['args']['labelName']) && (strlen($post_data['args']['labelName']) > 0)) {
        $body[] = [
            'name' => 'track[label_name]',
            'contents' => $post_data['args']['labelName']
        ];
    };
    if (isset($post_data['args']['releaseNumber']) && (strlen($post_data['args']['releaseNumber']) > 0)) {
        $body[] = [
            'name' => 'track[release]',
            'contents' => $post_data['args']['releaseNumber']
        ];
    };
    if (isset($post_data['args']['releaseDay']) && (strlen($post_data['args']['releaseDay']) > 0)) {
        $body[] = [
            'name' => 'track[release_day]',
            'contents' => $post_data['args']['releaseDay']
        ];
    };
    if (isset($post_data['args']['releaseMonth']) && (strlen($post_data['args']['releaseMonth']) > 0)) {
        $body[] = [
            'name' => 'track[release_month]',
            'contents' => $post_data['args']['releaseMonth']
        ];
    };
    if (isset($post_data['args']['releaseYear']) && (strlen($post_data['args']['releaseYear']) > 0)) {
        $body[] = [
            'name' => 'track[release_year]',
            'contents' => $post_data['args']['releaseYear']
        ];
    };
    if (isset($post_data['args']['streamable']) && (strlen($post_data['args']['streamable']) > 0)) {
        $body[] = [
            'name' => 'track[streamable]',
            'contents' => $post_data['args']['streamable']
        ];
    };
    if (isset($post_data['args']['downloadable']) && (strlen($post_data['args']['downloadable']) > 0)) {
        $body[] = [
            'name' => 'track[downloadable]',
            'contents' => $post_data['args']['downloadable']
        ];
    };
    if (isset($post_data['args']['license']) && (strlen($post_data['args']['license']) > 0)) {
        $body[] = [
            'name' => 'track[license]',
            'contents' => $post_data['args']['license']
        ];
    };
    if (isset($post_data['args']['trackType']) && (strlen($post_data['args']['trackType']) > 0)) {
        $body[] = [
            'name' => 'track[track_type]',
            'contents' => $post_data['args']['trackType']
        ];
    };
    if (isset($post_data['args']['bpm']) && (strlen($post_data['args']['bpm']) > 0)) {
        $body[] = [
            'name' => 'track[bpm]',
            'contents' => $post_data['args']['bpm']
        ];
    };
    if (isset($post_data['args']['commentable']) && (strlen($post_data['args']['commentable']) > 0)) {
        $body[] = [
            'name' => 'track[commentable]',
            'contents' => $post_data['args']['commentable']
        ];
    };
    if (isset($post_data['args']['isrc']) && (strlen($post_data['args']['isrc']) > 0)) {
        $body[] = [
            'name' => 'track[isrc]',
            'contents' => $post_data['args']['isrc']
        ];
    };
    if (isset($post_data['args']['videoUrl']) && (strlen($post_data['args']['videoUrl']) > 0)) {
        $body[] = [
            'name' => 'track[video_url]',
            'contents' => $post_data['args']['videoUrl']
        ];
    };
    if (isset($post_data['args']['keySignature']) && (strlen($post_data['args']['keySignature']) > 0)) {
        $body[] = [
            'name' => 'track[key_signature]',
            'contents' => $post_data['args']['keySignature']
        ];
    };
    $body[] =
        [
            'name' => 'track[asset_data]',
            'contents' => fopen($post_data['args']['trackFile'], 'r'),
            'filename' => 'track.mp3'
        ];

    if (isset($post_data['args']['artWorkFile']) && (strlen($post_data['args']['artWorkFile']) > 0)) {
        $body[] = [
            'name' => 'track[artwork_data]',
            'contents' => fopen($post_data['args']['artWorkFile'], 'r'),
            'filename' => 'artwork.jpg'
        ];
    };
    //requesting remote API
    $client = new GuzzleHttp\Client();

    try {

        $resp = $client->request('POST', $query_str, [
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