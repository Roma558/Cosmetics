const staticCacheName = 's-spp-v1';
const assetUrls = [
  '/',
  '/index.html',
  '/price.html',
  '/raboti.html',
  '/feedback.php',
  '/kontakti.html',
  '/my_styles.css',
  '/Logo.jpg',
  '/glavn.webp',
  '/glavn2.webp'
];

self.addEventListener('install', async event => {
    console.log('[SW]: install');
    const cache = await caches.open(staticCacheName);
    await cache.addAll(assetUrls);
});

self.addEventListener('activate', event => {
    console.log('[SW]: activate');
});

self.addEventListener('fetch', event => {
    console.log('Fetch', event.request.url);
    event.respondWith(cacheFirst(event.request));
});

async function cacheFirst(request) {
    const cached = await caches.match(request);
    return cached ?? await fetch(request);
}