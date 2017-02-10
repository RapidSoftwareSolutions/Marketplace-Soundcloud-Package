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
    $body['playlist']['title'] = $post_data['args']['playlistTitle'];
    $body['playlist']['sharing'] = $post_data['args']['playlistSharing'];
    $body['playlist']['embeddable_by'] = $post_data['args']['embeddableBy'];
    $body['playlist']['purchase_url'] = $post_data['args']['purchaseUrl'];
    $body['playlist']['description'] = $post_data['args']['playlistDescription'];
    $body['playlist']['genre'] = $post_data['args']['genre'];
    $body['playlist']['tag_list'] = $post_data['args']['tagList'];
    $body['playlist']['label_id'] = $post_data['args']['labelId'];
    $body['playlist']['label_name'] = $post_data['args']['labelName'];
    $body['playlist']['release'] = $post_data['args']['releaseNumber'];
    $body['playlist']['release_day'] = $post_data['args']['releaseDay'];
    $body['playlist']['release_month'] = $post_data['args']['releaseMonth'];
    $body['playlist']['release_year'] = $post_data['args']['releaseYear'];
    $body['playlist']['streamable'] = $post_data['args']['streamable'];
    $body['playlist']['downloadable'] = $post_data['args']['downloadable'];
    $body['playlist']['ean'] = $post_data['args']['ean'];
    $body['playlist']['playlist_type'] = $post_data['args']['playlistType'];

    foreach ($post_data['args']['tracks'] as $track) {
        $body['playlist']['tracks'][]['id'] = $track;
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