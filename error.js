window.onerror = function(message, url, lineNumber){
   var data = {
      Message: message,
      Url: url,
      Line: lineNumber
   };
   console.log(message, url, lineNumber);
   navigator.sendBeacon("/api/error", JSON.stringify(data));
}
