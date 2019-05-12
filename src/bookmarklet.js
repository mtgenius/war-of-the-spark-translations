javascript: (function() {

const id = document.querySelector('meta[property="og:url"]').content.match(/^https:\/\/scryfall\.com\/card\/([\w\d]+\/(\d+))\//)[1];

const fc = new Map();
const f = async url => {
  if (fc.has(url)) {
    return fc.get(url);
  }
  const response = await fetch(`https://api.scryfall.com/cards/${url}`);
  const card = await response.json();
  fc.set(url, card);
  return card;
};

Promise.all([
  f(`${id}/en`),
  f(`${id}/ja`),
  f(`${id}%E2%98%85/ja`)
])
  .then(([ en, jp, promo ]) => {
    location.href =
      'http://mtgenius.docker/war-of-the-spark-translations' +
      `?en=${encodeURIComponent(en.image_uris.png)}` +
      `&jp=${encodeURIComponent(jp.image_uris.png)}` +
      `&promo=${encodeURIComponent(promo.image_uris.png)}`;
  });

})();
