var _token = document
    .getElementsByName('csrf-token')[0]
    .getAttribute('content');

var tweets = document.querySelector('.tweets');
var tweetButton = document.querySelector('.tweet-btn');
var tweetBody = document.querySelector('.tweet-body');
var tweetElement = document.querySelector('.clonable-tweet');

tweetButton.addEventListener('click', function (event) {
    event.preventDefault()
    postResource('tweet/create', {
        _token: _token,
        body: tweetBody.value
    }, (data) => {
        appendTweetToFeed(data)
    })
})

function appendTweetToFeed(data) {
    var cloneElement = tweetElement.cloneNode(true)
    tweets.prepend(cloneElement)
    tweets.firstChild.style.display = 'block'
    var clonedTweetBody = tweets
        .firstChild
        .querySelector('.panel .panel-body p');
    var clonedTweetLikes = tweets
        .firstChild
        .querySelector('.panel .panel-footer p');
    clonedTweetBody.innerText = data.body
    clonedTweetLikes.innerText = data.likes
}

/**
 * Handles async post requests
 * @param {string} route
 * @param {Object} body
 */
function postResource(route, body, callback) {
    fetch(route, {
        headers: {
            'Content-type': 'application/json'
        },
        method: 'post',
        body: JSON.stringify(body)
    }).then(response => {
        return response.json()
    }).then(data => {
        callback(data)
    }).catch(error => {
        console.log(error)
    })
}