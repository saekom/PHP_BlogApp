# 起動手順
実行環境：MacOS, PHP, nginx, MySQL

PHPで作成したタスク管理アプリを
ローカル動作させる手順を簡単にまとめます。


## 01. 初回起動
### アプリの中へ移動
```
cd PHP_BlogApp
```

### 環境を構築。初回も今回はこれのみでOK。
```
docker-compose up -d
```

### 仮想サーバー立ち上げ後のURL
http://localhost/index.php



## 02.DBの作成
### データベース"blog_app"の作成
```
create database blog_app;
```

### 作業ユーザーの作成とパスワードの設定。今回はホストを指定しない
ユーザー名: user
PW: password
```
create user testuser identified by 'password';
```

### "blog_app"というデータベースの全てのテーブルの操作権限を「testuser」に付与
```
grant all on blog_app.* to testuser;
```

### データベース"blog_app"に入り、テーブルの作成
```
create table posts (
    id int primary key auto_increment,
    title varchar(255),
    body text,
    created_at datetime,
    updated_at datetime
);
```

### テスト用のレコードを入れておく
```
insert into posts (title, body, created_at, updated_at) values
('楽しかった！', '家族旅行にいってきました〜♪', now(), now()),
('寒い(>_<)', '今日は雪が降りました', now(), now()),
('ランニング♪', '5km走ってきました！！！', now(), now());
```

### データベース"blog_app"に、contentsカラムを追加
```
ALTER TABLE posts ADD content varchar(255);
```

### データベース"blog_app"に、deadlineカラムを追加
```
ALTER TABLE posts ADD deadline datetime;
```





## 03.2回目以降のコンテナの起動と停止方法
### 起動中のコンテナを立ち上げる('-d'でプロセスを表示しない。私は基本これ)
```
docker-compose up -d
```

### 起動中のコンテナを立ち上げる(プロセスを表示する。仮想サーバーのログがザーッと流れてきます)
```
docker-compose up
```

### 起動中のコンテナを停止する
```
docker-compose up stop
```