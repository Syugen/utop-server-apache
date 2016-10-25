"use strict";

var locationApp = locationApp || {};

locationApp.NAMES = {
  "BA": "Bahen Centre for Information Technology (BA)",
  "KL": "Kelly Library (KL)",
  "RB": "Robarts Library (RB)",
  "NC": "40/45 Willcocks St."
}

locationApp.SRC = {
  "BA": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2886.444008737" +
        "7125!2d-79.39960904899611!3d43.6597347599238!2m3!1f0!2f0!3f0!3m2!1i1" +
        "024!2i768!4f13.1!3m3!1m2!1s0x882b34c0acc7e80b%3A0xf855e8cd942bf650!2" +
        "sBahen+Centre+for+Information+Technology%2C+St+George+St%2C+Toronto%" +
        "2C+ON+M5S+2E4!5e0!3m2!1sen!2sca!4v1474422192783",
  "KL": "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11544.792107170" +
        "655!2d-79.3895325!3d43.6648512!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0" +
        "%3A0xa9f93ce55f9a67b7!2sJohn+M.+Kelly+Library!5e0!3m2!1sen!2sca!4v14" +
        "77117032514",
  "RB": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2886.215390013" +
        "0647!2d-79.40188384899608!3d43.66449005961614!2m3!1f0!2f0!3f0!3m2!1i" +
        "1024!2i768!4f13.1!3m3!1m2!1s0x882b34be85038f67%3A0x7cd088dfbb2ef4a9!" +
        "2sRobarts+Library!5e0!3m2!1sen!2sca!4v1474422265506",
  "NC": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2886.357150131" +
        "7874!2d-79.40306358406626!3d43.661541479120984!2m3!1f0!2f0!3f0!3m2!1" +
        "i1024!2i768!4f13.1!3m3!1m2!1s0x882b34bf97c503df%3A0x3e8f50581e79d3b5" +
        "!2s40+Willcocks+St%2C+Toronto%2C+ON+M5S!5e0!3m2!1sen!2sca!4v14530164" +
        "79893"
};

locationApp.buildIframe = function() {
  var iframe = document.createElement("IFRAME");
  iframe.setAttribute("src", this.SRC["BA"]);
  iframe.width = 600;
  iframe.height = 450;
  iframe.frameborder = 0;
  iframe.style.border = 0;
  iframe.allowfullscreen = 1;
  document.getElementById("map").appendChild(iframe);
}

locationApp.buildSRC = function() {
  for(var location in this.SRC) {
    var button = document.createElement("BUTTON");
    button.value = location;
    button.appendChild(document.createTextNode(location));
    document.getElementById("buttons").appendChild(button);
    button.onclick = function() {
    console.log(this.value);
      var iframe = document.getElementsByTagName("IFRAME")[0];
      iframe.setAttribute("src", locationApp.SRC[this.value]);
    };
  }
}

locationApp.init = function() {
  this.buildIframe();
  this.buildSRC();
}

locationApp.init();