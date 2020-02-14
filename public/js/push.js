/*
 *
 *  Push Notifications codelab
 *  Copyright 2015 Google Inc. All rights reserved.
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      https://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License
 *
 */

/* eslint-env browser, es6 */

'use strict';

const applicationServerPublicKey = 'BA_jE44i2VaAUgx0HoioAtzAW445T0KTkWQgZ4nh4sbxUPGV8Asksd23hG-OCMiVscYL3xS1D34WffM9QWQ5DEw';

var isSubscribed = false;
var swRegistration = null;

function urlB64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (var i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

//사용자 구독 처리
function subscribeUser() {

    const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);
    swRegistration.pushManager.subscribe({
        userVisibleOnly: true,
        applicationServerKey: applicationServerKey

        //구독 성공시 DB 에 저장 (axios 활용)
    }).then(function(subscription) {
        console.log(JSON.stringify(subscription));
        console.log(subscription);

        if (subscription != null)
        {
            axios.post('/push/register', {
                push: JSON.stringify(subscription)
            },{headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            }).then(function (success) {
                console.log(success);
            }).catch(function (error) {
                console.log(error);
            });
        }

        //구독 오류시
    }).catch(function(err) {
        console.log('Failed to subscribe the user: ', err);

    });

}

//UI 초기화
function initialiseUI() {

    // UI 초기화
    swRegistration.pushManager.getSubscription()
        .then(function(subscription) {
            isSubscribed = !(subscription === null);

            console.log(subscription);

            //구독되지 않은 상태일경우
            if (subscription == null) subscribeUser();
        });
}

//푸쉬 알림 가능 상태일경우 sw.js 등록
if ('serviceWorker' in navigator && 'PushManager' in window) {
    console.log('Service Worker and Push is supported');

    navigator.serviceWorker.register('/js/sw.js')
        .then(function(swReg) {
            console.log('Service Worker is registered', swReg);
            swRegistration = swReg;

            initialiseUI();
        })
        .catch(function(error) {
            console.error('Service Worker Error', error);
        });

} else {
    console.warn('Push messaging is not supported');

}

