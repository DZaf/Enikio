  //...................LOGIN WITH FACEBOOK......................
        window.fbAsyncInit = function () {
            FB.init({
                appId: '474463712937237',
                cookie: true,
                xfbml: true,
                version: 'v2.10'
            });

            FB.AppEvents.logPageView();

        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


        function checkLoginState() {
            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });
        }

        function statusChangeCallback(response) {
            FB.api('/me?fields=first_name,last_name,email,id', function (response) {

                document.getElementById('name2').innerHTML =
                        'Thanks for logging in, ' + response.first_name + ',' + response.last_name;
                document.getElementById('email2').innerHTML =
                        'Your email is , ' + response.email + '!';
                document.getElementById('facebookid').innerHTML =
                        'Your Facebook id is , ' + response.id + '!';
                var blank = "";
                var fbData = blank.concat("name=" + response.first_name + "&" + "surname=" + response.last_name + "&" + "email=" + response.email + "&" + "password=" + response.id);
                console.log(fbData);

                

            });
        }





            //............LOGIN WITH GOOGLE.............
        function onSuccess(googleUser) {
            var profile = googleUser.getBasicProfile();
            gapi.client.load('plus', 'v1', function () {
                var request = gapi.client.plus.people.get({
                    'userId': 'me'
                });
                //Display the user details
                request.execute(function (resp) {
                    var profileHTML = '<div class="profile"><div class="head">Welcome ' + resp.name.givenName + '! <a href="javascript:void(0);" onclick="signOut();">Sign out</a></div>';
                    profileHTML += '<img src="' + resp.image.url + '"/><div class="proDetails"><p>' + resp.displayName + '</p><p>' + resp.emails[0].value + '</p><p>' + resp.gender + '</p><p>' + resp.id + '</p><p><a href="' + resp.url + '">View Google+ Profile</a></p></div></div>';
                    $('.userContent').html(profileHTML);
                    $('#gSignIn').slideUp('slow');
                });
            });
        }
        function onFailure(error) {
            alert(error);
        }
        function renderButton() {
            gapi.signin2.render('gSignIn', {
                'scope': 'profile email',
                'width': 255,
                'height': 40,
                'longtitle': true,
                'theme': 'dark',
                'onsuccess': onSuccess,
                'onfailure': onFailure
            });
        }
        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                $('.userContent').html('');
                $('#gSignIn').slideDown('slow');
            });
        }

