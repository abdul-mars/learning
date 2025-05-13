function loginAuth(username, password, url) {
    var data = {
        'username': username,
        'password': password,
        'submitBtn': true,
    };

    return $.ajax({
        url: url,
        type: 'post',
        data: data
    });
}


$(document).ready(function(){
	

})