<?php
$app->post('/api/Soundcloud/updatePlaylist', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'playlistId']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] . '/me/playlists/' . $post_data['args']['playlistId'] . '?oauth_token=' . $post_data['args']['accessToken'];

    //requesting remote API
    $client = new GuzzleHttp\Client();
    //optional parameters
    if (isset($post_data['args']['playlistTitle']) && (strlen($post_data['args']['playlistTitle']) > 0)) {
        $body['playlist']['title'] = $post_data['args']['playlistTitle'];
    };
    if (isset($post_data['args']['playlistSharing']) && (strlen($post_data['args']['playlistSharing']) > 0)) {
        $body['playlist']['sharing'] = $post_data['args']['playlistSharing'];
    };
    if (isset($post_data['args']['embeddableBy']) && (strlen($post_data['args']['embeddableBy']) > 0)) {
        $body['playlist']['embeddable_by'] = $post_data['args']['embeddableBy'];
    };
    if (isset($post_data['args']['purchaseUrl']) && (strlen($post_data['args']['purchaseUrl']) > 0)) {
        $body['playlist']['purchase_url'] = $post_data['args']['purchaseUrl'];
    };
    if (isset($post_data['args']['playlistDescription']) && (strlen($post_data['args']['playlistDescription']) > 0)) {
        $body['playlist']['description'] = $post_data['args']['playlistDescription'];
    };
    if (isset($post_data['args']['genre']) && (strlen($post_data['args']['genre']) > 0)) {
        $body['playlist']['genre'] = $post_data['args']['genre'];
    };
    if (isset($post_data['args']['tagList']) && (strlen($post_data['args']['tagList']) > 0)) {
        $body['playlist']['tag_list'] = $post_data['args']['tagList'];
    };
    if (isset($post_data['args']['labelId']) && (strlen($post_data['args']['labelId']) > 0)) {
        $body['playlist']['label_id'] = $post_data['args']['labelId'];
    };
    if (isset($post_data['args']['labelName']) && (strlen($post_data['args']['labelName']) > 0)) {
        $body['playlist']['label_name'] = $post_data['args']['labelName'];
    };
    if (isset($post_data['args']['releaseNumber']) && (strlen($post_data['args']['releaseNumber']) > 0)) {
        $body['playlist']['release'] = $post_data['args']['releaseNumber'];
    };
    if (isset($post_data['args']['releaseDay']) && (strlen($post_data['args']['releaseDay']) > 0)) {
        $body['playlist']['release_day'] = $post_data['args']['releaseDay'];
    };
    if (isset($post_data['args']['releaseMonth']) && (strlen($post_data['args']['releaseMonth']) > 0)) {
        $body['playlist']['release_month'] = $post_data['args']['releaseMonth'];
    };
    if (isset($post_data['args']['releaseYear']) && (strlen($post_data['args']['releaseYear']) > 0)) {
        $body['playlist']['release_year'] = $post_data['args']['releaseYear'];
    };
    if (isset($post_data['args']['streamable']) && (strlen($post_data['args']['streamable']) > 0)) {
        $body['playlist']['streamable'] = $post_data['args']['streamable'];
    };
    if (isset($post_data['args']['downloadable']) && (strlen($post_data['args']['downloadable']) > 0)) {
        $body['playlist']['downloadable'] = $post_data['args']['downloadable'];
    };
    if (isset($post_data['args']['ean']) && (strlen($post_data['args']['ean']) > 0)) {
        $body['playlist']['ean'] = $post_data['args']['ean'];
    };
    if (isset($post_data['args']['playlistType']) && (strlen($post_data['args']['playlistType']) > 0)) {
        $body['playlist']['playlist_type'] = $post_data['args']['playlistType'];
    };
    if (isset($post_data['args']['tracks']) && (count($post_data['args']['tracks']) > 0)) {
        foreach ($post_data['args']['tracks'] as $track) {
            $body['playlist']['tracks'][]['id'] = $track;
        };
    };

    try {

        $resp = $client->put($query_str, [
            'json' => $body,
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