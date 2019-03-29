<?php
$config = array (
    //应用ID,您的APPID。
    'app_id' => "2016092500595647",

    //商户私钥
    'merchant_private_key' => "MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCZG1VKVVoBzS2QF58m5
    ItfOcMEpgztPHXKIUc5ExIaBK37Pe6bpWNxGRq1q6dxL5SEn4c64723MiejKgQBp/yLFy5XoyFEp7vDe4Xpq3yU6jpYbE99WvZ5
    8BY7vdTgzLsM1hwkmS5GaI5Q0rPWfK1A3hSW7jg8faplAtSsUrLaYrsnv03q6S676+MFvR2JQHj3II3hAm9/Djv1TDnckoXgWLza0C
    yln4bo1XV00yknMQ9b7MZKoKXQqAeOxBe6EgMnUJlD3yRM36rjXXzKduP0kf4Ri0E9Jb+L3iLIW2bVbsM51iXYZpaWKmwIR8c70G6WJ7J
    dV04Y43JP39gX9inrAgMBAAECggEAVldBq9+iGG36ic2oZKhxqEvMnGx/0bFMw6YsohUNGjsVWh+81W1ZPMhpdZXNoVixqnDENAOGUy8nhy
    4EgGKZWl7CNY27DxqAGmcoR3P7l4bXTFIYKZsIcA9immIdEICj40NDL6hqni4MQ6vu2sAIfBJBDjRc5k//rWMBSASC8//l6AOrcGHDRUEXXkj
    lj5DABoGq6Os0586y6jUJ/lOo0txvBdW8fgY7hqUEm7FWDunGAIwXUC9OKe9wpFvQK+qEQs1TeRhOtyvc7bYB8aokMK5qJmH6ZSIcORmfA9dzR+f
    lV0adgbXOa920jrJeskXXC5gss0JAA/maa/pbzUI64QKBgQDRAt0AeCeErhrCcIj9DxRo8MySen47+OaMds75A2y9G/4gH8GWUiqpJ9joLJarC7HG
    u091EIN1Yy5+QhHB5MKET4SLJBr500hFP1DeRXVHmnFK0BSnowQ5DJJMwLlwM33XSRMH6xRR7JzM18Z+a0OzPSFDzullDoFeALRTjrSXiQKBgQC7hw
    aMF/5U2PaKm8S0JyxbOh1joW9PsfZ1dIrwclCjoscu9AR/4of1pSow0Y2e7L4ab/lY9JQltdIgOMIY0vNeOPgGRCWyQeHYa6inf7o8+nqB0hf1/2WiS
    wAHT4eJcXkilazgYyMG0oDjMZ7oVX+opjyHKgoyiDtF0yXBk94k0wKBgFt7glnrPXjQb7v9X6hLymYoR5IxdUEwr1B5zBuoCRc4wmEzJRtzeWKyozj0Ez
    pokvZmE+AsSy29LKNsrbMNOqqI133DXt9MQAy3KuEuy6d8jOvu6at6KaYCv6JClKfskb8CKAdGOI2nH/Z011eMAYTZU88HKJbn423Opx8PjjHpAoGAB3
    FHcD3viRyHRF8EQoYfe4tl6TNaAJa2iljSvtI6oxPtxc5Hc2/hJ32jnAZlEX6h2NjC06X5TznVGhRGl8efgwjNxynjORzmQrmbGvK1yH/EZuyYqN
    m3BebmHGQqo+jN/vJjxxAILtgh52JrxRrHk0DtvAuOFg1UFORZZkJhGaMCgYBFCK/JGwBKoRSV3egPo1jBUDEi0dDI9rcEUjUQCmR2pGVep
    n3PQa033vXwEe3clcdG/6OqzFaJgap23FsC2EVLF42nYbZ3fPJDB+/P1BkCIfbPkKng8fYZf/rWsOgZL3Lg4/KmZpUUAeKGvuySy+KfK9ziP/
    BpL2RUUF0yCwIx0g==",

    //异步通知地址
    'notify_url' => "http://www.gxd.com/returnpayf",

    //同步跳转
    'return_url' => "http://www.gxd.com/returnpay",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmRtVSlVaAc0tkBefJuSLXznDBKYM7Tx1yiFHORMSGgSt+z3um6VjcRkatauncS+UhJ+HOuO9tzInoyoEAaf8ixcuV6MhRKe7w3uF6at8lOo6WGxPfVr2efAWO73U4My7DNYcJJkuRmiOUNKz1nytQN4Ulu44PH2qZQLUrFKy2mK7J79N6ukuu+vjBb0diUB49yCN4QJvfw479Uw53JKF4Fi82tAspZ+G6NV1dNMpJzEPW+zGSqCl0KgHjsQXuhIDJ1CZQ98kTN+q4118ynbj9JH+EYtBPSW/i94iyFtm1W7DOdYl2GaWlipsCEfHO9BulieyXVdOGONyT9/YF/Yp6wIDAQAB",
);