# BEAR.App

![PHP Test](https://github.com/apple-x-co/BEAR.App/workflows/PHP%20Test/badge.svg?branch=develop)
[![Build Status](https://travis-ci.org/apple-x-co/BEAR.App.svg?branch=develop)](https://travis-ci.org/apple-x-co/BEAR.App)

## create project

```bash
composer create-project -n bear/skeleton app
composer require bear/aura-router-module ray/query-module
composer setup
./vendor/bin/psalm --init
```

## API structure

```bash
php bin/app.php get /
php bin/app.php options /users
```

## QA

```bash
composer run-script test
composer run-script tests
```

## DDD structure

### Domain層

**ドメインモデル**

`AppCore\Domain\Model\User\User`

**値オブジェクト**

```text
値オブジェクトにする基準は以下の通り。該当しない場合はプリミティブ型（int,string,bool）にする  
・ルールが存在しているか  
・その値を単体で扱いたいか  
```

`AppCore\Domain\Model\User\UserId`  
`AppCore\Domain\Model\User\UserName`

**ドメインサービス（ルール・制約）**

```text
可能な限りドメインサービスのは避ける  
エンティティや値ブジェクトに定義できるものであれば、そこに定義する  
ドメインオブジェクトは、値オブジェクトやエンティティと同じ括りである。  
ただし、ドメインに基づいているものであり、それを実現するサービスであれば、ドメインサービスである。
```

`AppCore\Domain\Service\UserService`

**リポジトリインターフェース（データの永続化・検索）**

`AppCore\Domain\Model\User\UserRepositoryInterface`

**ユースケース実装**

`AppCore\Domain\Application\User\UserCreateUseCase`

### Infrastructure層

**リポジトリ実装（データの永続化・検索）**

`AppCore\Infrastructure\Persistence\Query\UserRepository`

**クエリーサービス実装（CQRS）**

```text
IFで定義された検索をデータストアに合せた方法で実現
```

`AppCore\Infrastructure\Persistence\Query\UserQueryService`

### Application層

**クエリーサービスインターフェース（CQRS）**

```text
戻り値は参照系モデル（DTO）
```

`AppCore\Application\User\UserQueryServiceInterface`

### UseCase層

**インプットポート**

`AppCore\UseCase\User\Create\UserCreateRequest`

**アウトプットポート**

`AppCore\UseCase\User\Create\UserCreateResponse`

**インターフェース**

`AppCore\UseCase\User\Create\UserCreateUseCaseInterface`

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
