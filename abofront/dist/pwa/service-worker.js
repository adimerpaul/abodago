if(!self.define){let e,i={};const n=(n,o)=>(n=new URL(n+".js",o).href,i[n]||new Promise((i=>{if("document"in self){const e=document.createElement("script");e.src=n,e.onload=i,document.head.appendChild(e)}else e=n,importScripts(n),i()})).then((()=>{let e=i[n];if(!e)throw new Error(`Module ${n} didn’t register its module`);return e})));self.define=(o,c)=>{const r=e||("document"in self?document.currentScript.src:"")||location.href;if(i[r])return;let f={};const s=e=>n(e,r),l={module:{uri:r},exports:f,require:s};i[r]=Promise.all(o.map((e=>l[e]||s(e)))).then((e=>(c(...e),f)))}}define(["./workbox-914ca294"],(function(e){"use strict";e.setCacheNameDetails({prefix:"abogado"}),self.addEventListener("message",(e=>{e.data&&"SKIP_WAITING"===e.data.type&&self.skipWaiting()})),e.precacheAndRoute([{url:"css/810.d6c77a6e.css",revision:null},{url:"css/app.31d6cfe0.css",revision:null},{url:"css/vendor.b3a850a1.css",revision:null},{url:"favicon.ico",revision:"f4facfeaed834544d622544acfbb7722"},{url:"fonts/KFOkCnqEu92Fr1MmgVxIIzQ.9391e6e2.woff",revision:null},{url:"fonts/KFOlCnqEu92Fr1MmEU9fBBc-.ddd11dab.woff",revision:null},{url:"fonts/KFOlCnqEu92Fr1MmSU5fBBc-.877b9231.woff",revision:null},{url:"fonts/KFOlCnqEu92Fr1MmWUlfBBc-.0344cc3c.woff",revision:null},{url:"fonts/KFOlCnqEu92Fr1MmYUtfBBc-.b555d228.woff",revision:null},{url:"fonts/KFOmCnqEu92Fr1Mu4mxM.9b78ea3b.woff",revision:null},{url:"fonts/flUhRq6tzZclQEJ-Vdg-IuiaDsNa.1dd1bb36.woff",revision:null},{url:"fonts/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.f54bbe10.woff2",revision:null},{url:"icons/apple-icon-120x120.png",revision:"d082235f6e6d2109e84e397f66fa868d"},{url:"icons/apple-icon-152x152.png",revision:"3c728ce3e709b7395be487becf76283a"},{url:"icons/apple-icon-167x167.png",revision:"3fec89672a18e4b402ede58646917c2d"},{url:"icons/apple-icon-180x180.png",revision:"aa47843bd47f34b7ca4b99f65dd25955"},{url:"icons/favicon-128x128.png",revision:"ab92df0270f054ca388127c9703a4911"},{url:"icons/favicon-16x16.png",revision:"e4b046d41e08e6fa06626d6410ab381d"},{url:"icons/favicon-32x32.png",revision:"410858b01fa6d3d66b7bf21447c5f1fc"},{url:"icons/favicon-96x96.png",revision:"db2bde7f824fb4057ffd1c42f6ed756e"},{url:"icons/icon-128x128.png",revision:"ab92df0270f054ca388127c9703a4911"},{url:"icons/icon-192x192.png",revision:"7659f0d3e9602e71811f8b7cf2ce0e8e"},{url:"icons/icon-256x256.png",revision:"cf5ad3498fb6fda43bdafd3c6ce9b824"},{url:"icons/icon-384x384.png",revision:"fdfc1b3612b6833a27a7b260c9990247"},{url:"icons/icon-512x512.png",revision:"2c2dc987945806196bd18cb6028d8bf4"},{url:"icons/ms-icon-144x144.png",revision:"8de1b0e67a62b881cd22d935f102a0e6"},{url:"icons/safari-pinned-tab.svg",revision:"3e4c3730b00c89591de9505efb73afd3"},{url:"img/banner.jpg",revision:"d7a023d9b75d4237db8b32511ea49969"},{url:"img/contacto.png",revision:"848420246d05f6621bd60e1b49b3fb30"},{url:"img/contato.png",revision:"fa9d5ea1a8ee19d14f80aa5c6c1f2b3b"},{url:"img/correo.jpg",revision:"bdc2534334d2ca7a9ff049516ef760cb"},{url:"img/fondo.jpg",revision:"d125fab6eb3d1e97918340292b578809"},{url:"img/fondo.png",revision:"719ad4a6b64cda1bbd14499134d5841c"},{url:"img/fondo2.png",revision:"f24042c90de8593fb2fac23abf078b50"},{url:"img/l.jpg",revision:"7db71cacdace8ee817a249b752789efa"},{url:"img/linea.png",revision:"1e547d27f5d339b917f2b599954036fa"},{url:"img/logabogado.jfif",revision:"cf237677061142f7a34775acef5f67d7"},{url:"img/logocastillogonzales.jpeg",revision:"1a52cbffbeedd6c687eec9565b107ffe"},{url:"img/logocastillogonzales.png",revision:"dfe74c9175cdf7d8b0cf42be168ee118"},{url:"img/logocastillogonzales2.png",revision:"53553f07545a515e6452b019db1a60c0"},{url:"img/telf.jpg",revision:"74e16e9766ade57764645719f0f43ac8"},{url:"img/telf.png",revision:"28a9cd3642067d2ca8da6f3d4c75be53"},{url:"img/ubicacion.jpg",revision:"dc3e9040dcf02fdde44a179ca3b57429"},{url:"index.html",revision:"d9e6b4c14a2349e047f061480d0eec11"},{url:"js/193.f08cb6f9.js",revision:null},{url:"js/810.3a9183cd.js",revision:null},{url:"js/app.172d1752.js",revision:null},{url:"logo.jpg",revision:"841aa034530ed8e33add861ad824d35b"},{url:"manifest.json",revision:"9c6c8b3d84ee240250527c596732c98e"}],{}),e.registerRoute(new e.NavigationRoute(e.createHandlerBoundToURL("index.html"),{denylist:[/service-worker\.js$/,/workbox-(.)*\.js$/]}))}));