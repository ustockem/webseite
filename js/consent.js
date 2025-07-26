function setConsent() {
  localStorage.setItem('consentGranted', 'true');
  document.getElementById('consent-box').style.display = 'none';
  startTracking();
}

function startTracking() {
  var _paq = window._paq || [];
  _paq.push(['disableCookies']);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u = BASE_PATH + "/matomo/";
    _paq.push(['setTrackerUrl', u + 'matomo.php']);
    _paq.push(['setSiteId', '1']);
    var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
    g.async = true; g.src = u + 'matomo.js'; s.parentNode.insertBefore(g, s);
  })();
}

if (localStorage.getItem('consentGranted')) {
  document.addEventListener("DOMContentLoaded", () => {
    document.getElementById('consent-box').style.display = 'none';
    startTracking();
  });
}