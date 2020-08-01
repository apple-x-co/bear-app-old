# BEAR.App

![PHP Test](https://github.com/apple-x-co/BEAR.App/workflows/PHP%20Test/badge.svg?branch=develop)
[![Build Status](https://travis-ci.org/apple-x-co/BEAR.App.svg?branch=develop)](https://travis-ci.org/apple-x-co/BEAR.App)

## Create project

```bash
composer create-project -n bear/skeleton app
composer require bear/aura-router-module ray/query-module
composer setup
./vendor/bin/psalm --init
```

## QA

```bash
composer run-script test
composer run-script tests
```

## Diagram

### ユースケース図

「○○を△△する」形式で記載する  

例：  
`docs/uml/use-cases/user.puml`

### モデル図

集約を明確にする  

例：  
`docs/uml/models/domain-models.puml`


## Program structure（DDD + CleanArchitecture）

### 値オブジェクト

```text
以下に該当しない場合は、プリミティブ型（int,string,bool）にする
・ルールが存在しているか  
・その値を単体で扱いたいか  
```

例：  
`AppCore\Domain\Model\User\UserId`  
`AppCore\Domain\Model\User\UserName`

### ドメインモデル

```text
xxx
```

例：  
`AppCore\Domain\Model\User\User`


### リポジトリ

```text
ドメインモデルの永続化・検索を行う。集約内は全て処理する。
```

例：  
`AppCore\Domain\Model\User\UserRepositoryInterface`  
`AppCore\Infrastructure\Persistence\RDB\UserRepository`

### ドメインサービス

```text
モデルや値オブジェクトに定義した場合に、不自然さがある場合にドメインサービスを利用する。
主に、ルールや制約を定義する。例えば、重複チェック。
```

例：  
`AppCore\Domain\Service\UserDomainServiceInterface`  
`AppCore\Infrastructure\Service\UserDomainService`

### クエリーサービス（CQRS）

```text
集約を跨いだモデルを取得したい場合に利用する。戻り値は専用の参照系モデル（DTO）。
参照系モデルは、値オブジェクトを含まないプリミティブな型で構成する。
```

例：  
`AppCore\UseCase\UserQueryServiceInterface`  
`AppCore\UseCase\UserXxxDto`  
`AppCore\Infrastructure\Service\UserQueryService`

### ユースケース

```text
インプットデータに基づいた条件で、実行しアウトプットデータの形式で返却する。
実行には、リポジトリ・ドメインサービス・クエリーサービスを利用する。
```

例：  
`AppCore\UseCase\User\Create\UserCreateUseCaseInterface`  
`AppCore\UseCase\User\Create\UserCreateInputData`  
`AppCore\UseCase\User\Create\UserCreateOutputData`  
`AppCore\Domain\Application\User\UserCreateUseCase`

### ビューモデル

```text
表示系モデル。値オブジェクトを含まないプリミティブな型で構成する。
```

例：  
`AppCore\InterfaceAdapter\Presenter\User\UserGetViewModel`


### コントローラ

```text
クライアントからのリクエストを元に、ユースケースを実行する。
取得したデータは、表示系モデルに入れてビューに渡す
```

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

DDDのモデリングとは何なのか、 そしてどうコードに落とすのか  
https://www.slideshare.net/koichiromatsuoka/domain-modeling-andcoding

PlantUML  
https://plantuml.com/ja/class-diagram
