
## _Country State City Dropdown _

[![N|Solid](https://cldup.com/dTxpPi9lDf.thumb.png)]()

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)]()
## Installation
1 - Download API
2 - Upload the API zip folder to your web server, using FTP.
3 - Create a MySQL database for API or your exists database for api.
4 - Ran installation file path: www.yourDomain.com/api/installer
5 - After installation delete installer folders

## Uninstall API
1 - Go your phpMyAdmin
2 - Drop down 4 columns Name "city","country","key","state"
3 - Delete FOlder name
App folder
Dist folder
api.html

## API Key
1 - Copy your API key during installation
2 - Paste your API key in ajax script after URL path
3 - If you forgot the copy key, you can copy it from your database.


## Use API
1 - Copy the HTML code.
2 - It is designed with Bootstrap 4, you can easily customize it.
3 - Place the fetcher.js after the jquery library


```sh
<script src="YourDomain.com/dist/js/fetcher.js"></script>
```
4 - copy ajax code and place it after jquery library.

```sh
<script>
$(document).ready(function () {
jQuery.ajax({
type: 'post',
url: '../api/app/api_countries.php?key=Your-API-Key',
success: function (countries) {
if (countries.status == "connected") {
$.each(countries.data, function (ind, co) {
jQuery('#country').append("" + co.name + "");
});
} else if (countries.status == "error") {
$('.alert-danger').fadeIn();
$('#message').append(countries.message);
}
}
});
});
</script>
```
5 - Copy the HTML code and place it where you want it to appear.

```sh
<div class="row">
	<div class="col-sm-4">
		<div class="form-group">
			<label for="country">Country</label>
			<select class="form-control" id="country">
				<option value="-1">Select Country</option>
			</select>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label for="state">State</label>
			<select class="form-control" id="state">
				<option>Select State</option>
			</select>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label for="city">City</label>
			<select class="form-control" id="city">
				<option>Select City</option>
			</select>
		</div>
	</div>
</div>
```

> Note: `Videos tutorials are available in this project folder download and watch them for easily use this smart API
> Suggest me for it or if asking something about it 


[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)

   [dill]: <https://github.com/joemccann/dillinger>
   [git-repo-url]: <https://github.com/joemccann/dillinger.git>
   [john gruber]: <http://daringfireball.net>
   [df1]: <http://daringfireball.net/projects/markdown/>
   [markdown-it]: <https://github.com/markdown-it/markdown-it>
   [Ace Editor]: <http://ace.ajax.org>
   [node.js]: <http://nodejs.org>
   [Twitter Bootstrap]: <http://twitter.github.com/bootstrap/>
   [jQuery]: <http://jquery.com>
   [@tjholowaychuk]: <http://twitter.com/tjholowaychuk>
   [express]: <http://expressjs.com>
   [AngularJS]: <http://angularjs.org>
   [Gulp]: <http://gulpjs.com>

   [PlDb]: <https://github.com/joemccann/dillinger/tree/master/plugins/dropbox/README.md>
   [PlGh]: <https://github.com/joemccann/dillinger/tree/master/plugins/github/README.md>
   [PlGd]: <https://github.com/joemccann/dillinger/tree/master/plugins/googledrive/README.md>
   [PlOd]: <https://github.com/joemccann/dillinger/tree/master/plugins/onedrive/README.md>
   [PlMe]: <https://github.com/joemccann/dillinger/tree/master/plugins/medium/README.md>
   [PlGa]: <https://github.com/RahulHP/dillinger/blob/master/plugins/googleanalytics/README.md>
