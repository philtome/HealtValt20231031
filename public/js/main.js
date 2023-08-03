var ready = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}
ready(() => {
    document.querySelector(".header").style.height = window.innerHeight/4 + "px";
})

function returnUrlUpOne(currentUrl)
{
    const lastSlashIndex = currentUrl.lastIndexOf("/");
    const newURL = currentUrl.substring(0, lastSlashIndex);

    window.location.href = newURL;
}

// Function to get the base URL
function getBaseURL(url:String):String {
    var urlSegments:Array = url.split("/");
    var baseURL:String = urlSegments.slice(0, 4).join("/");
    return baseURL;
}