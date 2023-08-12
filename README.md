# Webman Study

PHP [Webman 框架](https://github.com/walkor/webman)學習與研究專案。

## 初始化

```bash
# 複製環境設定檔，並設定必須的專案參數，尤其是 Docker 的 HOST_PROJECT_DIRECTORY
cp .env.example .env
cp ./config/.env.php.example.php ./config/.env.php
```

若專案在 Docker 容器內運行，還須執行以下步驟：

```bash
# 預先建立 Docker 主程式容器中的 Zsh 歷史紀錄檔（若不須保留 Zsh 歷史紀錄可忽略此步驟）
touch ./docker/{root,user}.zsh_history

# 執行 Docker 容器
docker-compose up -d
```

## 注意事項

### Editor Config

建議引入 `.editorconfig` 以規範專案格式。

### License

框架中有[原作者](https://github.com/walkor)的 MIT License 標記 (`LICENCE`)，用來開發自己的專案時記得修改或移除。

### composer.json

`composer.json` 中也有原作者 Webman 本身的相關訊息，發布自己的專案時也要記得修改或適當處理。

### 時區

可在 `config/app.php` 的 `default_timezone` 修改。

## `.env` 與設定的問題

官方從 [1.1.2 版](https://github.com/walkor/webman/releases/tag/v1.1.2)起取消了直接在 `.env` 設定參數的作法 ([參考討論](https://www.workerman.net/q/7534))，但作者仍提出了[替代方案](https://www.workerman.net/q/7564)。

> 主要是增加了 `config/.env.php` 檔案，並在 `support/helpers.php` 中加入 `env` 輔助函數。

以下為替代方案相關檔案的範例：

### config/.env.php

作者的方案並未加上 `.php` 副檔名，這裡加上以便 IDE 識別：

```php
<?php

return [
    'DB_HOST' => '資料庫位置',
    'DB_PASSWORD' => '資料庫密碼'
];
```

### support/helpers.php

作者原方案 `.env` 同樣未加上 `.php` 副檔名，這裡也加上了：

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

> 須注意如此添加的 `env` 函數，係從 `config/.env.php` 取得設定值，而非 `.env`。

## Vite

整合了 [Laravel Vite](https://www.npmjs.com/package/laravel-vite-plugin)；若使用 Docker 容器，須將 Vite port 暴露出來，且設定內外一致的 port，即可由主程式 port 訪問 Vite 編譯後的前端資源。

> Vite port (即 Docker 容器內部 port) 在 `vite.config.js` 設定  
> Docker 外部 port 由 `.env` 的 `CONTAINER_PORT_APP_VITE` 參數指定

以本專案的設定值而言，Vite 內外 port 均設為 58788，當在容器內執行 `npm run dev` 運行 Vite server 時，便可由主程式 (Port 58787) 訪問到 Port 58788 的 前端資源。
