self.addEventListener("install", (e) => {
  e.waitUntil(
    caches.open("fox-store").then((cache) => cache.addAll([
      "/tmp/resources/js/layer.js",
      "/tmp/resources/js/clipboard.min.js",
      "/tmp/resources/js/theme/default/layer.css",
      "/tmp/resources/themes/bootstrap/css/bootstrap.min.css",
      "/tmp/resources/themes/bootstrap/css/font-awesome.min.css",
      "/tmp/resources/themes/bootstrap/css/prism.css",
      "/tmp/resources/themes/bootstrap/css/style.css",
      "/tmp/resources/themes/bootstrap/js/bootstrap.min.js",
      "/tmp/resources/themes/bootstrap/js/jquery.min.js",
      "/tmp/resources/themes/bootstrap/js/prism.js",
      "/tmp/resources/themes/bootstrap/fonts/fontawesome-webfont.ttf",
      "/tmp/resources/themes/bootstrap/fonts/fontawesome-webfont.woff",
      "/tmp/resources/themes/bootstrap/fonts/fontawesome-webfont.woff2",
      "/tmp/resources/themes/bootstrap/img/folder.png",
      "/tmp/resources/themes/bootstrap/img/cloud_kogo192.png",
      "/tmp/resources/js/theme/default/icon.png",
      "/tmp/resources/js/theme/default/icon-ext.png",
      "/tmp/resources/js/theme/default/loading-0.gif",
      "/tmp/resources/js/theme/default/loading-1.gif",
      "/tmp/resources/js/theme/default/loading-2.gif",
      "/tmp/resources/pwa/icon/cloud_logo512.png"
    ])),
  );
});

self.addEventListener("fetch", (e) => {
  console.log(e.request.url);
  e.respondWith(
    caches.match(e.request).then((response) => response || fetch(e.request)),
  );
});
