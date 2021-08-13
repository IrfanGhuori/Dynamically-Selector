$(function () {
  "use static";

  $("#connecting").on("click", function () {
    $("#connecting").html("Connecting...");

    var HostName = $("input[name=host_title]");
    var DatabaseTitle = $("input[name=data_title]");
    var DatabaseName = $("input[name=data_user]");
    var DatabasePassword = $("input[name=data_pass]");
    var ApiKey = $("input[name=api_key]");
    var Validation = 1;

    if (HostName.val() == "") {
      $("#connecting").html("Enter host name");
      Validation = 0;
      return false;
    }
    if (DatabaseTitle.val() == "") {
      $("#connecting").html("Enter Database names");
      Validation = 0;
      return false;
    }

    if (DatabaseName.val() == "") {
      $("#connecting").html("Enter Database (username)");
      Validation = 0;
      return false;
    }

    if (DatabasePassword.val() == "") {
      $("#connecting").html("Enter Database password");
      Validation = 0;
      return false;
    }
    if (ApiKey.val() == "") {
      $("#connecting").html("Generate Secret key");
      Validation = 0;
      return false;
    }

    if (Validation) {
      $.ajax({
        type: "post",
        url: "../../api/app/config.php",
        data: $("#database-connection").serialize(),
        dataType: "json",
        success: function (response) {
          if (response.status === false) {
            $("#connecting").html(response.message);
          } else if (response.status === true) {
            $("#connecting").html(response.message);
            setTimeout(() => {
              $("#database-connection").fadeOut(0);
              $(".card-text h5")
                .css("padding-left", "19px")
                .html("Start Installation");
              $(".install").fadeIn(1000);
            }, 1000);
          }
          console.log(response.message);
        },
      });
    }
  });

  $("#scaning").on("click", function () {
    $("#scaning").html("Scaning...");
    setTimeout(() => {
      $.ajax({
        type: "post",
        url: "../../api/app/scanner.php",
        success: function (response) {
          $("#scaning").html("Scan Server");
          $(".modal-body").html(response);
          $("#servercaning").modal("show");
        },
      });
    }, 1999);
  });

  $("#start-installation").on("click", function () {
    var progress = $(".loading-progress").progressTimer({
      timeLimit: 10,
      onFinish: function () {
        location.replace("../../api/api.html");
      },
    });

    $("#start-installation").html("installing..");

    $.ajax({
      type: "post",
      url: "../../api/app/insaller.php",
      success: function (req) {
        if (req.match("789jpo")) {
          if (progress.progressTimer("complete")) {
          }
        } else if (req.match("oiiwug")) {
          progress.progressTimer("error", {
            errorText: "ERROR!",
            onFinish: function () {
              // alert('There was an error processing your information!');
            },
          });
        } else if (req.match("UYOG09")) {
          progress.progressTimer("error", {
            errorText: "ERROR!",
            onFinish: function () {
              // alert('There was an error processing your information!');
            },
          });
          $("#start-installation").html(" Database already installed ");
        } else if (req.match("OPWRTY")) {
          progress.progressTimer("error", {
            errorText: "ERROR!",
            onFinish: function () {
              // alert('There was an error processing your information!');
            },
          });
          $("#start-installation").html(" Database file does not exist ");
        }
        console.log(req);
      },
    });
  });

  $("#basic-addon1").on("click", function () {
    var key = "";
    var possible =
      "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 10; i++)
      key += possible.charAt(Math.floor(Math.random() * possible.length));
    $("input[name=api_key]").val(key);
  });
});
