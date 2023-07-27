# Webman Study

PHP [Webman 框架](https://github.com/walkor/webman)學習與研究專案。

## Quick Start with Docker

```bash
# 複製 .env.php 檔，並指定具體的專案參數
cp .env.php.example.php .env.php
cp ./config/.env.php.example.php ./config/.env.php

# 預先建立 Docker 主程式容器中的 Zsh 歷史紀錄檔（若不須保留 Zsh 歷史紀錄可忽略此步驟）
touch ./docker/{root,user}.zsh_history

# 執行 Docker 容器
docker-compose up -d
```

## `.env` 與設定的問題

官方從 [1.1.2 版](https://github.com/walkor/webman/releases/tag/v1.1.2)起取消對直接從 `.env` 定義設定參數的作法 ([參考討論](https://www.workerman.net/q/7534))，但作者仍提出了[替代方案](https://www.workerman.net/q/7564)
> 主要是增加了 `config/.env` 檔案，並在 `support/helpers.php` 中加入 `env` 輔助函數

以下為替代方案相關檔案的範例：

### config/.env.php

作者的方案並未加上 `.php` 副檔名，這裡加上以便 IDE 識別

```php
<?php

return [
    'DB_HOST' => '資料庫位置',
    'DB_PASSWORD' => '資料庫密碼'
];
```

### support/helpers.php

作者原方案 `.env` 同樣未加上 `.php` 副檔名，這裡也加上了

```php
<?php

...

function env($key, $default = null) {
    static $env_config = [];
    if (!$env_config) {
        $env_config = include config_path() . '/.env.php';
    }
    return $env_config[$key] ?? $default;
}
```

### config/database.php

```php
<?php

return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'type' => 'mysql',
            'hostname' => env('DB_HOST', '127.0.0.1'),
            'database' => 'workerman_net',
            'username' => 'root',
            'password' => env('DB_PASSWORD', '1234456'),
            'hostport' => '3306',
        ],
    ],
];
```

