# BEAR.App

![PHP Test](https://github.com/apple-x-co/BEAR.App/workflows/PHP%20Test/badge.svg?branch=develop)

## create project

```bash
composer create-project -n bear/skeleton app
composer require bear/aura-router-module ray/query-module
composer setup
```

## API structure

```bash
php bin/app.php get /
php bin/app.php options /users
```

## DDD structure

### domain層

ドメインモデル
`AppCore\Domain\Model\User\User`

値オブジェクト
・・・値オブジェクトにする基準は以下の通り。該当しない場合はプリミティブ型（int,string,bool）にする
　　　・ルールが存在しているか
　　　・その値を単体で扱いたいか
`AppCore\Domain\Model\User\UserId`
`AppCore\Domain\Model\User\UserName`

ドメインサービス（ルール・制約）
・・・可能な限りドメインサービスのは避ける
　　　エンティティや値ブジェクトに定義できるものであれば、そこに定義する
　　　ドメインオブジェクトは、値オブジェクトやエンティティと同じ括りである。
　　　ただし、ドメインに基づいているものであり、それを実現するサービスであれば、ドメインサービスである。
`AppCore\Domain\Service\UserService`

クエリーインターフェース（データの永続化・検索）
`AppCore\Domain\Model\User\UserQueryInterface`

### infrastructure層

クエリー実装（データの永続化・検索）
・・・データストアに合せた方法で実現
`AppCore\Infrastructure\Persistence\Query\UserQuery`

クエリーサービス実装（CQRS）
・・・IFで定義された検索をデータストアに合せた方法で実現
`AppCore\Infrastructure\Persistence\Query\UserQueryService`

### application層

参照系モデル（DTO）
`AppCore\Domain\Model\User\User\UserData`

クエリーサービスインターフェース（CQRS）
・・・戻り値は参照系モデル（DTO）
`AppCore\Application\User\UserQueryServiceInterface`

アプリケーションサービス
・・・LCOM（Lack of Cohesion in Methods）の観点で、凝縮度を高くするために
　　　UserRegisterService, UserDeleteService, UserUpdateService に分けることも可。
　　　その場合は、UserRegisterServiceInterface->handle などのインターフェースを用意する。
　　　※ ドメイン駆動設計入門 位置 2477
`AppCore\Application\User\UserApplicationService`

ドメインモデル to 参照系モデル（DTO）
`AppCore\Application\User\UserAssembler`

## Reference

BEAR.Sunday, REST実装手順  
https://qiita.com/koriym/items/cb6efd0ab2fb8751f9e9

BEAR.Sunday REST API開発例
https://qiita.com/koriym/items/93528a16bccc6faf418b

BEAR.Sunday, DDD  
https://qiita.com/koriym/items/4cfe8d6d6289a84bab79

BEAR.SundayとSQLと
https://qiita.com/hanahiro_aze/items/5dcb08ada243d8c7b8a3

(Ray.QueryModule) SQL実行入出力の連組配列をarray shapeでタイプする 
https://gist.github.com/koriym/d0d716a3c2a9fee95426b6a7aeb390e6

ITDDD  
https://github.com/nrslib/itddd

JsonSchema Form
https://github.com/rjsf-team/react-jsonschema-form

CQRS実践入門
https://little-hands.hatenablog.com/entry/2019/12/02/cqrs