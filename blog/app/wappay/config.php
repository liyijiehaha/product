<?php
$config = array (
    //应用ID,您的APPID。
    'app_id' => "2016092700606466",

    //商户私钥
    'merchant_private_key' => "MIIEowIBAAKCAQEAtnF91lgRCx4otKG/hk0PgaIi4AMXkALHhcMZG9lfbUcUJdn0/JqWcN56N+FJCznqJSZkhWfD/cu6yiyyWtkAM9sxJwcxKoEY54Vp04ag7+kApZnTQuE+VLeqSi6ofWaTncdEOwrW16X6FT/B0WpwsY4Ec35YvwvAmcxCyAaAkLTNaNCnG5t3dXLDp4mfz16N1q9slo+KYhx35yzqgz8nmODMAo7qytWfH19W3SBp8dE1BZBVdejCTd3kjsT3sOBXzrAtOHhqlLo1HApaMdAZjwIv9F7AGfX1LcG3bxX57YtiRHKvdyNZZaXiTKaj7pif+u/sdoFmGXErITJQBxnvqQIDAQABAoIBAEeFnmtVAvl0zUhi0I55z0ZmpX1kOOx/6nAJ1+IPCVXxs3hTRbNxduCwlwEpFFWOUrhVoLqbvz3TjFqNwy3SPD4YA+Dk9OVQzs6UgrQl5xmmIlbJQwTJAIJ9rgh+2havC9eisqDi0u6fZrbF09mg/KTeo+gS8/+RP+QLK3L2+ZfAXz0zIKts852ICxTJOZtgf0lSmbYMramKPNi4qe+QqxpBEzOXuTm/K0iaUubkuRXqLeXInLLRyDzyZmgycgHFW0+pgngJ6YDOxkbAjQj2sPGoHH63DiLTGgciRIAMCcJh9pbuo0bQk76olWPvWx749HpjxJ56+fqm5fpSAMGIpDECgYEA7dPt7LkiSoa0LEmHgLTJhGoH8sRy9z25HaDt2OoGo8HrJI/dKC4N3sNs/Ez14AmkOt/IfzQdoxLOGvJssWllidP81GjXpRCg3RUz+fiH7xbljNvlRtsn3dWRBY2UI4bTUqHY2zlNG8KoZQBSEFKRZyaWSh2PkX1DV4i5+I2aR48CgYEAxGI0QaIRjrdjCMBfKceKIR7+kpC5A/Rcl9LYkg35omF1x3JEQ/kLdTELd+zqpgT/3HRkm9Uotw7LXCNe/QU0SYZuImQhafAbqigCig7quP5WxESj6Z9nz2utXtYQG7AjTlIoX+zPPYZUdNfmvaKak/LWjh4evpfJOMee7qfq+UcCgYEAnTJ1kwCTr9r1gEhhrirRABrtggNjUhSUJQdX7wZQuTDV8ea9cW9vb4yQnvtnkVwOF3QPHDUgWcd2P815FpLpsH5UITnjP5GMIlV/c3xYrSnfNImsNHdrFG+zWY5JGmplh7q+kbiARRcXIxthIrTQsvOIZxi+6pV3S4ZuFeHS1fUCgYACT3Fz8Dcqqaelm7XC5REP8LBoAwHaNQ69zoIzvaxZJ7JeBU8eSZjD6S7MW2IrT9W+vzPLzYcsGCV2UQg2C9CgqM804l6uQ1/f8ZaODzzdrkhRCMmw3uo2u3qPqg8IdFsF+dt1vXB2tdTahwu04WvWH748b8hGz7xTSa3p+tm90wKBgDJgo+9gjIpUZ02ktav37NyQccZlX/pX3J8hoN/WbtWJUdZp4pfVCECDGrdLyjkql5VTS22pB3KmnWfWYpPU5oLIt9WM08L8pziW+8gJ4A4cJaLJ+/AA9lO5TxoaDeaBDrib0okljaCS7qydFC65PWqjCGO/ZaXLRwWSkHXYxXl9",

    //异步通知地址
    'notify_url' => "http://www.zhu.com/returnpayf",

    //同步跳转
    'return_url' => "http://www.zhu.com/returnpay",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtnF91lgRCx4otKG/hk0PgaIi4AMXkALHhcMZG9lfbUcUJdn0/JqWcN56N+FJCznqJSZkhWfD/cu6yiyyWtkAM9sxJwcxKoEY54Vp04ag7+kApZnTQuE+VLeqSi6ofWaTncdEOwrW16X6FT/B0WpwsY4Ec35YvwvAmcxCyAaAkLTNaNCnG5t3dXLDp4mfz16N1q9slo+KYhx35yzqgz8nmODMAo7qytWfH19W3SBp8dE1BZBVdejCTd3kjsT3sOBXzrAtOHhqlLo1HApaMdAZjwIv9F7AGfX1LcG3bxX57YtiRHKvdyNZZaXiTKaj7pif+u/sdoFmGXErITJQBxnvqQIDAQAB",
);