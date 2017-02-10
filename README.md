# Soundcloud Package
Integrate SoundCloud user, track and playlist information.
* Domain: soundcloud.com
* Credentials: clientId, clientSecret

## How to get credentials: 
0. Go to [Soundcloud website](http://soundcloud.com) 
1. Log in or create a new account
2. [Register an app](https://developers.soundcloud.com/)
3. After creation your app you will see Client ID and Client Secret

## Soundcloud.getAccessToken
Provides access tokens once a user has authorized your application.

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| The client id belonging to your application.
| clientSecret| credentials| The client secret belonging to your application
| redirectUri | String     | The redirect uri you have configured for your application
| code        | String     | The authorization code obtained when user is sent to redirectUri.

## Soundcloud.refreshToken
Refreshes expired token.

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| The client id belonging to your application.
| clientSecret| credentials| The client secret belonging to your application
| redirectUri | String     | The redirect uri you have configured for your application
| refreshToken| String     | Refresh token received when you received your access token.

## Soundcloud.getMe
Gets information about the authenticated user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.

## Soundcloud.getSingleUser
Gets information about single user.

| Field   | Type       | Description
|---------|------------|----------
| clientId| credentials| The client id belonging to your application.
| userId  | Number     | ID of the user.

## Soundcloud.getUserTracks
Gets information about tracks of the user.

| Field   | Type       | Description
|---------|------------|----------
| clientId| credentials| The client id belonging to your application.
| userId  | Number     | ID of the user.

## Soundcloud.getUserPlaylists
Gets information about playlists of the user.

| Field   | Type       | Description
|---------|------------|----------
| clientId| credentials| The client id belonging to your application.
| userId  | Number     | ID of the user.

## Soundcloud.getUserFollowings
Gets list of users who are followed by the user.

| Field   | Type       | Description
|---------|------------|----------
| clientId| credentials| The client id belonging to your application.
| userId  | Number     | ID of the user.

## Soundcloud.followUser
Adds user to followed.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| followingId| Number| ID of the user to follow.

## Soundcloud.unfollowUser
Removes user from followed .

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| followingId| Number| ID of the user to stop following.

## Soundcloud.getUserFollowers
Gets list of users who are following the user.

| Field   | Type  | Description
|---------|-------|----------
| clientId| String| The client id belonging to your application.
| userId  | Number| ID of the user.

## Soundcloud.getUserComments
Gets list of comments from this user.

| Field   | Type       | Description
|---------|------------|----------
| clientId| credentials| The client id belonging to your application.
| userId  | Number     | ID of the user.

## Soundcloud.getTracksLikedByUser
Gets list of comments from this user.

| Field   | Type       | Description
|---------|------------|----------
| clientId| credentials| The client id belonging to your application.
| userId  | Number     | ID of the user.

## Soundcloud.likeTrack
Adds track to favorites

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| trackId    | Number| ID of the track to favorite.

## Soundcloud.unlikeTrack
Removes track from favorites

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| trackId    | Number| ID of the track to favorite.

## Soundcloud.checkUserLikedTrack
Gets info about single track liked by user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| trackId    | Number| ID of the track to check.
| userId     | Number| ID of the user to check.

## Soundcloud.checkMeLikedTrack
Gets info about single track liked by current user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| trackId    | Number| ID of the track to check.

## Soundcloud.getUserWebProfiles
Gets list of web profiles.

| Field   | Type       | Description
|---------|------------|----------
| clientId| credentials| The client id belonging to your application.
| userId  | Number     | ID of the user.

## Soundcloud.getMyConnections
Gets list of connections for the current user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.

## Soundcloud.getMyTracks
Gets list of tracks for the current user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.

## Soundcloud.getMyPlaylists
Gets list of playlists for the current user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.

## Soundcloud.getMyFollowings
Gets list of users who are followed by the current user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.

## Soundcloud.getMyFollowers
Gets list of users who are following the current user

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.

## Soundcloud.getMyComments
Gets list of comments of the current user

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.

## Soundcloud.getTracksLikedByMe
Gets list of tracks favorited by the current user

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.

## Soundcloud.getMyWebProfiles
Gets list of web profiles of the current user

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.

## Soundcloud.getMyActivities
Gets list of acitivites for the current user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| limit      | Number| Number of activities to return.

## Soundcloud.getMyFollowedUsersRecentTracks
Gets recent tracks from users the logged-in user follows.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| limit      | Number| Number of activities to return.

## Soundcloud.getMySharedTracks
Gets recent exclusively shared tracks.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| limit      | Number| Number of activities to return.

## Soundcloud.getMyRecentTracksActivities
Gets recent activities on the logged-in users tracks.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| limit      | Number| Number of activities to return.

## Soundcloud.getUserSingleComment
Gets information about single comment.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| commentId  | Number| ID of the comment.

## Soundcloud.getComments
Gets list of comments.

| Field   | Type       | Description
|---------|------------|----------
| clientId| credentials| The client id belonging to your application.

## Soundcloud.searchUsers
Gets list of playlists.

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| The client id belonging to your application.
| searchString| String     | A string to search for.

## Soundcloud.searchPlaylists
Gets list of playlists.

| Field         | Type       | Description
|---------------|------------|----------
| clientId      | credentials| The client id belonging to your application.
| searchString  | String     | A string to search for. When this parameter is used, only compact representations are returned.
| representation| String     | compact (no track listing) or id (track listing only contains track IDs).

## Soundcloud.getSinglePlaylist
Gets information about single playlist.

| Field     | Type       | Description
|-----------|------------|----------
| clientId  | credentials| The client id belonging to your application.
| playlistId| Number     | ID of the playlist.

## Soundcloud.getRegisteredClientApplication
Gets list of registered applications.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.

## Soundcloud.getOembed
The SoundCloud oEmbed endpoint will serve the widget embed code for any SoundCloud URL pointing to a user, set, or a playlist. 

| Field       | Type   | Description
|-------------|--------|----------
| link        | String | A Soundcloud URL for a track, set, user.
| maxWidth    | Number | The maximum width in px.
| maxHeight   | Number | The maximum height in px. The default is 166px for tracks and 450px for sets. If using the flash widget, the default is 81px for tracks and 305px for sets.
| color       | String | The primary color of the widget as a hex triplet. (For example: ff0066).
| autoPlay    | Boolean| Whether the widget plays on load. Format: true OR false(default).
| showComments| Boolean| Whether the player displays timed comments. Format: true(default) OR false.
| iframe      | Boolean| Whether the new HTML5 Iframe-based Widget or the old Adobe Flash Widget will be returned. Format: true(default) OR false.

## Soundcloud.resolveResourcesFromURL
The resolve resource allows you to lookup and access API resources when you only know the SoundCloud.com URL.

| Field   | Type       | Description
|---------|------------|----------
| clientId| credentials| The client id belonging to your application.
| link    | String     | Link to the resource.

## Soundcloud.createMyConnection
Create connection representing the external profile (like twitter, tumblr or facebook profiles and pages)

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| redirectUri| String| Link to the page user has to be redirected.
| service    | String| The type of the described connection. Possible values: facebook_profile, twitter, myspace.

## Soundcloud.searchTracks
Gets list of tracks.

| Field        | Type       | Description
|--------------|------------|----------
| clientId     | credentials| The client id belonging to your application.
| searchString | String     | A string to search for.
| tags         | String     | A comma separated list of tags.
| filter       | String     | Possible values: all, public, private.
| license      | String     | Creative common license. Possible values: no-rights-reserved, all-rights-reserved, cc-by, cc-by-nc, cc-by-nd, cc-by-sa, cc-by-nc-nd, cc-by-nc-sa.
| bpmFrom      | Number     | Return tracks with at least this bpm value.
| bpmTo        | Number     | Return tracks with at most this bpm value.
| durationFrom | Number     | Return tracks with at least this duration (in millis).
| durationTo   | Number     | Return tracks with at most this duration (in millis).
| createdAtFrom| String     | (yyyy-mm-dd hh:mm:ss) return tracks created at this date or later.
| createdAtTo  | String     | (yyyy-mm-dd hh:mm:ss) return tracks created at this date or earlier.
| ids          | String     | A comma separated list of track ids to filter on.
| genres       | String     | A comma separated list of genres.
| types        | String     | A comma separated list of types.

## Soundcloud.getSingleTrack
Gets information about single playlist.

| Field   | Type       | Description
|---------|------------|----------
| clientId| credentials| The client id belonging to your application.
| trackId | Number     | ID of the track.

## Soundcloud.getTrackComments
Gets comments of the track.

| Field   | Type       | Description
|---------|------------|----------
| clientId| credentials| The client id belonging to your application.
| trackId | Number     | ID of the track.

## Soundcloud.getTrackSingleComment
Gets comment of the track.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| trackId    | Number| ID of the track.
| commentId  | Number| ID of the comment.

## Soundcloud.addTrackComment
Adds comment to the track.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| trackId    | Number| ID of the track.
| comment    | String| Content of the comment.

## Soundcloud.deleteTrackSingleComment
Adds comment to the track.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| trackId    | Number| ID of the track.
| commentId  | Number| ID of the comment.

## Soundcloud.getUsersLikedTrack
Gets users who liked this track.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| trackId    | Number| ID of the track.

## Soundcloud.getTrackSecretToken
Gets secret token of the track.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| trackId    | Number| ID of the track.

## Soundcloud.updateTrackSecretToken
Updates secret token of the track.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| trackId    | Number| ID of the track.

## Soundcloud.checkUserFollowing
Check if user if following other user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| userId     | Number| ID of the user.
| followingId| Number| ID of the user who may be followed.

## Soundcloud.checkMeFollowing
Check if user if following other user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| followingId| Number| ID of the user who may be followed.

## Soundcloud.deleteMyWebProfile
Deletes web-profile of the user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| profileId  | Number| ID web-profile.

## Soundcloud.createPlaylist
Creates playlist

| Field              | Type   | Description
|--------------------|--------|----------
| accessToken        | String | Access Token received from oAuth.
| playlistTitle      | String | Title of the playlist.
| playlistSharing    | String | Sharing type of the playlist. Possible values: public OR private.
| tracks             | Array  | Array of tracks IDs to add to the playlist.
| embeddableBy       | String | Who can embed this playlist. Possible value: all OR me OR none.
| puchaseUrl         | String | External purchase link.
| playlistDescription| String | HTML description.
| genre              | String | Genre.
| tagList            | String | Contains a list of tags separated by spaces. Multiword tags are quoted in doublequotes.
| labelId            | String | Id of the label user
| labelName          | String | Label name
| releaseNumber      | Number | Release number
| releaseDay         | Number | Day of the release
| releaseMonth       | Number | Month of the release
| releaseYear        | Number | Year of the release
| streamable         | Boolean| Streamable via API.
| downloadable       | Boolean| Downloadable
| ean                | Number | EAN identifier for the playlist
| playlistType       | String | Playlist type. Possible values: ep single, album, compilation, project files, archive, showcase, demo, sample pack, other

## Soundcloud.updatePlaylist
Adds track to playlist.

| Field              | Type   | Description
|--------------------|--------|----------
| accessToken        | String | Access Token received from oAuth.
| playlistId         | Number | Id of the playlist.
| tracks             | Array  | Array of tracks IDs to add to the playlist.
| playlistTitle      | String | Title of the playlist.
| playlistSharing    | String | Sharing type of the playlist. Possible values: public OR private.
| embeddableBy       | String | Who can embed this playlist. Possible value: all OR me OR none.
| puchaseUrl         | String | External purchase link.
| playlistDescription| String | HTML description.
| genre              | String | Genre.
| tagList            | String | Contains a list of tags separated by spaces. Multiword tags are quoted in doublequotes.
| labelId            | String | Id of the label user
| labelName          | String | Label name
| releaseNumber      | Number | Release number
| releaseDay         | Number | Day of the release
| releaseMonth       | Number | Month of the release
| releaseYear        | Number | Year of the release
| streamable         | Boolean| Streamable via API.
| downloadable       | Boolean| Downloadable
| ean                | Number | EAN identifier for the playlist
| playlistType       | String | Playlist type. Possible values: ep single, album, compilation, project files, archive, showcase, demo, sample pack, other

## Soundcloud.uploadTrack
Uploads track.

| Field           | Type   | Description
|-----------------|--------|----------
| accessToken     | String | Access Token received from oAuth.
| trackTitle      | String | Title of the track
| trackFile       | File   | File of the track.
| trackSharing    | String | Type of sharing. Possible value: public OR private.
| embeddableBy    | String | Who can embed this track. Possible value: all OR me OR none.
| purchaseUrl     | String | External purchase link.
| trackDescription| String | HTML description.
| genre           | String | Genre
| tagList         | String | Contains a list of tags separated by spaces. Multiword tags are quoted in doublequotes.
| labelId         | String | Id of the label user
| labelName       | String | Label name
| releaseNumber   | Number | Release number
| releaseDay      | Number | Day of the release
| releaseMonth    | Number | Month of the release
| releaseYear     | Number | Year of the release
| streamable      | Boolean| Streamable via API.
| downloadable    | Boolean| Downloadable
| trackType       | String | Track type. Possible values: original, remix, live, recording, spoken, podcast, demo, in progress, stem, loop, sound effect, sample, other
| license         | String | Creative common license. Possible values: no-rights-reserved, all-rights-reserved, cc-by, cc-by-nc, cc-by-nd, cc-by-sa, cc-by-nc-nd, cc-by-nc-sa
| bpm             | Number | Beats per minute
| commentable     | Boolean| Track commentable
| isrc            | String | Track ISRC
| keySignature    | String | Track key

## Soundcloud.updateTrack
Updates uploaded track.

| Field           | Type   | Description
|-----------------|--------|----------
| accessToken     | String | Access Token received from oAuth.
| trackId         | Number | Id of the track
| trackTitle      | String | Title of the track
| trackFile       | File   | File of the track.
| trackSharing    | String | Type of sharing. Possible value: public OR private.
| embeddableBy    | String | Who can embed this track or playlist. Possible value: all OR me OR none.
| purchaseUrl     | String | External purchase link.
| trackDescription| String | HTML description.
| genre           | String | Genre
| tagList         | String | Contains a list of tags separated by spaces. Multiword tags are quoted in doublequotes.
| labelId         | String | Id of the label user
| labelName       | String | Label name
| releaseNumber   | Number | Release number
| releaseDay      | Number | Day of the release
| releaseMonth    | Number | Month of the release
| releaseYear     | Number | Year of the release
| streamable      | Boolean| Streamable via API.
| downloadable    | Boolean| Downloadable
| trackType       | String | Track type. Possible values: original, remix, live, recording, spoken, podcast, demo, in progress, stem, loop, sound effect, sample, other
| license         | String | Creative common license. Possible values: no-rights-reserved, all-rights-reserved, cc-by, cc-by-nc, cc-by-nd, cc-by-sa, cc-by-nc-nd, cc-by-nc-sa
| bpm             | Number | Beats per minute
| commentable     | Boolean| Track commentable
| isrc            | String | Track ISRC
| keySignature    | String | Track key

## Soundcloud.updateUser
Updates user information.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access Token received from oAuth.
| username    | String| Username.
| description | String| Description of the user.
| website     | String| A URL to the website.
| websiteTitle| String| A custom title for the website.
| avatar      | File  | User avatar.

## Soundcloud.deleteMyTrack
Deletes single track.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| trackId    | Number| ID of the track.

## Soundcloud.deleteMyPlaylist
Deletes single playlist.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| playlistId | Number| ID of the playlist.

## Soundcloud.createMyWebProfile
Creates single web-profile.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from oAuth.
| url        | String| Url of the web-profile.
| username   | String| Username for web-profile.
| title      | String| Title of the web-profile.

## Soundcloud.updateMyWebProfile
Updates single web-profile.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access Token received from oAuth.
| webProfileId| Number| ID of the web-profile.
| url         | String| Url of the web-profile.
| title       | String| Title of the web-profile.
| username    | String| Username for web-profile.

