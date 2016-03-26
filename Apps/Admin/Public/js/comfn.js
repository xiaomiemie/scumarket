define(['jquery'], function($) {
  function commonFn() {
    this.jMeteor={};
  };
  commonFn.prototype.bwMatch = function() {
    var userAgent = navigator.userAgent, // userAgent  
      rMsie = /.*(msie) ([\w.]+).*/, // ie  
      rFirefox = /.*(firefox)\/([\w.]+).*/, // firefox  
      rOpera = /(opera).+version\/([\w.]+)/, // opera  
      rChrome = /.*(chrome)\/([\w.]+).*/, // chrome  
      rSafari = /.*version\/([\w.]+).*(safari).*/; // safari  
    this.jMeteor.browser = {};
    var ua = userAgent.toLowerCase();

    function uaMatch(ua) {
      var match = rMsie.exec(ua);
      if (match != null) {
        return {
          browser: match[1] || "",
          version: match[2] || "0"
        };
      }
      var match = rFirefox.exec(ua);
      if (match != null) {
        return {
          browser: match[1] || "",
          version: match[2] || "0"
        };
      }
      var match = rOpera.exec(ua);
      if (match != null) {
        return {
          browser: match[1] || "",
          version: match[2] || "0"
        };
      }
      var match = rChrome.exec(ua);
      if (match != null) {
        return {
          browser: match[1] || "",
          version: match[2] || "0"
        };
      }
      var match = rSafari.exec(ua);
      if (match != null) {
        return {
          browser: match[2] || "",
          version: match[1] || "0"
        };
      }
      if (match != null) {
        return {
          browser: "",
          version: "0"
        };
      }
    }
    var browserMatch = uaMatch(userAgent.toLowerCase());
    if (browserMatch.browser) {
      this.jMeteor.browser[browserMatch.browser] = true;
      this.jMeteor.browserName = browserMatch.browser;
      this.jMeteor.browser.version = browserMatch.version;
      this.jMeteor.browser.language = (navigator.language ? navigator.language : navigator.userLanguage || "");
    }
  }

  return {
    commonFn: commonFn
  }
})