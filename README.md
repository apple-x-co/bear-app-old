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