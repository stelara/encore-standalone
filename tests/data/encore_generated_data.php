<?php declare(strict_types=1);
/**
 * (c) Stelio Stefanov <stefanov.stelio@gmail.com>
 */

return [
'entryPoints' => '{
      "entrypoints": {
        "app": {
          "js": [
            "/static/runtime.js",
            "/static/vendors~app~page~page1.js",
            "/static/vendors~app.js",
            "/static/app.js"
          ],
          "css": [
            "/static/app.css"
          ]
        },
        "page": {
          "js": [
            "/static/runtime.js",
            "/static/vendors~app~page~page1.js",
            "/static/page.js"
          ]
        },
        "page1": {
          "js": [
            "/static/runtime.js",
            "/static/vendors~app~page~page1.js",
            "/static/vendors~page1.js",
            "/static/page1.js"
          ],
          "css": [
            "/static/page1.css"
          ]
        }
      },
      "integrity": {
        "/static/runtime.js": "sha384-rw9ymbirQ0CvZNgZEf9i2HDcZheP7dFfStAtt6W2+CoB6cDTQakUoa8MIvxTn+wo",
        "/static/vendors~app~page~page1.js": "sha384-OTXHZOvqEbcOIDekxOR4/MGN4PKwgdEA15QOZiPR6UEqSRGQZYcZZmB69MwEaglk",
        "/static/vendors~app.js": "sha384-uEP+Eqy0gZ1EdN2IVl3j/3eEpiGyXRKwyMItV2s2Yzle6ztlSIV+KOCQNQBdUo4W",
        "/static/app.js": "sha384-oxF7MJWliiTMub4OarpDYkdSfqJprcNRRmQAmtL1C6crmWHT6ioyOpVxlcdZyz9+",
        "/static/app.css": "sha384-CWLGK6KocNZbDLILk5RJ0+dl8lvB54CUSl4KQfNraduc4KQg921ahp9qpY/tB17K",
        "/static/page.js": "sha384-VVzwumLrLj5g2jsLuzf+08V8S6zIP2mtJJsJTmw0vsbxpC3fJuMW8xVPAhM6Vk+u",
        "/static/vendors~page1.js": "sha384-nhz3pDKYIrmBYSI2/TDVtzUvAgt1IteHFvQKqOMwtQi6xFxmtqvJZH6JmWjWj2nj",
        "/static/page1.js": "sha384-pQAQyQoV/LHhtd614xse89ASLHouF7G3BYc3uTIJ9Wz8GgvEQsUOu8RWu8yopQY3",
        "/static/page1.css": "sha384-QS2CPRTVPko+ZXRdj1ckULC0makcKptDlLr3/heL1kwklJrrWuI6p8Seb0M7AVUi"
      }
    }',
'manifest'    => '{
      "static/app.css": "/static/app.css",
      "static/app.js": "/static/app.js",
      "static/page.js": "/static/page.js",
      "static/page1.css": "/static/page1.css",
      "static/page1.js": "/static/page1.js",
      "static/runtime.js": "/static/runtime.js",
      "static/vendors~app.js": "/static/vendors~app.js",
      "static/vendors~app~page~page1.js": "/static/vendors~app~page~page1.js",
      "static/vendors~page1.js": "/static/vendors~page1.js",
      "static/fonts/fontawesome-webfont.eot": "/static/fonts/fontawesome-webfont.674f50d2.eot",
      "static/fonts/fontawesome-webfont.woff2": "/static/fonts/fontawesome-webfont.af7ae505.woff2",
      "static/fonts/fontawesome-webfont.ttf": "/static/fonts/fontawesome-webfont.b06871f2.ttf",
      "static/fonts/fontawesome-webfont.woff": "/static/fonts/fontawesome-webfont.fee66e71.woff",
      "static/images/favicon.ico": "/static/images/favicon.db783ed5.ico",
      "static/images/fontawesome-webfont.svg": "/static/images/fontawesome-webfont.912ec66d.svg",
      "static/images/new_section/hallstatt-4579234_640.jpg": "/static/images/new_section/hallstatt-4579234_640.91626364.jpg",
      "static/images/python.png": "/static/images/python.ff06c339.png"
    }'
];