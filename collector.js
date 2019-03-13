function getDeviceType() {
   if(navigator.userAgent.match(/mobile/i)) {
      return "Mobile";
   } else if (navigator.userAgent.match(/iPad|Android|Touch/i)) {
      return "Tablet";
   } else {
      return "Desktop";
   }
}

function browser() {
   var ua = navigator.userAgent.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i), browser;
   if (navigator.userAgent.match(/Edge/i) || navigator.userAgent.match(/Trident.*rv[ :]*11\./i)) {
      return "IE/Edge";
  }
  else {
      return ua[1].toLowerCase();
  }
}

var device = getDeviceType();
var browser = browser();
var height = window.screen.availHeight;
var width = window.screen.availWidth;

var duration = performance.timing.responseEnd - performance.timing.responseStart;

var info = {
   Device: device,
   Browser: browser,
   Height: height,
   Width: width,
   Duration: duration
};

navigator.sendBeacon("/api/log", JSON.stringify(info));
console.log("End of collector.");
