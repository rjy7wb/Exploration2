var baseURL = "http://ec2-18-216-179-94.us-east-2.compute.amazonaws.com/2830final/";

function homeContent() {
	
	var homeRequest = new XMLHttpRequest();
	homeRequest.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
                        document.getElementById("imgContainer").innerHTML = this.responseText;
                }
        };
	str = "homeContent.php";
        homeRequest.open("GET", baseURL+str , true);
        homeRequest.send();
}

function feedContent() {
	
	var feedRequest = new XMLHttpRequest();
	feedRequest.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			document.getElementById("imgContainer").innerHTML = this.responseText;
		}
	};
	str = "feedContent.php";
	feedRequest.open("GET", baseURL+str, true);
	feedRequest.send();
}
