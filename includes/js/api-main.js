var postbtn = document.getElementById("post-btn");
var postContainer = document.getElementById("post-container");

postbtn.addEventListener("click", function(){
    var ourRequest = new XMLHttpRequest();
    ourRequest.open("GET","http://test2.test/wp-json/wp/v2/posts");
    ourRequest.onload = function() {

            var data = JSON.parse(ourRequest.response);
             createHTML(data);
            //  console.log(data);
        
    }
    ourRequest.onerror = function() {
        console.log('connection error');
    }
    ourRequest.send();
})

function createHTML(postData) {
    var postHTML = '';
    for(var i=0; i < postData.length; i++){
        // console.log(postData[i].title);
        postHTML += '<h4>' + postData[i].id + '</h4>'; 
     
    }
    postContainer.innerHTML = postHTML;
    console.log(postHTML);
}

