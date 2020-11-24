# BEAR.App

![PHP Test](https://github.com/apple-x-co/BEAR.App/workflows/PHP%20Test/badge.svg?branch=develop)
[![Build Status](https://travis-ci.org/apple-x-co/BEAR.App.svg?branch=develop)](https://travis-ci.org/apple-x-co/BEAR.App)

## Create project

```bash
composer create-project -n bear/skeleton app
composer require bear/aura-router-module ^2.0
composer require ray/query-module ^0.1
composer setup
./vendor/bin/psalm --init
```

## QA

```bash
composer run-script test
composer run-script tests
```

## Reference

* BEAR.Sunday, REST実装手順  
https://qiita.com/koriym/items/cb6efd0ab2fb8751f9e9

* BEAR.Sunday REST API開発例  
https://qiita.com/koriym/items/93528a16bccc6faf418b

* BEAR.Sunday, DDD  
https://qiita.com/koriym/items/4cfe8d6d6289a84bab79

* BEAR.SundayとSQLと  
https://qiita.com/hanahiro_aze/items/5dcb08ada243d8c7b8a3

* (Ray.QueryModule) SQL実行入出力の連組配列をarray shapeでタイプする  
https://gist.github.com/koriym/d0d716a3c2a9fee95426b6a7aeb390e6

* JsonSchema Form  
https://github.com/rjsf-team/react-jsonschema-form
