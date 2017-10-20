<?php
/**
 * Created by PhpStorm.
 * User: ippei
 * Date: 2017/10/20
 * Time: 1:19
 */

namespace Deployer;

use Deployer\Utility\Httpie;

// Chatwork
set('chatwork_base_url', 'https://api.chatwork.com/v2');

// Project title
set('chatwork_title', function () {
    return get('application', 'Project');
});

// Deploy message
set('chatwork_text', '_{{user}}_ deploying `{{branch}}` to *{{target}}*');
set('chatwork_success_text', 'Deploy to *{{target}}* successful');


desc('Notifying Chatwork');
task('chatwork:notify', function () {
    if (!get('chatwork_room_id', false) || !get('chatwork_api_token', false)) {
        return;
    }
    Httpie::post(get('chatwork_base_url') . '/rooms/' . get('chatwork_room_id') . '/messages')
        ->header('X-ChatWorkToken: ' . get('chatwork_api_token'))
        ->form(['body' => get('chatwork_text')])->send();
})
    ->once()
    ->shallow()
    ->setPrivate();
desc('Notifying Chatwork about deploy finish');
task('chatwork:notify:success', function () {
    if (!get('chatwork_room_id', false) || !get('chatwork_api_token', false)) {
        return;
    }
    Httpie::post(get('chatwork_base_url') . '/rooms/' . get('chatwork_room_id') . '/messages')
        ->header('X-ChatWorkToken: ' . get('chatwork_api_token'))
        ->form(['body' => get('chatwork_success_text')])->send();
})
    ->once()
    ->shallow()
    ->setPrivate();
