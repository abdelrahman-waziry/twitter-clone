var _token = document
    .getElementsByName('csrf-token')[0]
    .getAttribute('content');

var tweets = document.querySelector('.tweets');
var tweetButton = document.querySelector('.tweet-btn');
var followButton = document.querySelector('.follow-btn');
var likeButton = document.querySelectorAll('.like-btn');
var tweetBody = document.querySelector('.tweet-body');
var tweetElement = document.querySelector('.clonable-tweet');

if(tweetButton){
    tweetButton.addEventListener('click', function (event) {
        event.preventDefault()
        postResource('tweet/create', {
            _token: _token,
            body: tweetBody.value
        }, (data) => {
            appendTweetToFeed(data)
            tweetBody.value = ''
        })
    })
}

if(followButton){
    followButton.addEventListener('click', function(event) {
        event.preventDefault()
            postResource('/follow', {
                _token: _token,
                username: followButton.getAttribute('username')
            }, (data) => {
                location.reload();
            })
    })
}

likeButton.forEach(button => {
    button.addEventListener('click', function(event){
        event.preventDefault()
        postResource('/tweet/like', {
            _token: _token,
            liked: button.getAttribute('liked'), 
            id: button.getAttribute('tweet-id')
        }, (data) => {
            if(button.getAttribute('liked')){
                button.classList.remove('liked')
                button.removeAttribute('liked')
                var likesCounter = button.querySelector('p')
                likesCounter.innerText = Number(likesCounter.innerText) - 1
            }
            else {
                button.classList.add('liked')
                button.setAttribute('liked', "1")
                var likesCounter = button.querySelector('p')
                likesCounter.innerText = Number(likesCounter.innerText) + 1
            }
        })
    })
})

function appendTweetToFeed(data) {
    var cloneElement = tweetElement.cloneNode(true)
    tweets.prepend(cloneElement)
    tweets.firstChild.style.display = 'block'
    var clonedTweetBody = tweets.firstChild.querySelector('.panel .panel-body p');
    var clonedTweetLikes = tweets.firstChild.querySelector('.panel .panel-footer p');
    var clonedTweetAvatar = tweets.firstChild.querySelector('.panel .panel-heading a img');
    var clonedTweetName = tweets.firstChild.querySelector('.user-info h5');
    var clonedTweetUserName = tweets.firstChild.querySelector('.user-info h6');
    var clonedTweetAnchor = tweets.firstChild.querySelector('.panel .panel-heading a ');
    
    clonedTweetBody.innerText = data.body
    clonedTweetLikes.innerText = data.likes
    clonedTweetAvatar.src = data.subject.avatar ? data.subject.avatar : 'https://via.placeholder.com/150' 
    clonedTweetName.innerText = data.subject.name
    clonedTweetUserName.innerText = data.subject.username
    clonedTweetAnchor.href = `/user/${data.subject.username}` 
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
