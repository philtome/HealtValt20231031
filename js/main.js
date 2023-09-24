var ready = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}
ready(() => {
    document.querySelector(".header").style.height = window.innerHeight/4 + "px";
})

//This will return to  the contact/plan/participant (main display) that you came from
function returnUrlUpOne(currentUrl)
{
    var urlSegments = currentUrl.split("/");
    var baseURL = urlSegments.slice(0, 4).join("/");
    window.location.href = baseURL;

}

// Function to get the base URL
// function getBaseURL(url:String):String {
//     var urlSegments:Array = url.split("/");
//     var baseURL:String = urlSegments.slice(0, 4).join("/");
//     return baseURL;
// }