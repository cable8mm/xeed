# Xeed - 라라벨 리소스 제네레이터

[English 👈](README.md)

[![code-style](https://github.com/cable8mm/xeed/actions/workflows/code-style.yml/badge.svg)](https://github.com/cable8mm/xeed/actions/workflows/code-style.yml)
[![run-tests](https://github.com/cable8mm/xeed/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cable8mm/xeed/actions/workflows/run-tests.yml)
[![Packagist Version](https://img.shields.io/packagist/v/cable8mm/xeed)](https://packagist.org/packages/cable8mm/xeed)
[![Packagist Downloads](https://img.shields.io/packagist/dt/cable8mm/xeed)](https://packagist.org/packages/cable8mm/xeed/stats)
[![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/xeed/php)](https://packagist.org/packages/cable8mm/xeed)
![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/xeed/symfony%2Fconsole)
[![Packagist Stars](https://img.shields.io/packagist/stars/cable8mm/xeed)](https://github.com/cable8mm/xeed/stargazers)
[![Packagist License](https://img.shields.io/packagist/l/cable8mm/xeed)](https://github.com/cable8mm/xeed/blob/main/LICENSE.md)

Xeed는 기존 데이터베이스 테이블에서 가져온 데이터를 기반으로 Laravel용 새로운 모델, 시드, 데이터베이스 시드, 팩토리 및 마이그레이션 파일을 생성하는 데 사용됩니다.

> [!TIP]
> 이 프로그램은 `php artisan xeed:*` 라라벨 명령어와 `bin/console *` 독립 명령어로 모두 작동할 수 있으며, 100% 동일한 기능을 제공합니다. 따라서 여러분은 여러분의 Laravel 프로젝트 내에서 사용하거나 독립적인 애플리케이션으로 사용할 수 있습니다.

웹 상에서 API 문서를 제공합니다. 자세한 내용은 https://www.palgle.com/xeed/ 에서 확인하십시오. ❤️

### 기능

- [x] 데이터베이스 테스트 지원
- [x] Laravel을 위한 모델 생성
- [x] Laravel을 위한 시드 파일 생성
- [x] Laravel을 위한 데이터베이스 시드 파일 생성
- [x] Laravel을 위한 팩토리 생성
- [x] Laravel을 위한 마이그레이션 생성
- [x] Laravel 다중 및 예약된 열 지원
- [x] Laravel 통합
- [x] MySQL, SQLite 그리고 PostgreSQL 지원

> [!CAUTION]
> PostgreSQL은 Beta 지원이며, 문제가 발생할 경우 깃헙 이슈를 통해서 리포팅 해 주세요.

### 미리보기

Laravel:

![Preview](https://github.com/cable8mm/cabinet/blob/main/xeed-laravel-preview.gif?raw=true)

Standalone:

![Preview](https://github.com/cable8mm/cabinet/blob/main/xeed-preview.gif?raw=true)

### 지원 및 테스트

![MySQL 지원](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![SQLite 지원](https://img.shields.io/badge/SQLite-07405e?logo=sqlite&logoColor=white)
![PHP 8.0.2+ 지원](https://img.shields.io/badge/PHP-8.0.2%2B-777BB4?logo=php&logoColor=white)
![PHP 8.1.0+ 지원](https://img.shields.io/badge/PHP-8.1.0%2B-777BB4?logo=php&logoColor=white)
![PHP 8.2.0+ 지원](https://img.shields.io/badge/PHP-8.2.0%2B-777BB4?logo=php&logoColor=white)
![PHP 8.3.0+ 지원](https://img.shields.io/badge/PHP-8.3.0%2B-777BB4?logo=php&logoColor=white)

## 설치

```shell tab=Laravel
composer require cable8mm/xeed --dev
# For Laravel
```

```shell tab=Standalone
composer create-project cable8mm/xeed
# For Standalone
```

> [!IMPORTANT]
> 그리고 `.env` 파일을 편집하여 연결해야 하는 데이터베이스를 구성하십시오. 필요할 때마다 수동으로 `.env.example`을 `.env`로 복사할 수 있습니다.

## 사용법

### `모델` 생성

```shell tab=Laravel
php artisan xeed:models
# `app/Models` 폴더에 모든 모델 생성
```

```shell tab=Standalone
bin/console models
# `dist/app/Models` 폴더에 모든 모델 생성
```

### `시드` 생성

```shell tab=Laravel
php artisan xeed:seeders
# `database/seeders` 폴더에 모든 시드 생성
```

```shell tab=Standalone
bin/console seeders
# `dist/database/seeders` 폴더에 모든 시드 생성
```

### `DatabaseSeeder` 생성

```shell tab=Laravel
php artisan xeed:database
# `database/seeders` 폴더에 데이터베이스 시드 생성
```

```shell tab=Standalone
bin/console database
# `dist/database/seeders` 폴더에 데이터베이스 시드 생성
```

### `팩토리` 생성

```shell tab=Laravel
php artisan xeed:factories
# `database/factories' 폴더에 모든 팩토리 생성
```

```shell tab=Standalone
bin/console factories
# `dist/database/factories' 폴더에 모든 팩토리 생성
```

### `마이그레이션` 생성

```shell tab=Laravel
php artisan xeed:migrations
# `database/migrations' 폴더에 모든 마이그레이션 파일 생성
```

```shell tab=Standalone
bin/console migrations
# `dist/database/migrations' 폴더에 모든 마이그레이션 파일 생성
```

생성된 파일은 라라벨 프로젝트와 동일한 폴더에 저장됩니다. `dist` 폴더를 확인하세요.

## 기여 방법

### 개발

Xeed에는 내장된 SQLite 데이터베이스가 있어 직접 데이터베이스가 필요하지 않고 쉽게 기여할 수 있습니다. 테스트 목적으로 새 파일을 만들고 활용하면 됩니다.

```sh
touch database/database.sqlite
# SQLite 데이터베이스를 위한 새 파일 생성
```

그리고,

```sh
composer test
# 테스트 실행
```

### 데이터베이스

마이그레이션 및 팩토리의 경우 모든 데이터베이스 필드 유형에 대한 테스트를 실행해야 할 때 다음 명령을 사용하십시오.

```sh
bin/console xeed
# 'xeeds' 테이블을 데이터베이스에 가져오기

bin/console xeed drop
# 데이터베이스에서 'xeeds' 테이블 삭제
```

생성된 파일을 확인하려면 다음 위치를 참조하십시오. `resources/tests` 이 폴더에 파일이 저장됩니다.

### 유용한 명령

이 패키지를 직접 테스트할 것이라면 다음 명령을 사용하여 생성된 파일을 정리합니다.

```shell tab=Laravel
php artisan xeed:clean
# 생성된 파일, 시드, 모델, 팩토리 및 마이그레이션 파일 정리
#=> 아래 참조
Please select directory for you to want to clean.
  [0] seeder
  [1] model
  [2] factory
  [3] migration
  [4] all
  [5] exit
```

```shell tab=Standalone
bin/console clean
# 생성된 파일, 시드, 모델, 팩토리 및 마이그레이션 파일 정리
#=> 아래 참조
Please select directory for you to want to clean.
  [0] seeder
  [1] model
  [2] factory
  [3] migration
  [4] all
  [5] exit
```

### 버그 보고 및 풀 리퀘스트 제출

버그 보고서 및 풀 리퀘스트를 작성하는 기회는 저를 기쁘게 합니다. 필요할 때마다 기여하고 풀 리퀘스트를 제출하십시오.

## 포맷팅

```bash
composer lint
# 모든 파일을 PSR-12에 따르도록 수정합니다.

composer inspect
# 모든 파일을 PSR-12을 준수하는지 확인합니다.
```

## 테스트

사용된 내장 SQLite 데이터베이스는 사용자의 데이터베이스가 아니라는 점을 명심하십시오. 데이터에 손상을 줄 염려가 없습니다.

```shell tab=Laravel
composer testpack
# 라라벨 커맨드를 포함한 모든 테스트
```

```shell tab=Standalone
composer test
# 라라벨 커맨드를 제외한 모든 테스트
```

### 변경 내역

최근 변경된 내용에 대한 자세한 정보는 [CHANGELOG](CHANGELOG.md)를 참조해주세요.

## 기여

더 자세한 내용은 [CONTRIBUTING](CONTRIBUTING.md)를 참조해주세요.

아래 내용은 기여하는 데 도움이 될 수 있습니다.

Xeed에는 내장된 SQLite 데이터베이스가 있어 별도의 데이터베이스가 필요하지 않고도 쉽게 기여할 수 있습니다. 테스트 목적으로 새 파일을 만들고 활용하기만 하면 됩니다.

```shell
touch database/database.sqlite
# SQLite 데이터베이스를 위한 새로운 빈 파일을 만드세요
```

그 후,

```shell
composer test
# 테스트 샐행
```

### 데이터베이스 시드

마이그레이션과 팩토리를 사용할 때, 모든 데이터베이스 필드 유형에 대한 테스트를 실행해야 할 때는 다음 명령어를 사용하세요.

```shell tab=Laravel
php artisan xeed
# 데이터베이스에 'xeeds' 테이블 임포트

php artisan xeed drop
# 데이터베이스에 'xeeds' 테이블 삭제
```

```shell tab=Standalone
bin/console xeed
# 데이터베이스에 'xeeds' 테이블 임포트

bin/console xeed drop
# 데이터베이스에 'xeeds' 테이블 삭제
```

모든 데이터베이스 필드 유형에 대해 마이그레이션 파일을 활용하려면 다음 위치를 참조하세요: `database/*.sql`. 이러한 파일들은 지정된 폴더에 저장됩니다.

## 크레디트

- [Samgu Lee](https://github.com/cable8mm)

## 라이센스

Xeed 프로젝트는 [MIT 라이센스](LICENSE.md)에 따라 오픈 소스 소프트웨어로 라이센스가 부여됩니다.
